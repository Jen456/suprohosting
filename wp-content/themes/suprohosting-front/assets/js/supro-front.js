(function () {
	'use strict';

	const doc = document;
	const body = doc.body;
	const menuToggle = doc.querySelector('[data-menu-toggle]');
	const menu = doc.querySelector('[data-menu]');
	const flowModal = doc.querySelector('[data-flow-modal]');
	const portalModal = doc.querySelector('[data-portal-modal]');
	const toast = doc.querySelector('[data-toast]');
	const runtimeConfig = window.suproFrontConfig || {};
	const domainConfig = runtimeConfig.domain || {};
	let activeModal = null;
	let previousFocus = null;
	let flowStep = 1;
	let selectedPlan = 'Hosting GROW';
	let activationStarted = false;
	let activationTimers = [];

	function showToast(message) {
		if (!toast) return;
		toast.textContent = message;
		toast.hidden = false;
		window.clearTimeout(showToast.timer);
		showToast.timer = window.setTimeout(function () {
			toast.hidden = true;
		}, 3800);
	}

	function getFocusable(container) {
		return Array.from(container.querySelectorAll('a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'))
			.filter(function (element) {
				return !element.hidden && element.offsetParent !== null;
			});
	}

	function openModal(modal) {
		if (!modal) return;
		previousFocus = doc.activeElement;
		modal.hidden = false;
		activeModal = modal;
		body.classList.add('supro-modal-open');
		const dialog = modal.querySelector('[role="dialog"]');
		window.requestAnimationFrame(function () {
			(dialog || modal).focus();
		});
	}

	function closeModal(modal) {
		if (!modal) return;
		modal.hidden = true;
		activeModal = null;
		body.classList.remove('supro-modal-open');
		if (previousFocus && typeof previousFocus.focus === 'function') previousFocus.focus();
	}

	function setMenu(open) {
		if (!menu || !menuToggle) return;
		menu.classList.toggle('is-open', open);
		menuToggle.setAttribute('aria-expanded', String(open));
	}

	if (menuToggle) {
		menuToggle.addEventListener('click', function () {
			setMenu(menuToggle.getAttribute('aria-expanded') !== 'true');
		});
	}

	doc.querySelectorAll('[data-menu] a').forEach(function (link) {
		link.addEventListener('click', function () { setMenu(false); });
	});

	function initCarousels() {
		const carouselOptions = {
			plans: { items: 3, margin: 24, responsive: { 0: { items: 1, stagePadding: 18 }, 680: { items: 2 }, 980: { items: 3 } } },
			vps: { items: 3, margin: 18, responsive: { 0: { items: 1, stagePadding: 18 }, 650: { items: 2 }, 980: { items: 3 } } },
			stories: { items: 2, margin: 24, responsive: { 0: { items: 1, stagePadding: 18 }, 760: { items: 2 } } }
		};

		doc.querySelectorAll('[data-carousel]').forEach(function (carousel) {
			const key = carousel.dataset.carousel;
			if (window.jQuery && window.jQuery.fn && typeof window.jQuery.fn.owlCarousel === 'function') {
				window.jQuery(carousel).owlCarousel(Object.assign({ loop: false, nav: false, dots: true, smartSpeed: 520, autoHeight: false }, carouselOptions[key] || {}));
			}
		});
	}

	function moveCarousel(key, direction) {
		const carousel = doc.querySelector('[data-carousel="' + key + '"]');
		if (!carousel) return;
		if (window.jQuery && carousel.classList.contains('owl-loaded')) {
			window.jQuery(carousel).trigger(direction > 0 ? 'next.owl.carousel' : 'prev.owl.carousel');
			return;
		}
		carousel.scrollBy({ left: direction * Math.max(280, carousel.clientWidth * 0.78), behavior: 'smooth' });
	}

	doc.querySelectorAll('[data-carousel-next]').forEach(function (button) {
		button.addEventListener('click', function () { moveCarousel(button.dataset.carouselNext, 1); });
	});
	doc.querySelectorAll('[data-carousel-prev]').forEach(function (button) {
		button.addEventListener('click', function () { moveCarousel(button.dataset.carouselPrev, -1); });
	});
	initCarousels();

	function normalizeDomain(value) {
		let domain = (value || '').trim().toLowerCase();
		domain = domain.replace(/^https?:\/\//, '').replace(/^www\./, '').split('/')[0];
		domain = domain.replace(/\s+/g, '').replace(/[^a-z0-9.-]/g, '');
		if (!domain.includes('.')) domain += '.com';
		return domain.replace(/^\.+|\.+$/g, '');
	}

	function domainBase(domain) {
		return domain.split('.')[0] || 'tunegocio';
	}

	function addDomainResult(container, domain, options) {
		const settings = Object.assign({ available: true, primary: false, note: '' }, options || {});
		const row = doc.createElement('div');
		row.className = 'supro-domain-result__row' + (settings.available ? '' : ' is-unavailable');
		const description = doc.createElement('span');
		const status = doc.createElement('i');
		status.textContent = settings.available ? '✓' : '×';
		const name = doc.createTextNode(domain);
		const note = doc.createElement('small');
		note.textContent = settings.note || (settings.primary ? 'Disponible en esta demostración' : 'Alternativa sugerida');
		description.append(status, name, note);
		row.append(description);

		if (!settings.available) {
			container.append(row);
			return;
		}

		const button = doc.createElement('button');
		button.type = 'button';
		button.className = 'supro-button supro-button--small' + (settings.primary ? '' : ' supro-button--outline');
		button.textContent = 'Conectar';
		button.addEventListener('click', function () {
			startFlow('Hosting GROW', domain);
		});
		row.append(button);
		container.append(row);
	}

	function parseDominionResponse(raw) {
		try {
			return JSON.parse(raw);
		} catch (error) {
			const start = raw.indexOf('{');
			const end = raw.lastIndexOf('}');
			if (start !== -1 && end > start) return JSON.parse(raw.slice(start, end + 1));
			throw error;
		}
	}

	async function checkDomainWithDominion(domain) {
		const requestBody = new URLSearchParams({
			action: 'domain_search_6_display',
			domain: domain,
			domainext_domain_search_6: '',
			url: '',
			purchase_btn_name: 'Continuar',
			purchase_btn_url: domainConfig.purchaseUrl || '',
			security: domainConfig.nonce || ''
		});

		const response = await window.fetch(domainConfig.ajaxUrl, {
			method: 'POST',
			credentials: 'same-origin',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
			body: requestBody.toString()
		});

		if (!response.ok) throw new Error('Dominion lookup failed');
		return parseDominionResponse(await response.text());
	}

	const domainSearchForm = doc.querySelector('[data-domain-search]');
	if (domainSearchForm) {
		domainSearchForm.addEventListener('submit', async function (event) {
			event.preventDefault();
			const input = domainSearchForm.querySelector('[name="domain"]');
			const submit = domainSearchForm.querySelector('[type="submit"]');
			const result = doc.querySelector('[data-domain-result]');
			const fullDomain = normalizeDomain(input ? input.value : '');
			if (!input || !fullDomain || fullDomain.startsWith('.')) {
				if (input) input.focus();
				showToast('Escribe el nombre que quieres buscar.');
				return;
			}
			if (!result) return;
			result.replaceChildren();
			result.classList.add('is-visible');

			const liveLookup = domainSearchForm.dataset.domainMode === 'whois' && domainConfig.enabled && domainConfig.ajaxUrl && domainConfig.nonce;
			if (!liveLookup) {
				const base = domainBase(fullDomain);
				const alternatives = [fullDomain, base + '.net', base + '.ec'];
				Array.from(new Set(alternatives)).forEach(function (domain, index) {
					addDomainResult(result, domain, { primary: index === 0 });
				});
				return;
			}

			if (submit) {
				submit.disabled = true;
				submit.setAttribute('aria-busy', 'true');
				submit.textContent = 'Consultando…';
			}
			result.textContent = 'Consultando disponibilidad mediante WHOIS…';

			try {
				const lookup = await checkDomainWithDominion(fullDomain);
				result.replaceChildren();
				const plainText = new DOMParser().parseFromString(lookup.text || '', 'text/html').body.textContent || '';
				const unverifiable = /whois server not found/i.test(plainText);
				if (Number(lookup.status) === 1) {
					addDomainResult(result, lookup.domain || fullDomain, {
						primary: true,
						note: 'Disponible según la consulta WHOIS'
					});
				} else {
					addDomainResult(result, lookup.domain || fullDomain, {
						available: false,
						note: unverifiable ? 'Esta extensión requiere verificación manual' : 'No disponible según la consulta WHOIS'
					});
				}
			} catch (error) {
				result.replaceChildren();
				addDomainResult(result, fullDomain, {
					available: false,
					note: 'No pudimos verificarlo ahora. Intenta nuevamente o solicita ayuda.'
				});
			} finally {
				if (submit) {
					submit.disabled = false;
					submit.removeAttribute('aria-busy');
					submit.textContent = 'Buscar dominio';
				}
			}
		});
	}

	function clearActivationTimers() {
		activationTimers.forEach(window.clearTimeout);
		activationTimers = [];
	}

	function resetActivation() {
		activationStarted = false;
		clearActivationTimers();
		const review = doc.querySelector('[data-review-state]');
		const activation = doc.querySelector('[data-activation-state]');
		if (review) review.hidden = false;
		if (activation) activation.hidden = true;
	}

	function syncSelectedPlan(plan) {
		selectedPlan = plan || selectedPlan;
		doc.querySelectorAll('[data-selected-plan], [data-review-plan]').forEach(function (node) {
			node.textContent = selectedPlan;
		});
		const choices = Array.from(doc.querySelectorAll('[name="flow-plan"]'));
		choices.forEach(function (choice) { choice.checked = choice.value === selectedPlan; });
	}

	function setFlowStep(step) {
		flowStep = step;
		doc.querySelectorAll('[data-flow-step]').forEach(function (panel) {
			const active = Number(panel.dataset.flowStep) === step;
			panel.hidden = !active;
			panel.classList.toggle('is-active', active);
		});
		doc.querySelectorAll('[data-step-indicator]').forEach(function (item) {
			const number = Number(item.dataset.stepIndicator);
			item.classList.toggle('is-active', number === step);
			item.classList.toggle('is-done', number < step);
			const numberNode = item.querySelector('span');
			if (numberNode) numberNode.textContent = number < step ? '✓' : String(number);
		});
		const back = doc.querySelector('[data-flow-back]');
		const next = doc.querySelector('[data-flow-next]');
		if (back) back.hidden = step === 1 || activationStarted;
		if (next && !activationStarted) {
			next.hidden = false;
			next.disabled = false;
			next.dataset.ready = 'false';
			next.textContent = step === 4 ? 'Activar demostración →' : 'Continuar →';
		}
	}

	function startFlow(plan, domain) {
		syncSelectedPlan(plan || 'Hosting GROW');
		resetActivation();
		if (domain) {
			const domainInput = doc.querySelector('[name="flow-domain"]');
			const path = doc.querySelector('[name="domain-path"][value="register"]');
			if (domainInput) domainInput.value = domain;
			if (path) path.checked = true;
		}
		setFlowStep(1);
		openModal(flowModal);
	}

	doc.querySelectorAll('[data-start-flow]').forEach(function (button) {
		button.addEventListener('click', function () { startFlow(button.dataset.plan); });
	});

	doc.querySelectorAll('[name="flow-plan"]').forEach(function (choice) {
		choice.addEventListener('change', function () {
			if (choice.checked) syncSelectedPlan(choice.value);
		});
	});

	doc.querySelectorAll('[data-close-flow]').forEach(function (button) {
		button.addEventListener('click', function () {
			clearActivationTimers();
			closeModal(flowModal);
		});
	});

	const domainPathChoices = Array.from(doc.querySelectorAll('[name="domain-path"]'));
	const flowDomainInput = doc.querySelector('[name="flow-domain"]');
	function syncDomainPath() {
		const choice = domainPathChoices.find(function (item) { return item.checked; });
		if (!flowDomainInput || !choice) return;
		const later = choice.value === 'later';
		flowDomainInput.disabled = later;
		flowDomainInput.closest('.supro-field').style.opacity = later ? '.48' : '1';
		flowDomainInput.placeholder = choice.value === 'existing' ? 'tudominioactual.com' : 'tunegocio.com';
	}
	domainPathChoices.forEach(function (choice) { choice.addEventListener('change', syncDomainPath); });

	function updateReview() {
		const path = domainPathChoices.find(function (item) { return item.checked; });
		const domainOutput = doc.querySelector('[data-review-domain]');
		const extrasOutput = doc.querySelector('[data-review-extras]');
		const domain = normalizeDomain(flowDomainInput && !flowDomainInput.disabled ? flowDomainInput.value : '');
		if (domainOutput) {
			if (path && path.value === 'later') domainOutput.textContent = 'Se conectará después';
			else if (path && path.value === 'existing') domainOutput.textContent = domain || 'Dominio existente';
			else domainOutput.textContent = domain || 'Por definir';
		}
		const extras = Array.from(doc.querySelectorAll('[name="extra"]:checked')).map(function (input) { return input.value; });
		if (extrasOutput) extrasOutput.textContent = extras.length ? extras.join(', ') : 'Sin extras';
	}

	const flowBack = doc.querySelector('[data-flow-back]');
	const flowNext = doc.querySelector('[data-flow-next]');
	if (flowBack) flowBack.addEventListener('click', function () { if (flowStep > 1 && !activationStarted) setFlowStep(flowStep - 1); });
	if (flowNext) {
		flowNext.addEventListener('click', function () {
			if (flowStep === 1) {
				setFlowStep(2);
				return;
			}
			if (flowStep === 2) {
				setFlowStep(3);
				return;
			}
			if (flowStep === 3) {
				const email = doc.querySelector('[name="customer-email"]');
				if (email && email.value && !email.checkValidity()) {
					email.focus();
					showToast('Revisa el formato del correo.');
					return;
				}
				updateReview();
				setFlowStep(4);
				return;
			}
			if (flowStep === 4 && !activationStarted) {
				runActivation();
				return;
			}
			if (flowStep === 4 && flowNext.dataset.ready === 'true') {
				closeModal(flowModal);
				window.setTimeout(function () { openModal(portalModal); }, 130);
			}
		});
	}

	function runActivation() {
		activationStarted = true;
		clearActivationTimers();
		const review = doc.querySelector('[data-review-state]');
		const activation = doc.querySelector('[data-activation-state]');
		const progress = doc.querySelector('[data-activation-progress]');
		const title = doc.querySelector('[data-activation-title]');
		const copy = doc.querySelector('[data-activation-copy]');
		const icon = doc.querySelector('[data-activation-icon]');
		const items = Array.from(doc.querySelectorAll('[data-activation-item]'));
		const back = doc.querySelector('[data-flow-back]');
		if (review) review.hidden = true;
		if (activation) activation.hidden = false;
		if (back) back.hidden = true;
		if (flowNext) {
			flowNext.dataset.ready = 'false';
			flowNext.disabled = true;
			flowNext.textContent = 'Preparando…';
		}
		if (progress) progress.style.width = '7%';
		if (icon) icon.textContent = '↻';
		if (title) title.textContent = 'Preparando tu servicio…';
		if (copy) copy.textContent = 'Esta animación representa el pago y el aprovisionamiento automático.';
		items.forEach(function (item) { item.classList.remove('is-done'); });

		activationTimers.push(window.setTimeout(function () {
			if (progress) progress.style.width = '47%';
			if (items[0]) items[0].classList.add('is-done');
		}, 600));
		activationTimers.push(window.setTimeout(function () {
			if (progress) progress.style.width = '77%';
			if (items[1]) items[1].classList.add('is-done');
		}, 1250));
		activationTimers.push(window.setTimeout(function () {
			if (progress) progress.style.width = '100%';
			if (icon) icon.textContent = '✓';
			if (title) title.textContent = 'La experiencia está lista';
			if (copy) copy.textContent = 'En producción, recibirás accesos y entrarás al panel con tu servicio activo.';
			if (flowNext) {
				flowNext.dataset.ready = 'true';
				flowNext.disabled = false;
				flowNext.textContent = 'Abrir mi panel →';
			}
		}, 2050));
	}

	/* Dominion checks availability only. Its purchase link is bridged into this visual flow. */
	doc.addEventListener('click', function (event) {
		const purchaseLink = event.target.closest('.supro-domain-console .ft-btn');
		if (!purchaseLink) return;
		event.preventDefault();
		const scope = purchaseLink.closest('.ft-available') || purchaseLink.parentElement;
		const matched = (scope ? scope.textContent : '').match(/[a-z0-9-]+(?:\.[a-z0-9-]+)+/i);
		startFlow('Hosting GROW', matched ? matched[0].toLowerCase() : '');
	});

	doc.querySelectorAll('[data-open-portal]').forEach(function (button) {
		button.addEventListener('click', function (event) {
			event.preventDefault();
			openModal(portalModal);
		});
	});

	doc.querySelectorAll('[data-close-portal]').forEach(function (button) {
		button.addEventListener('click', function () { closeModal(portalModal); });
	});

	doc.querySelectorAll('.supro-portal__side nav button').forEach(function (button) {
		button.addEventListener('click', function () {
			doc.querySelectorAll('.supro-portal__side nav button').forEach(function (item) { item.classList.remove('is-active'); });
			button.classList.add('is-active');
			showToast('Este módulo se conectará al portal real durante la fase de backend.');
		});
	});

	doc.querySelectorAll('[data-demo-action]').forEach(function (button) {
		button.addEventListener('click', function () {
			showToast('El acceso seguro se conectará con hosting y webmail en la fase de backend.');
		});
	});

	doc.addEventListener('keydown', function (event) {
		if (event.key === 'Escape' && activeModal) {
			clearActivationTimers();
			closeModal(activeModal);
			return;
		}
		if (event.key !== 'Tab' || !activeModal) return;
		const focusable = getFocusable(activeModal);
		if (!focusable.length) return;
		const first = focusable[0];
		const last = focusable[focusable.length - 1];
		if (event.shiftKey && doc.activeElement === first) {
			event.preventDefault();
			last.focus();
		} else if (!event.shiftKey && doc.activeElement === last) {
			event.preventDefault();
			first.focus();
		}
	});

	doc.querySelectorAll('.supro-accordion details').forEach(function (detail) {
		detail.addEventListener('toggle', function () {
			if (!detail.open) return;
			doc.querySelectorAll('.supro-accordion details').forEach(function (other) {
				if (other !== detail) other.open = false;
			});
		});
	});

	const revealItems = doc.querySelectorAll('[data-reveal]');
	if ('IntersectionObserver' in window) {
		const observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) return;
				entry.target.classList.add('is-visible');
				observer.unobserve(entry.target);
			});
		}, { threshold: 0.1 });
		revealItems.forEach(function (item) { observer.observe(item); });
	} else {
		revealItems.forEach(function (item) { item.classList.add('is-visible'); });
	}
})();
