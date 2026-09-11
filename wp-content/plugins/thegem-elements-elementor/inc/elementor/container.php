<?php
namespace Elementor\Includes\Elements;

use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
#[\AllowDynamicProperties]
class Element_TheGem_Container extends Container {

	public function __construct( array $data = [], ?array $args = null ) {
		parent::__construct( $data, $args );

		$this->active_kit = Plugin::$instance->kits_manager->get_active_kit();
	}

	protected function register_controls() {
		parent::register_controls();
		$this->update_boxed_width_control();
	}

	private function update_boxed_width_control() {
		$this->update_responsive_control(
			'boxed_width',
			[
				'selectors' => [
					'{{WRAPPER}}, {{WRAPPER}}.thegem-e-con-layout-thegem' => '--content-width: {{SIZE}}{{UNIT}};'
				],
			]
		);
	}

	/**
	 * Register the Container's background overlay controls.
	 *
	 * @return void
	 */
	protected function register_background_overlay_controls() {
		$this->start_controls_section(
			'section_background_overlay',
			[
				'label' => esc_html__( 'Background Overlay', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_background_overlay' );

		/**
		 * Normal.
		 */
		$this->start_controls_tab(
			'tab_background_overlay',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);

		$background_overlay_selector = '{{WRAPPER}}::before, {{WRAPPER}} > .elementor-background-video-container::before, {{WRAPPER}} > .e-con-inner > .elementor-background-video-container::before, {{WRAPPER}} > .elementor-background-slideshow::before, {{WRAPPER}} > .e-con-inner > .elementor-background-slideshow::before, {{WRAPPER}} > .elementor-motion-effects-container > .elementor-motion-effects-layer::before, {{WRAPPER}} > .e-con-inner > .thegem-ken-burns-bg::before, {{WRAPPER}} > .thegem-ken-burns-bg::before';

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_overlay',
				'selector' => $background_overlay_selector,
				'fields_options' => [
					'background' => [
						'selectors' => [
							// Hack to set the `::before` content in order to render it only when there is a background overlay.
							$background_overlay_selector => '--background-overlay: \'\';',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'background_overlay_opacity',
			[
				'label' => esc_html__( 'Opacity', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--overlay-opacity: {{SIZE}};',
				],
				'condition' => [
					'background_overlay_background' => [ 'classic', 'gradient' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}}::before',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'background_overlay_image[url]',
							'operator' => '!==',
							'value' => '',
						],
						[
							'name' => 'background_overlay_color',
							'operator' => '!==',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'overlay_blend_mode',
			[
				'label' => esc_html__( 'Blend Mode', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Normal', 'elementor' ),
					'multiply' => esc_html__( 'Multiply', 'elementor' ),
					'screen' => esc_html__( 'Screen', 'elementor' ),
					'overlay' => esc_html__( 'Overlay', 'elementor' ),
					'darken' => esc_html__( 'Darken', 'elementor' ),
					'lighten' => esc_html__( 'Lighten', 'elementor' ),
					'color-dodge' => esc_html__( 'Color Dodge', 'elementor' ),
					'saturation' => esc_html__( 'Saturation', 'elementor' ),
					'color' => esc_html__( 'Color', 'elementor' ),
					'luminosity' => esc_html__( 'Luminosity', 'elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}}' => '--overlay-mix-blend-mode: {{VALUE}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'background_overlay_image[url]',
							'operator' => '!==',
							'value' => '',
						],
						[
							'name' => 'background_overlay_color',
							'operator' => '!==',
							'value' => '',
						],
					],
				],
			]
		);

		$this->end_controls_tab();

		/**
		 * Hover.
		 */
		$this->start_controls_tab(
			'tab_background_overlay_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);

		$background_overlay_hover_selector = '{{WRAPPER}}:hover::before, {{WRAPPER}}:hover > .elementor-background-video-container::before, {{WRAPPER}}:hover > .e-con-inner > .elementor-background-video-container::before, {{WRAPPER}} > .elementor-background-slideshow:hover::before, {{WRAPPER}} > .e-con-inner > .elementor-background-slideshow:hover::before, {{WRAPPER}}:hover > .e-con-inner > .thegem-ken-burns-bg::before, {{WRAPPER}}:hover > .thegem-ken-burns-bg::before';

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_overlay_hover',
				'selector' => $background_overlay_hover_selector,
				'fields_options' => [
					'background' => [
						'selectors' => [
							// Hack to set the `::before` content in order to render it only when there is a background overlay.
							$background_overlay_hover_selector => '--background-overlay: \'\';',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'background_overlay_hover_opacity',
			[
				'label' => esc_html__( 'Opacity', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover' => '--overlay-opacity: {{SIZE}};',
				],
				'condition' => [
					'background_overlay_hover_background' => [ 'classic', 'gradient' ],
				],
			]
		);

		$this->add_control(
			'background_overlay_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'elementor' ) . ' (s)',
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'render_type' => 'ui',
				'separator' => 'before',
				'condition' => [
					'background_overlay_hover_background' => [ 'classic', 'gradient' ],
				],
				'selectors' => [
					'{{WRAPPER}}, {{WRAPPER}}::before' => '--overlay-transition: {{SIZE}}s;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}}:hover::before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function content_template() {
		?>
		<# if ( 'boxed' === settings.content_width ) { #>
			<div class="e-con-inner">
		<#
		}
		if ( settings.thegem_ken_burns_active ) { #>
			<div class="thegem-ken-burns-bg"><div class="thegem-ken-burns-bg-slide"></div></div>
		<#
		}
		if ( settings.background_video_link ) {
			let videoAttributes = 'autoplay muted playsinline';

			if ( ! settings.background_play_once ) {
				videoAttributes += ' loop';
			}

			view.addRenderAttribute( 'background-video-container', 'class', 'elementor-background-video-container' );

			if ( ! settings.background_play_on_mobile ) {
				view.addRenderAttribute( 'background-video-container', 'class', 'elementor-hidden-mobile' );
			}
			#>
			<div {{{ view.getRenderAttributeString( 'background-video-container' ) }}}>
				<div class="elementor-background-video-embed"></div>
				<video class="elementor-background-video-hosted" {{ videoAttributes }}></video>
			</div>
		<# } #>
		<div class="elementor-shape elementor-shape-top"></div>
		<div class="elementor-shape elementor-shape-bottom"></div>
		<# if ( 'boxed' === settings.content_width ) { #>
			</div>
		<# } #>
		<?php
	}

	/**
	 * Before rendering the container content. (Print the opening tag, etc.)
	 *
	 * @return void
	 */
	public function before_render() {
		$settings = $this->get_settings_for_display();
		$link = $settings['link'];

		if ( ! empty( $link['url'] ) ) {
			$this->add_link_attributes( '_wrapper', $link );
		}

		if ( ! empty( $settings['thegem_ken_burns_active'] ) ) {
			$this->add_render_attribute( '_wrapper', 'class', 'thegem-ken-burns-block' );
		}

		?><<?php $this->print_html_tag(); ?> <?php $this->print_render_attribute_string( '_wrapper' ); ?>>
		<?php
		if ( $this->is_boxed_container( $settings ) ) { ?>
			<div class="e-con-inner">
		<?php }

		if (!empty($settings['thegem_ken_burns_active'])) {
			wp_enqueue_style('thegem-container-ken-burns');
			wp_enqueue_script('thegem-container-ken-burns');

			$transition = $settings['thegem_ken_burns_transition'] ?? 500;
			$slides_data = [];
			$first_slide_attrs = [];

			if (!empty($settings['thegem_ken_burns_slides'])) {
				foreach ($settings['thegem_ken_burns_slides'] as $i => $slide) {
					if (!empty($slide['image']['url'])) {
						$slide_data = [
							'url' => $slide['image']['url'],
							'duration' => !empty($slide['animation_duration']) ? $slide['animation_duration'] : (count($settings['thegem_ken_burns_slides']) > 1 ? 5000 : 15000),
							'direction' => $slide['animation_direction'] ?? 'zoom-in'
						];

						$slides_data[] = $slide_data;

						if ($i === 0) {
							$first_slide_attrs = [
								'style' => 'background-image: url(' . esc_url($slide['image']['url']) . ')',
								'data-direction' => $slide_data['direction'],
								'data-duration' => $slide_data['duration']
							];
						}
					}
				}
			}

			$this->add_render_attribute('ken_burns_wrapper', [
				'class' => 'thegem-ken-burns-bg',
				'data-transition' => $transition,
				'data-slides' => htmlspecialchars(json_encode($slides_data), ENT_QUOTES, 'UTF-8'),
			]);

			$this->add_render_attribute('first_slide', [
				'class' => 'thegem-ken-burns-slide',
			] + $first_slide_attrs);

			echo '<div ' . $this->get_render_attribute_string('ken_burns_wrapper') . '>';
			echo '<div ' . $this->get_render_attribute_string('first_slide') . '></div>';
			echo '</div>';

			if (!empty($first_slide_attrs)) {
				echo '<style>#elementor-element-' . $this->get_id() . ' .thegem-ken-burns-bg {';
				echo '--duration: ' . ($first_slide_attrs['data-duration'] ?? 5000) . 'ms;';
				echo '--transition: ' . $transition . 'ms;';
				echo '}</style>';
			}
		}

		$this->render_video_background();

		if ( ! empty( $settings['shape_divider_top'] ) ) {
			$this->render_shape_divider( 'top' );
		}

		if ( ! empty( $settings['shape_divider_bottom'] ) ) {
			$this->render_shape_divider( 'bottom' );
		}
	}

}
