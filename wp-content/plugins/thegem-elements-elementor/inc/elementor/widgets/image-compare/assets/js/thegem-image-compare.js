/* thegem-image-compare.js
   Elementor Image Compare Widget
   Supports: horizontal / vertical / hover / drag
   Uses data-offset (initial_offset) as initial position (0–100%)
*/

(function () {
	'use strict';

	function clamp(v, a, b) { return Math.max(a, Math.min(b, v)); }

	function initAll() {
		const wrappers = document.querySelectorAll('.thegem-image-compare-wrapper');
		wrappers.forEach(initWrapper);
	}

	function waitForImages(container) {
		const imgs = Array.from(container.querySelectorAll('img'));
		if (!imgs.length) return Promise.resolve();
		const promises = imgs.map(img => {
			if (img.complete && img.naturalWidth !== 0) return Promise.resolve();
			return new Promise(res => {
				img.addEventListener('load', res, { once: true });
				img.addEventListener('error', res, { once: true });
			});
		});
		return Promise.all(promises);
	}

	function initWrapper(wrapper) {
		if (wrapper.__imageCompareInit) return;
		wrapper.__imageCompareInit = true;

		const viewport = wrapper.querySelector('.thegem-image-compare-viewport') || wrapper;
		const beforeWrap = wrapper.querySelector('.thegem-image-compare-img-before-wrapper');
		const afterWrap = wrapper.querySelector('.thegem-image-compare-img-after-wrapper');
		const handle = wrapper.querySelector('.thegem-image-compare-handle');
		const labelBefore = wrapper.querySelector('.thegem-image-compare-label-before');
		const labelAfter = wrapper.querySelector('.thegem-image-compare-label-after');

		const orientation =
			(wrapper.classList.contains('thegem-image-compare-vertical') ||
			 wrapper.classList.contains('thegem-image-compare-orientation-vertical') ||
			 wrapper.getAttribute('data-orientation') === 'vertical')
				? 'vertical'
				: 'horizontal';

		const modeHover = wrapper.classList.contains('thegem-image-compare-mode-hover');

		// initial offset from widget (0–100%)
		const offsetAttr = parseFloat(wrapper.getAttribute('data-offset')) * 100;
		const startPercent = isFinite(offsetAttr) ? clamp(offsetAttr, 0, 100) : 50;

		if (!afterWrap || !handle) return;

		let currentPercent = startPercent;

		function computePercentFromEvent(e) {
			const rect = viewport.getBoundingClientRect();
			const clientX = (e.touches && e.touches[0]) ? e.touches[0].clientX : e.clientX;
			const clientY = (e.touches && e.touches[0]) ? e.touches[0].clientY : e.clientY;
			let pct;
			if (orientation === 'horizontal') {
				const x = clientX - rect.left;
				pct = (x / rect.width) * 100;
			} else {
				const y = clientY - rect.top;
				pct = (y / rect.height) * 100;
			}
			return clamp(pct, 0, 100);
		}

		function setPosition(pct, emitEvent) {
			pct = clamp(pct, 0, 100);
			currentPercent = pct;

			if (orientation === 'horizontal') {
				afterWrap.style.clipPath = 'inset(0 0 0 ' + pct + '%)';
				handle.style.left = pct + '%';
				handle.style.top = '0';
			} else {
				afterWrap.style.clipPath = 'inset(' + pct + '% 0 0 0)';
				handle.style.top = pct + '%';
				handle.style.left = '0';
			}

			wrapper.setAttribute('data-current', pct.toString());

			if (handle) {
				handle.setAttribute('role', 'separator');
				handle.setAttribute('aria-valuemin', '0');
				handle.setAttribute('aria-valuemax', '100');
				handle.setAttribute('aria-valuenow', Math.round(pct).toString());
			}

			if (emitEvent !== false) {
				const evt = new CustomEvent('imageCompare.change', {
					detail: { percent: pct, wrapper: wrapper }
				});
				wrapper.dispatchEvent(evt);
			}
		}

		function applyInitialPosition() {
			const rect = viewport.getBoundingClientRect();
			if ((rect.width === 0 && orientation === 'horizontal') || (rect.height === 0 && orientation === 'vertical')) {
				requestAnimationFrame(applyInitialPosition);
			} else {
				setPosition(startPercent, false);
			}
		}

		waitForImages(wrapper).then(applyInitialPosition).catch(applyInitialPosition);

		// === Resize Observer ===
		if ('ResizeObserver' in window) {
			try {
				const ro = new ResizeObserver(() => setPosition(currentPercent, false));
				ro.observe(viewport);
			} catch (e) {}
		} else {
			window.addEventListener('resize', () => setPosition(currentPercent, false), { passive: true });
		}

		// === DRAG MODE ===
		let dragging = false;

		function onPointerDown(e) {
			if (modeHover) return;
			dragging = true;
			wrapper.classList.add('is-dragging');
			if (e.target.setPointerCapture && e.pointerId) {
				try { e.target.setPointerCapture(e.pointerId); } catch (ignore) {}
			}
			e.preventDefault();
		}

		function onPointerMove(e) {
			if (!dragging) return;
			const pct = computePercentFromEvent(e);
			setPosition(pct, true);
		}

		function endDrag(e) {
			if (!dragging) return;
			dragging = false;
			wrapper.classList.remove('is-dragging');
			if (e && e.target && e.pointerId && e.target.releasePointerCapture) {
				try { e.target.releasePointerCapture(e.pointerId); } catch (ignore) {}
			}
		}

		// === HOVER MODE ===
		function enableHover() {
			let inside = false;

			viewport.addEventListener('mouseenter', () => {
				inside = true;
			});

			viewport.addEventListener('mousemove', (e) => {
				if (!inside) return;
				const rect = viewport.getBoundingClientRect();
				if (
					e.clientX < rect.left ||
					e.clientX > rect.right ||
					e.clientY < rect.top ||
					e.clientY > rect.bottom
				) return;
				const pct = computePercentFromEvent(e);
				setPosition(pct, true);
			});

			viewport.addEventListener('mouseleave', () => {
				inside = false;
				const reset = wrapper.getAttribute('data-hover-reset');
				if (reset === 'true') setPosition(startPercent, true);
			});
		}

		// === KEYBOARD SUPPORT ===
		function onKeyDown(e) {
			const step = e.shiftKey ? 10 : 2;
			const current = parseFloat(wrapper.getAttribute('data-current')) || startPercent;
			if (orientation === 'horizontal') {
				if (e.key === 'ArrowLeft') { setPosition(clamp(current - step, 0, 100)); e.preventDefault(); }
				if (e.key === 'ArrowRight') { setPosition(clamp(current + step, 0, 100)); e.preventDefault(); }
			} else {
				if (e.key === 'ArrowUp') { setPosition(clamp(current - step, 0, 100)); e.preventDefault(); }
				if (e.key === 'ArrowDown') { setPosition(clamp(current + step, 0, 100)); e.preventDefault(); }
			}
			if (e.key === 'Home') { setPosition(0); e.preventDefault(); }
			if (e.key === 'End') { setPosition(100); e.preventDefault(); }
		}

		if (window.PointerEvent) {
			viewport.addEventListener('pointerdown', onPointerDown, { passive: false });
			viewport.addEventListener('pointermove', onPointerMove, { passive: true });
			viewport.addEventListener('pointerup', endDrag, { passive: true });
			viewport.addEventListener('pointercancel', endDrag, { passive: true });
		} else {
			viewport.addEventListener('mousedown', onPointerDown, { passive: false });
			viewport.addEventListener('mousemove', onPointerMove, { passive: true });
			viewport.addEventListener('mouseup', endDrag, { passive: true });

			viewport.addEventListener('touchstart', onPointerDown, { passive: false });
			viewport.addEventListener('touchmove', onPointerMove, { passive: true });
			viewport.addEventListener('touchend', endDrag, { passive: true });
			viewport.addEventListener('touchcancel', endDrag, { passive: true });
		}

		if (modeHover) enableHover();

		handle.setAttribute('tabindex', '0');
		handle.addEventListener('keydown', onKeyDown);

		viewport.addEventListener('click', function (e) {
			if (e.target === handle) return;
			const pct = computePercentFromEvent(e);
			setPosition(pct, true);
		});

		if (labelBefore && labelAfter) {
			labelBefore.setAttribute('aria-hidden', 'true');
			labelAfter.setAttribute('aria-hidden', 'true');
		}

		wrapper.imageCompare = {
			set: v => setPosition(clamp(v, 0, 100), true),
			get: () => parseFloat(wrapper.getAttribute('data-current')) || startPercent
		};
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initAll);
	} else {
		initAll();
	}

	const observer = new MutationObserver(muts => {
		muts.forEach(m => {
			if (m.addedNodes && m.addedNodes.length) {
				m.addedNodes.forEach(n => {
					if (n.nodeType !== 1) return;
					if (n.classList && n.classList.contains('thegem-image-compare-wrapper')) initWrapper(n);
					const nested = n.querySelectorAll && n.querySelectorAll('.thegem-image-compare-wrapper');
					if (nested && nested.length) nested.forEach(initWrapper);
				});
			}
		});
	});
	observer.observe(document.body, { childList: true, subtree: true });

})();
