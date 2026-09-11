<?php

namespace TheGem_Elementor\Widgets\TheGem_Image_Compare;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

if (!defined('ABSPATH')) exit;

#[AllowDynamicProperties]
class TheGem_Image_Compare extends Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		if (!defined('THEGEM_ELEMENTOR_WIDGET_IMAGE_COMPARE_DIR')) {
			define('THEGEM_ELEMENTOR_WIDGET_IMAGE_COMPARE_DIR', rtrim(__DIR__, ' /\\'));
		}

		if (!defined('THEGEM_ELEMENTOR_WIDGET_IMAGE_COMPARE_URL')) {
			define('THEGEM_ELEMENTOR_WIDGET_IMAGE_COMPARE_URL', rtrim(plugin_dir_url(__FILE__), ' /\\'));
		}

		wp_register_style('thegem-image-compare', THEGEM_ELEMENTOR_WIDGET_IMAGE_COMPARE_URL . '/assets/css/thegem-image-compare.css');
		wp_register_script('thegem-image-compare', THEGEM_ELEMENTOR_WIDGET_IMAGE_COMPARE_URL . '/assets/js/thegem-image-compare.js', array( 'jquery' ), null, true );
	}

	public function get_name() {
		return 'thegem-image-compare';
	}

	public function get_title() {
		return esc_html__('Image Compare', 'thegem');
	}

	public function get_icon() {
		return str_replace('thegem-', 'thegem-eicon thegem-eicon-', $this->get_name());
	}

	public function get_categories() {
		return ['thegem_elements'];
	}

	public function get_style_depends() {
		return ['thegem-image-compare'];
	}

	public function get_script_depends() {
		return ['thegem-image-compare'];
	}

	public function is_reload_preview_required() {
		return true;
	}

	protected function register_controls() {

		// Content Section
		$this->start_controls_section(
			'section_images',
			[
				'label' => esc_html__('Images', 'thegem'),
			]
		);

		$this->start_controls_tabs('images_tabs');

		$this->start_controls_tab(
			'tab_before',
			[
				'label' => esc_html__('Before', 'thegem'),
			]
		);

		$this->add_control(
			'image_before',
			[
				'label' => esc_html__('Image Before', 'thegem'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'label_before',
			[
				'label' => esc_html__('Label Before', 'thegem'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Before', 'thegem'),
			]
		);
		$this->add_control(
			'label_before_position',
			[
				'label' => __('Label Position', 'thegem'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __('Top', 'thegem'),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __('Center', 'thegem'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', 'thegem'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top' => 'top: 10px; bottom: auto;',
					'middle' => 'top: 50%; bottom: auto; transform: transitionY(-50%);',
					'bottom' => 'top: auto; bottom: 10px;',
				],
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-label-before' => '{{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_after',
			[
				'label' => esc_html__('After', 'thegem'),
			]
		);

		$this->add_control(
			'image_after',
			[
				'label' => esc_html__('Image After', 'thegem'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'label_after',
			[
				'label' => esc_html__('Label After', 'thegem'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('After', 'thegem'),
			]
		);
		$this->add_control(
			'label_after_position',
			[
				'label' => __('Label Position', 'thegem'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __('Top', 'thegem'),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __('Center', 'thegem'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', 'thegem'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top' => 'top: 10px; bottom: auto;',
					'middle' => 'top: 50%; bottom: auto; transform: transitionY(-50%);',
					'bottom' => 'top: auto; bottom: 10px;',
				],
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-label-after' => '{{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_size',
				'default' => 'large',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Settings Section
		$this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__('Settings', 'thegem'),
			]
		);

		$this->add_control(
			'initial_offset',
			[
				'label' => esc_html__('Initial Position (%)', 'thegem'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => ['min' => 0, 'max' => 100],
				],
				'default' => ['unit' => '%', 'size' => 50],
			]
		);

		$this->add_control(
			'interaction_mode',
			[
				'label' => esc_html__('Interaction Mode', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'drag' => esc_html__('Drag', 'thegem'),
					'hover' => esc_html__('Hover', 'thegem'),
				],
				'default' => 'drag',
				'prefix_class' => 'thegem-image-compare-mode-',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'orientation',
			[
				'label' => esc_html__('Orientation', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'horizontal' => esc_html__('Horizontal', 'thegem'),
					'vertical' => esc_html__('Vertical', 'thegem'),
				],
				'default' => 'horizontal',
				'prefix_class' => 'thegem-image-compare-',
				'render_type' => 'template',
			]
		);

		$this->end_controls_section();

		// Style: Images Section
		$this->start_controls_section(
			'section_style_images',
			[
				'label' => esc_html__('Images', 'thegem'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'images_border_radius',
			[
				'label' => esc_html__('Border Radius', 'thegem'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('images_filters_tabs');

		$this->start_controls_tab(
			'tab_before_filters',
			[
				'label' => esc_html__('Before', 'thegem'),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_before',
				'selector' => '{{WRAPPER}} .thegem-image-compare-img-before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_after_filters',
			[
				'label' => esc_html__('After', 'thegem'),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_after',
				'selector' => '{{WRAPPER}} .thegem-image-compare-img-after',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Style: Handle Section
		$this->start_controls_section(
			'section_style_handle',
			[
				'label' => esc_html__('Handle', 'thegem'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'handle_line_color',
			[
				'label' => esc_html__('Line Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-handle::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .thegem-image-compare-handle::after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'handle_line_width',
			[
				'label' => esc_html__('Line Width', 'thegem'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => ['min' => 1, 'max' => 10, 'step' => 1],
				],
				'selectors' => [
					'{{WRAPPER}}.thegem-image-compare-horizontal .thegem-image-compare-handle::before' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.thegem-image-compare-horizontal .thegem-image-compare-handle::after' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.thegem-image-compare-vertical .thegem-image-compare-handle::before' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.thegem-image-compare-vertical .thegem-image-compare-handle::after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'handle_box_size',
			[
				'label' => esc_html__('Box Size', 'thegem'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => ['min' => 20, 'max' => 80, 'step' => 1],
				],
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-handle-inner' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.thegem-image-compare-horizontal .thegem-image-compare-handle::before, {{WRAPPER}}.thegem-image-compare-horizontal .thegem-image-compare-handle::after' => 'height: calc(50% - {{SIZE}}{{UNIT}} / 2);',
					'{{WRAPPER}}.thegem-image-compare-vertical .thegem-image-compare-handle::before, {{WRAPPER}}.thegem-image-compare-vertical .thegem-image-compare-handle::after' => 'width: calc(50% - {{SIZE}}{{UNIT}} / 2);',
				],
			]
		);

		$this->add_control(
			'handle_box_background',
			[
				'label' => esc_html__('Box Background', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-handle-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'handle_box_border_width',
			[
				'label' => esc_html__('Border Width', 'thegem'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => ['min' => 0, 'max' => 10, 'step' => 1],
				],
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-handle-inner' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'handle_box_border_color',
			[
				'label' => esc_html__('Border Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-handle-inner' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'handle_box_border_radius',
			[
				'label' => esc_html__('Border Radius', 'thegem'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => ['min' => 0, 'max' => 50, 'step' => 1],
					'%' => ['min' => 0, 'max' => 50, 'step' => 1],
				],
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-handle-inner' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'handle_arrows_color',
			[
				'label' => esc_html__('Arrows Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--thegem-image-compare-arrow-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'handle_shadow',
			[
				'label' => esc_html__('Shadow', 'thegem'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);

		$this->add_control(
			'handle_arrows_size',
			[
				'label' => esc_html__('Arrows Size', 'thegem'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => ['min' => 4, 'max' => 20, 'step' => 1],
				],
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-arrow' => '--thegem-image-compare-arrow-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Style: Labels Section
		$this->start_controls_section(
			'section_style_labels',
			[
				'label' => esc_html__('Labels', 'thegem'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'labels_show_on_hover',
			[
				'label' => esc_html__('Show on Hover', 'thegem'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'prefix_class' => 'thegem-image-compare-labels-hover-',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'label_text_preset',
			[
				'label' => esc_html__('Label Text Style', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __('Default', 'thegem'),
					'title-h1' => __('Title H1', 'thegem'),
					'title-h2' => __('Title H2', 'thegem'),
					'title-h3' => __('Title H3', 'thegem'),
					'title-h4' => __('Title H4', 'thegem'),
					'title-h5' => __('Title H5', 'thegem'),
					'title-h6' => __('Title H6', 'thegem'),
					'title-xlarge' => __('Title xLarge', 'thegem'),
					'styled-subtitle' => __('Styled Subtitle', 'thegem'),
					'main-menu-item' => __('Main Menu', 'thegem'),
					'text-body' => __('Body', 'thegem'),
					'text-body-tiny' => __('Tiny Body', 'thegem'),
				],
				'default' => '',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'label_text_weight',
			[
				'label' => esc_html__('Label Text Weight', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __('Default', 'thegem'),
					'bold' => __('Bold', 'thegem'),
					'light' => __('Light', 'thegem'),
				],
				'default' => '',
			]
		);

		$this->start_controls_tabs('labels_styles_tabs');

		$this->start_controls_tab(
			'tab_label_before',
			[
				'label' => esc_html__('Before', 'thegem'),
			]
		);

		$this->add_control(
			'label_before_color',
			[
				'label' => esc_html__('Text Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-label-before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'label_before_background',
			[
				'label' => esc_html__('Background Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-label-before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_label_after',
			[
				'label' => esc_html__('After', 'thegem'),
			]
		);

		$this->add_control(
			'label_after_color',
			[
				'label' => esc_html__('Text Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-label-after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'label_after_background',
			[
				'label' => esc_html__('Background Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-label-after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'labels_padding',
			[
				'label' => esc_html__('Padding', 'thegem'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .thegem-image-compare-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if (empty($settings['image_before']['url']) || empty($settings['image_after']['url'])) {
			echo '<div class="elementor-alert elementor-alert-warning">' . esc_html__('Please select both Image Before and Image After.', 'thegem') . '</div>';
			return;
		}

		$image_before_url = Group_Control_Image_Size::get_attachment_image_src($settings['image_before']['id'], 'image_size', $settings);
		$image_after_url = Group_Control_Image_Size::get_attachment_image_src($settings['image_after']['id'], 'image_size', $settings);

		if (!$image_before_url) $image_before_url = $settings['image_before']['url'];
		if (!$image_after_url) $image_after_url = $settings['image_after']['url'];

		$this->add_render_attribute('wrapper', 'class', [
			'thegem-image-compare-wrapper',
			'thegem-image-compare-orientation-' . $settings['orientation'],
			'thegem-image-compare-mode-' . $settings['interaction_mode']
		]);

		$this->add_render_attribute('wrapper', 'data-offset', $settings['initial_offset']['size'] / 100);
		$this->add_render_attribute('wrapper', 'data-orientation', $settings['orientation']);
		$this->add_render_attribute('wrapper', 'data-interaction-mode', $settings['interaction_mode']);
		$this->add_render_attribute('wrapper', 'dir', is_rtl() ? 'rtl' : 'ltr');

		$label_text_classes = !empty($settings['label_text_preset']) ? $settings['label_text_preset'] : 'text-style-default';
		if(!empty($settings['label_text_weight'])) {
			$label_text_classes = ' ' . $settings['label_text_weight'];
		}

		?>
		<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
			<div class="thegem-image-compare-viewport">
				<div class="thegem-image-compare-img-before-wrapper">
					<img class="thegem-image-compare-img thegem-image-compare-img-before" src="<?php echo esc_url($image_before_url); ?>" alt="<?php echo esc_attr( \Elementor\Control_Media::get_image_alt($settings['image_before']) ); ?>">
					<?php if (!empty($settings['label_before'])) : ?>
						<span class="thegem-image-compare-label thegem-image-compare-label-before <?php echo $label_text_classes; ?>"><?php echo esc_html($settings['label_before']); ?></span>
					<?php endif; ?>
				</div>
				<div class="thegem-image-compare-img-after-wrapper">
					<img class="thegem-image-compare-img thegem-image-compare-img-after" src="<?php echo esc_url($image_after_url); ?>" alt="<?php echo esc_attr( \Elementor\Control_Media::get_image_alt($settings['image_after']) ); ?>">
					<?php if (!empty($settings['label_after'])) : ?>
						<span class="thegem-image-compare-label thegem-image-compare-label-after <?php echo $label_text_classes; ?>"><?php echo esc_html($settings['label_after']); ?></span>
					<?php endif; ?>
				</div>
				<div class="thegem-image-compare-handle<?php echo empty($settings['handle_shadow']) ? '' : ' with-shadow'; ?>">
					<div class="thegem-image-compare-handle-inner">
						<div class="thegem-image-compare-arrow thegem-image-compare-arrow-left"></div>
						<div class="thegem-image-compare-arrow thegem-image-compare-arrow-right"></div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register(new TheGem_Image_Compare());