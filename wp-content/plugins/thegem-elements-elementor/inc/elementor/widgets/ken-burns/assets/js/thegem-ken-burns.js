(function($) {
	function initKenBurns($scope) {
		var $kenBurns = $scope;
		if(!$kenBurns.is('.thegem-ken-burns-bg')) {
			$kenBurns = $scope.find('.thegem-ken-burns-bg');
		}
		if (!$kenBurns.length) return;

		var slidesData = $kenBurns.data('slides');

		if (!slidesData || slidesData.length === 0) return;

		if(slidesData.length > 1) {
			$kenBurns.addClass('slides');
		}

		var $currentSlide = $kenBurns.find('.thegem-ken-burns-slide');
		var transition = parseInt($kenBurns.data('transition')) || 500;

		$kenBurns[0].style.setProperty('--transition', transition + 'ms');

		var currentIndex = 0;
		var timeoutId = null;
		var isAnimating = false;

		// Initialize first slide if no background
		if (!$currentSlide.length || !$currentSlide.css('background-image') || $currentSlide.css('background-image') === 'none') {
			$currentSlide.remove();
			$currentSlide = $('<div class="thegem-ken-burns-slide"></div>')
				.css('background-image', 'url(' + slidesData[0].url + ')')
				.attr({
					'data-direction': slidesData[0].direction,
					'data-duration': slidesData[0].duration
				});
			$kenBurns.append($currentSlide);
		}

		// Set animation duration
		if(slidesData.length === 1) {
			$currentSlide[0].style.setProperty('--duration', $currentSlide.data('duration') + 'ms');
		}

		function startAnimation(isFirst) {
			if (!isAnimating) return;
			var currentData = slidesData[currentIndex];
			var nextIndex = (currentIndex + 1) % slidesData.length;
			var nextData = slidesData[nextIndex];

			// Create next slide
			var $nextSlide = $('<div class="thegem-ken-burns-slide"></div>')
				.css('background-image', 'url(' + nextData.url + ')')
				.attr({
					'data-direction': nextData.direction,
					'data-duration': nextData.duration
				});
			$kenBurns.prepend($nextSlide);

			// Set animation duration
			//$nextSlide[0].style.setProperty('--duration', nextData.duration + 'ms');

			if(slidesData.length === 1) return;

			// When current animation ends
			timeoutId = setTimeout(function() {
				if (!isAnimating) return;

				// Crossfade transition
				$currentSlide.addClass('crossFade-out');
				$nextSlide.addClass('active');

				// Remove old slide after delay
				setTimeout(function() {
					$currentSlide.remove();
					$currentSlide = $nextSlide;
					currentIndex = nextIndex;

					// Start next animation cycle
					if (isAnimating) {
						timeoutId = setTimeout(function() { startAnimation(false) }, 500);
					}
				}, currentData.duration / 2);
			}, isFirst ? currentData.duration : currentData.duration / 2);
		}

		function stopAnimation() {
			isAnimating = false;
			clearTimeout(timeoutId);
		}

		var observer = new IntersectionObserver(function(entries) {
			entries.forEach(function(entry) {
				if (entry.isIntersecting) {
					isAnimating = true;
					startAnimation(true);
					$currentSlide.addClass('active');
				} else {
					stopAnimation();
					$currentSlide.removeClass('active');
					$('.thegem-ken-burns-slide:not(:last-child)', $kenBurns).remove();
				}
			});
		}, { threshold: [0, 0.5] });

		observer.observe($kenBurns[0]);

	}

	if(typeof elementorFrontend !== 'undefined' && elementorFrontend.isEditMode()) {
		$(window).on('elementor/frontend/init', function() {
			let FrontEndExtended = elementorModules.frontend.handlers.Base.extend({
				onInit: function () {
					var settings = this.getElementSettings();
					if(settings.thegem_ken_burns_active === 'yes' && settings.thegem_ken_burns_slides.length) {
						var slidesData = [];

						$.each(settings.thegem_ken_burns_slides, function(i, slide) {
							if (slide.image && slide.image.url) {
								slidesData.push({
									url: slide.image.url,
									duration: slide.animation_duration || (settings.thegem_ken_burns_slides.length > 1 ? 5000 : 15000),
									direction: slide.animation_direction || 'zoom-in'
								});
							}
						});

						if(slidesData.length) {
							$('.thegem-ken-burns-bg', this.$element).data('slides', slidesData);
							$('.thegem-ken-burns-bg', this.$element).data('transition', settings.thegem_ken_burns_transition || 500);
							initKenBurns(this.$element);
						}
					}
				}
			});

			elementorFrontend.hooks.addAction('frontend/element_ready/container', function(element) {
				new FrontEndExtended({
					$element: element
				});
			});
		});
	} else {
		$('.thegem-ken-burns-bg').each(function() {
			initKenBurns($(this));
		});
	}
})(jQuery);