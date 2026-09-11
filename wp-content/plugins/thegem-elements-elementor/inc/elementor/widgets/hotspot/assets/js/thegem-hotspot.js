(function($) {
	'use strict';

	// Main class for managing hotspots
	class TheGemHotspot {
		constructor(element) {
			this.element = element;
			this.$element = $(element);
			this.hotspotItems = this.$element.find('.thegem-hotspot-item');
			this.isMobile = window.innerWidth <= 767;
			this.animationStarted = false;
			this.observer = null;

			this.init();
		}

		init() {
			this.initIntersectionObserver();
			this.initTooltipBehavior();
			this.handleMobileBehavior();
		}

		// Initialize intersection observer for viewport detection
		initIntersectionObserver() {
			if (!('IntersectionObserver' in window)) {
				this.initMarkerAnimations();
				return;
			}

			this.observer = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					if (!entry.isIntersecting || this.animationStarted) return;

					const rect = entry.boundingClientRect;
					const H = window.innerHeight;

					const fullyVisible = rect.top >= 0 && rect.bottom <= H;

					const topVisible = rect.top >= 0 && rect.top <= H;
					const topAbove60FromBottom = topVisible && rect.top <= (0.5 * H);

					const bottomVisible = rect.bottom >= 0 && rect.bottom <= H;
					const bottomBelow60FromTop = bottomVisible && rect.bottom >= (0.5 * H);
					if (fullyVisible || topAbove60FromBottom || bottomBelow60FromTop) {
						this.animationStarted = true;
						console.log('ACTIVATE');
						this.initMarkerAnimations();
						this.observer.unobserve(this.element);
					}
				});
			}, {
				threshold: Array.from({ length: 21 }, (_, i) => i * 0.05)
			});

			this.observer.observe(this.element);
		}



		// Initialize marker animations
		initMarkerAnimations() {
			const animatedItems = this.hotspotItems.filter('.thegem-hotspot-animated');

			animatedItems.each((index, item) => {
				const $item = $(item);
				const delay = parseInt($item.css('animation-delay')) || 0;

				setTimeout(() => {
					$item.addClass('thegem-hotspot-visible');
				}, delay);
			});
		}

		// Initialize tooltip behavior
		initTooltipBehavior() {
			// Get the main widget container to read settings from
			const widgetContainer = this.$element.hasClass('thegem-hotspot-widget') ? 
				this.$element : this.$element.find('.thegem-hotspot-widget').first();

			if (widgetContainer.length === 0) return;

			const triggerClass = widgetContainer.attr('class').match(/thegem-hotspot-trigger-(\w+)/);
			const triggerType = triggerClass ? triggerClass[1] : 'hover';

			switch (triggerType) {
				case 'hover':
					this.initHoverBehavior();
					break;
				case 'click':
					this.initClickBehavior();
					break;
				case 'show-always':
					// For always visible - CSS styles already handle this
					break;
			}
		}

		// Hover behavior
		initHoverBehavior() {
			if (this.isMobile) {
				this.initClickBehavior();
				return;
			}

			this.hotspotItems.each((index, item) => {
				const $item = $(item);

				$item.on('mouseenter.thegem-hotspot', () => {
					this.deactivateAllItems();
					$item.addClass('active');
				});

				$item.on('mouseleave.thegem-hotspot', () => {
					$item.removeClass('active');
				});
			});

			$(document).on('click.thegem-hotspot', (e) => {
				if (!$(e.target).closest('.thegem-hotspot-item').length) {
					this.deactivateAllItems();
				}
			});
		}

		// Click behavior
		initClickBehavior() {
			this.hotspotItems.each((index, item) => {
				const $item = $(item);

				$item.on('click.thegem-hotspot', (e) => {
					e.preventDefault();
					e.stopPropagation();

					if ($item.hasClass('active')) {
						$item.removeClass('active');
					} else {
						this.deactivateAllItems();
						$item.addClass('active');
					}
				});
			});

			$(document).on('click.thegem-hotspot', (e) => {
				if (!$(e.target).closest('.thegem-hotspot-item').length) {
					this.deactivateAllItems();
				}
			});

			// Prevent closing when clicking on tooltip
			this.$element.on('click.thegem-hotspot', '.thegem-hotspot-tooltip', (e) => {
				e.stopPropagation();
			});
		}

		// Deactivate all hotspots
		deactivateAllItems() {
			this.hotspotItems.removeClass('active');
		}

		// Handle mobile behavior
		handleMobileBehavior() {
			if (!this.isMobile) return;

			const widgetContainer = this.$element.hasClass('thegem-hotspot-widget') ? 
				this.$element : this.$element.find('.thegem-hotspot-widget').first();

			if (widgetContainer.hasClass('thegem-hotspot-trigger-hover')) {
				widgetContainer.addClass('thegem-hotspot-mobile-hover');
			}
		}

		// Destroy instance
		destroy() {
			if (this.observer) {
				this.observer.unobserve(this.element);
				this.observer.disconnect();
			}
			this.hotspotItems.off('.thegem-hotspot');
			$(document).off('.thegem-hotspot');
			this.$element.off('.thegem-hotspot');
			this.deactivateAllItems();
		}
	}

	// Elementor widget handler
	$(window).on('elementor/frontend/init', function() {
		const TheGemHotspotHandler = elementorModules.frontend.handlers.Base.extend({
			bindEvents: function() {
				this.run();
			},

			unbindEvents: function() {
				if (this.hotspotInstance) {
					this.hotspotInstance.destroy();
				}
			},

			run: function() {
				// Find the actual hotspot widget inside Elementor element
				const hotspotWidget = this.$element.find('.thegem-hotspot-widget').first();
				if (hotspotWidget.length) {
					this.hotspotInstance = new TheGemHotspot(hotspotWidget[0]);
				} else {
					// Fallback: use Elementor element itself
					this.hotspotInstance = new TheGemHotspot(this.$element[0]);
				}
			},

			onElementChange: function(propertyName) {
				if (propertyName.startsWith('tooltip_trigger') || 
					propertyName.startsWith('hotspot_list')) {

					setTimeout(() => {
						this.unbindEvents();
						this.run();
					}, 100);
				}
			}
		});

		elementorFrontend.hooks.addAction('frontend/element_ready/thegem-hotspot.default', function($element) {
			elementorFrontend.elementsHandler.addHandler(TheGemHotspotHandler, {
				$element: $element
			});
		});
	});

	// Auto-initialization for non-Elementor usage
	$(document).ready(function() {
		$('.thegem-hotspot-widget').each(function() {
			// Only initialize if not inside Elementor element (Elementor will handle it)
			if (!$(this).closest('.elementor-element').length) {
				new TheGemHotspot(this);
			}
		});
	});

})(jQuery);