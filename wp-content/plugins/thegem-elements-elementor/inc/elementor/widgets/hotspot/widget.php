<?php

namespace TheGem_Elementor\Widgets\TheGem_Hotspot;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Plugin;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) exit;

/**
 * Elementor widget for Hotspot.
 */
#[AllowDynamicProperties]
class TheGem_Hotspot extends Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		if (!defined('THEGEM_ELEMENTOR_WIDGET_HOTSPOT_DIR')) {
			define('THEGEM_ELEMENTOR_WIDGET_HOTSPOT_DIR', rtrim(__DIR__, ' /\\'));
		}

		if (!defined('THEGEM_ELEMENTOR_WIDGET_HOTSPOT_URL')) {
			define('THEGEM_ELEMENTOR_WIDGET_HOTSPOT_URL', rtrim(plugin_dir_url(__FILE__), ' /\\'));
		}

		wp_register_style('thegem-hotspot', THEGEM_ELEMENTOR_WIDGET_HOTSPOT_URL . '/assets/css/thegem-hotspot.css');
		wp_register_script('thegem-hotspot', THEGEM_ELEMENTOR_WIDGET_HOTSPOT_URL . '/assets/js/thegem-hotspot.js', array( 'jquery' ), null, true );
	}

	public function get_name() {
		return 'thegem-hotspot';
	}

	public function get_title() {
		return esc_html__('Hotspot', 'thegem');
	}

	public function get_icon() {
		return str_replace('thegem-', 'thegem-eicon thegem-eicon-', $this->get_name());
	}

	public function get_categories() {
		return ['thegem_elements'];
	}

	public function get_style_depends() {
		return ['thegem-hotspot'];
	}

	public function get_script_depends() {
		return ['thegem-hotspot'];
	}

	public function is_reload_preview_required() {
		return true;
	}

	protected function register_controls() {
		$text_preset_options = [
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
		];

		$text_weight_options = [
			'' => __('Default', 'thegem'),
			'bold' => __('Bold', 'thegem'),
			'light' => __('Light', 'thegem'),
		];

		// Content Section: Image
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__('Image', 'thegem'),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'thegem'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'image_size',
			[
				'label' => esc_html__('Image Size', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'default' => 'full',
				'options' => $this->get_image_sizes(), 
			]
		);

		$this->end_controls_section();

		// Content Section: Hotspots Repeater and Global Settings
		$this->start_controls_section(
			'section_hotspots',
			[
				'label' => esc_html__('Hotspots & Settings', 'thegem'),
			]
		);

		// Tooltip Trigger (Required setting)
		$this->add_control(
			'tooltip_trigger',
			[
				'label' => esc_html__('Tooltip Trigger', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'hover' => esc_html__('On Hover', 'thegem'),
					'click' => esc_html__('On Click', 'thegem'),
					'show-always' => esc_html__('Show Always', 'thegem'),
				],
				'default' => 'hover',
				'description' => esc_html__('On mobile devices, "On Click" is always used (unless "Show Always").', 'thegem'),
				'separator' => 'before',
			]
		);

		// Tooltip Appearance Animation (Required setting)
		$this->add_control(
			'tooltip_animation',
			[
				'label' => esc_html__('Tooltip Animation', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'thegem'),
					'fade' => esc_html__('Fade', 'thegem'),
					'slide-up' => esc_html__('Slide Up', 'thegem'),
					'zoom-in' => esc_html__('Zoom In', 'thegem'),
				],
				'default' => 'fade',
				'separator' => 'after',
			]
		);

		// Pulsating Effect
		$this->add_control(
			'pulsating_effect',
			[
				'label' => esc_html__('Pulsating Effect', 'thegem'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('On', 'thegem'),
				'label_off' => esc_html__('Off', 'thegem'),
				'default' => '',
				'return_value' => 'yes',
				'description' => esc_html__('Enable a subtle pulsating animation on the marker.', 'thegem'),
			]
		);

		// Hotspots Repeater setup
		$repeater = new Repeater();

		// ----- Repeater Tabs -----
		$repeater->start_controls_tabs('hotspot_content_tabs');

		// Repeater TAB: Content
		$repeater->start_controls_tab(
			'hotspot_tab_content',
			[
				'label' => esc_html__('Content', 'thegem'),
			]
		);

		$repeater->add_control(
			'hotspot_title',
			[
				'label' => esc_html__('Hotspot Title', 'thegem'),
				'type' => Controls_Manager::TEXT,
				'dynamic' => ['active' => true],
				'default' => 'Hotspot Title',
			]
		);

		$repeater->add_control(
			'hotspot_link',
			[
				'label' => esc_html__('Link', 'thegem'),
				'type' => Controls_Manager::URL,
				'dynamic' => ['active' => true],
				'placeholder' => esc_html__('https://your-link.com', 'thegem'),
			]
		);

		$repeater->add_control(
			'hotspot_icon',
			[
				'label' => esc_html__('Icon', 'thegem'),
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
				'label_block' => false,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'hotspot_label',
			[
				'label' => esc_html__('Label', 'thegem'),
				'type' => Controls_Manager::TEXT,
				'dynamic' => ['active' => true],
				'placeholder' => esc_html__('Label text', 'thegem'),
			]
		);

		$repeater->add_control(
			'tooltip_content_type',
			[
				'label' => esc_html__('Tooltip Content Type', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'text' => esc_html__('Text', 'thegem'),
					'global-section' => esc_html__('Global Section', 'thegem'),
				],
				'default' => 'text',
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'hotspot_content',
			[
				'label' => esc_html__('Tooltip Content', 'thegem'),
				'type' => Controls_Manager::WYSIWYG,
				'dynamic' => ['active' => true],
				'default' => 'This is the tooltip content.',
				'condition' => [
					'tooltip_content_type' => 'text',
				],
			]
		);

		$repeater->add_control(
			'global_section',
			[
				'label' => __('Global Section', 'thegem'),
				'placeholder' => __('Select a global section for as tab content', 'thegem'),
				'label_block' => true,
				'description' => sprintf(
					__('Wondering what is global section or need to create one? Please click %1$shere%2$s ', 'thegem'),
					'<a target="_blank" href="' . esc_url(add_query_arg(array('post_type' => 'thegem_templates', 'templates_type' => 'content'), admin_url( 'edit.php' )).'#open-modal') . '">',
					'</a>'
				),
				'type' => Controls_Manager::SELECT2,
				'options' => thegem_get_section_templates_list(),
				'condition' => [
					'tooltip_content_type' => 'global-section',
				],
				'thegem_template_link' => true,
				'thegem_template_type' => 'content'
			]
		);

		$repeater->add_control(
			'hotspot_css_id',
			[
				'label' => esc_html__('CSS ID', 'thegem'),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'hotspot_css_class',
			[
				'label' => esc_html__('CSS Class', 'thegem'),
				'type' => Controls_Manager::TEXT,
			]
		);

		$repeater->end_controls_tab();

		// Repeater TAB: Position
		$repeater->start_controls_tab(
			'hotspot_tab_position',
			[
				'label' => esc_html__('Position', 'thegem'),
			]
		);

		$repeater->add_control(
			'hotspot_position_x',
			[
				'label' => esc_html__('Position X (%)', 'thegem'),
				'type' => Controls_Manager::SLIDER,
				'default' => ['unit' => '%', 'size' => 50],
				'range' => ['%' => ['min' => 0, 'max' => 100]],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
				],
			]
		);

		$repeater->add_control(
			'hotspot_position_y',
			[
				'label' => esc_html__('Position Y (%)', 'thegem'),
				'type' => Controls_Manager::SLIDER,
				'default' => ['unit' => '%', 'size' => 50],
				'range' => ['%' => ['min' => 0, 'max' => 100]],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
				],
			]
		);

		// Tooltip Position (Individual per item)
		$repeater->add_control(
			'tooltip_position',
			[
				'label' => esc_html__('Tooltip Position', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => esc_html__('Top', 'thegem'),
					'bottom' => esc_html__('Bottom', 'thegem'),
					'left' => esc_html__('Left', 'thegem'),
					'right' => esc_html__('Right', 'thegem'),
				],
				'default' => 'top',
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'marker_animation',
			[
				'label' => esc_html__('Marker Animation', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'thegem'),
					'fade' => esc_html__('Fade In', 'thegem'),
					'scale' => esc_html__('Scale Up', 'thegem'),
					'slide-up' => esc_html__('Slide Up', 'thegem'),
					'slide-down' => esc_html__('Slide Down', 'thegem'),
					'slide-left' => esc_html__('Slide Left', 'thegem'),
					'slide-right' => esc_html__('Slide Right', 'thegem'),
					'bounce' => esc_html__('Bounce In', 'thegem'),
					'zoom-out' => esc_html__('Zoom Out', 'thegem'),
					'rotate' => esc_html__('Rotate In', 'thegem'),
					'flip' => esc_html__('Flip In', 'thegem'),
				],
				'default' => 'none',
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'marker_animation_delay',
			[
				'label' => esc_html__('Animation Delay (ms)', 'thegem'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'min' => 0,
				'step' => 50,
			]
		);

		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$this->add_control(
			'hotspot_list',
			[
				'label' => esc_html__('Hotspot List', 'thegem'),
				'type' => Controls_Manager::REPEATER,
				'show_label' => false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ hotspot_title }}}',
				'default' => [
					['hotspot_title' => 'Hotspot 1', 'hotspot_icon' => ['value' => 'fas fa-circle','library' => 'fa-solid'], 'hotspot_position_x' => ['size' => 50], 'hotspot_position_y' => ['size' => 50], 'tooltip_position' => 'top', 'tooltip_content_type' => 'text'],
				],
			]
		);

		$this->end_controls_section();

		// Style Section: Image
		$this->start_controls_section(
			'style_image',
			[
				'label' => esc_html__('Image', 'thegem'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'thegem'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-image-wrap, {{WRAPPER}} .thegem-hotspot-image-wrap > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .thegem-hotspot-image-wrap',
			]
		);

		$this->end_controls_section();

		// Style Section: Hotspot Marker
		$this->start_controls_section(
			'style_hotspot',
			[
				'label' => esc_html__('Hotspot Marker', 'thegem'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'marker_size',
			[
				'label' => esc_html__('Min Marker Size (px)', 'thegem'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => ['px' => ['min' => 5, 'max' => 100]],
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-marker' => 'min-width: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Icon Size
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size (px)', 'thegem'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => ['px' => ['min' => 5, 'max' => 100]],
				'default' => ['unit' => 'px', 'size' => 10],
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .thegem-hotspot-marker svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		// Icon Gap
		$this->add_control(
			'icon_gap',
			[
				'label' => esc_html__('Icon Gap (px)', 'thegem'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => ['px' => ['min' => 0, 'max' => 20]],
				'default' => ['unit' => 'px', 'size' => 5],
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-marker' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Marker Border
		$this->add_responsive_control(
			'marker_border',
			[
				'label' => esc_html__('Border', 'thegem'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'thegem'),
				'label_off' => esc_html__('Hide', 'thegem'),
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'marker_border_width',
			[
				'label' => esc_html__('Border Width (px)', 'thegem'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-marker' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'marker_border' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'marker_border_radius',
			[
				'label' => esc_html__('Border Radius', 'thegem'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-marker' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'marker_padding',
			[
				'label' => esc_html__('Padding', 'thegem'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-marker' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'label_text_preset',
			[
				'label' => esc_html__('Label Text Style', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => $text_preset_options,
				'default' => '',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'label_text_weight',
			[
				'label' => esc_html__('Label Text Weight', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => $text_weight_options,
				'default' => '',
			]
		);

		$this->start_controls_tabs('tabs_marker_style');

		// Marker Normal State
		$this->start_controls_tab(
			'marker_normal',
			[
				'label' => esc_html__('Normal', 'thegem'),
			]
		);

		$this->add_control(
			'marker_color',
			[
				'label' => esc_html__('Background Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-marker' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'marker_border_color',
			[
				'label' => esc_html__('Border Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-marker' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'marker_border' => 'yes',
				],
			]
		);

		$this->add_control(
			'marker_icon_color',
			[
				'label' => esc_html__('Icon Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-marker i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .thegem-hotspot-marker svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'marker_label_color',
			[
				'label' => esc_html__('Label Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Marker Hover State
		$this->start_controls_tab(
			'marker_hover',
			[
				'label' => esc_html__('Hover', 'thegem'),
			]
		);

		$this->add_control(
			'marker_color_hover',
			[
				'label' => esc_html__('Background Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-marker:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'marker_border_color_hover',
			[
				'label' => esc_html__('Border Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-marker:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'marker_border' => 'yes',
				],
			]
		);

		$this->add_control(
			'marker_icon_color_hover',
			[
				'label' => esc_html__('Icon Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-marker:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .thegem-hotspot-marker:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'marker_label_color_hover',
			[
				'label' => esc_html__('Label Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-marker:hover .thegem-hotspot-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'marker_icon_rotate_hover',
			[
				'label' => esc_html__('Icon Rotate (deg)', 'thegem'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => ['deg' => ['min' => 0, 'max' => 360]],
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-marker:hover .thegem-hotspot-icon' => 'transform: rotate({{SIZE}}deg);',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Style Section: Tooltip
		$this->start_controls_section(
			'style_tooltip',
			[
				'label' => esc_html__('Tooltip', 'thegem'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'tooltip_width',
			[
				'label' => esc_html__('Max Width (px)', 'thegem'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => ['min' => 50, 'max' => 1000],
				],
				'default' => ['unit' => 'px', 'size' => 200],
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-tooltip' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tooltip_padding',
			[
				'label' => esc_html__('Padding', 'thegem'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tooltip_border_radius',
			[
				'label' => esc_html__('Border Radius', 'thegem'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tooltip_bg_color',
			[
				'label' => esc_html__('Background Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-tooltip' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .thegem-hotspot-item.thegem-hotspot-position-top .thegem-hotspot-tooltip::before' => 'border-top-color: {{VALUE}}',
					'{{WRAPPER}} .thegem-hotspot-item.thegem-hotspot-position-bottom .thegem-hotspot-tooltip::before' => 'border-bottom-color: {{VALUE}}',
					'{{WRAPPER}} .thegem-hotspot-item.thegem-hotspot-position-left .thegem-hotspot-tooltip::before' => 'border-left-color: {{VALUE}}',
					'{{WRAPPER}} .thegem-hotspot-item.thegem-hotspot-position-right .thegem-hotspot-tooltip::before' => 'border-right-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tooltip_text_color',
			[
				'label' => esc_html__('Text Color', 'thegem'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thegem-hotspot-tooltip, {{WRAPPER}} .thegem-hotspot-tooltip a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tooltip_title_text_preset',
			[
				'label' => esc_html__('Title Text Style', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => $text_preset_options,
				'default' => '',
			]
		);

		$this->add_control(
			'tooltip_title_font_weight',
			[
				'label' => esc_html__('Title Text Weight', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => $text_weight_options,
				'default' => '',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tooltip_box_shadow',
				'selector' => '{{WRAPPER}} .thegem-hotspot-tooltip',
			]
		);

		$this->end_controls_section();
	}


	public function render() {
		$settings = $this->get_settings_for_display();
		$uniqid = 'hotspot-' . $this->get_id();

		// Get image HTML using selected size
		$image_size = $settings['image_size'] ?? 'full';
		$image_html = '';
		if (!empty($settings['image']['id'])) {
			$image_html = wp_get_attachment_image( $settings['image']['id'], $image_size, false, ['alt' => \Elementor\Control_Media::get_image_alt($settings['image'])] );
		} elseif (!empty($settings['image']['url'])) {
			$image_html = '<img src="' . esc_url($settings['image']['url']) . '" alt="' . esc_attr( \Elementor\Control_Media::get_image_alt($settings['image']) ) . '">';
		}

		if (empty($image_html)) {
			echo '<div class="bordered-box centered-box styled-subtitle">' . esc_html__('Please select an image for the Hotspot widget.', 'thegem') . '</div>';
			return;
		}

		$this->add_render_attribute( 'hotspot-wrap', 'id', [esc_attr($uniqid)]);
		$this->add_render_attribute( 'hotspot-wrap', 'class', [
			'thegem-hotspot-widget',
			'thegem-hotspot-trigger-' . $settings['tooltip_trigger'],
			'thegem-hotspot-animation-' . $settings['tooltip_animation'],
			($settings['pulsating_effect'] === 'yes' ? 'thegem-hotspot-pulsating' : ''),
		]);

		$this->add_render_attribute( 'hotspot-wrap', 'data-trigger', $settings['tooltip_trigger'] );

		?>
		<div <?php echo $this->get_render_attribute_string( 'hotspot-wrap' ); ?>>
			<div class="thegem-hotspot-image-wrap">
				<?php echo $image_html; ?>

				<?php if (!empty($settings['hotspot_list'])) : ?>
					<?php foreach ($settings['hotspot_list'] as $item) : 
						$hotspot_id = 'hotspot-item-' . $item['_id'];
						$item_classes = ['thegem-hotspot-item', 'elementor-repeater-item-' . $item['_id']];

						if (!empty($item['tooltip_position'])) {
							$item_classes[] = 'thegem-hotspot-position-' . $item['tooltip_position'];
						}

						if (!empty($item['hotspot_css_class'])) {
							$item_classes[] = esc_attr($item['hotspot_css_class']);
						}

						// Marker Animation Class
						if (!empty($item['marker_animation']) && $item['marker_animation'] !== 'none') {
							$item_classes[] = 'thegem-hotspot-animated thegem-hotspot-animation-' . esc_attr($item['marker_animation']);
						}

						$this->add_render_attribute($hotspot_id, 'class', $item_classes);

						if (!empty($item['hotspot_css_id'])) {
							$this->add_render_attribute($hotspot_id, 'id', esc_attr($item['hotspot_css_id']));
						}

						// Marker Animation Delay
						$delay = $item['marker_animation_delay'] ?? 0;
						if ($delay > 0) {
							$this->add_render_attribute($hotspot_id, 'style', 'animation-delay: ' . intval($delay) . 'ms;');
						}

						// Marker Content
						$marker_content = '';
						$is_link = !empty($item['hotspot_link']['url']);

						if (!empty($item['hotspot_icon']['value'])) {
							ob_start();
							Icons_Manager::render_icon($item['hotspot_icon'], ['aria-hidden' => 'true', 'class' => 'thegem-hotspot-icon']);
							$marker_content .= ob_get_clean();
						}

						if (!empty($item['hotspot_label'])) {
							$this->add_render_attribute($hotspot_id . '-label', 'class', 'thegem-hotspot-label');
							if(!empty($settings['label_text_preset'])) {
								$this->add_render_attribute($hotspot_id . '-label', 'class', $settings['label_text_preset']);
							} else {
								$this->add_render_attribute($hotspot_id . '-label', 'class', 'text-style-default');
							}
							if(!empty($settings['label_text_weight'])) {
								$this->add_render_attribute($hotspot_id . '-label', 'class', $settings['label_text_weight']);
							}
							$marker_content .= '<span ' . $this->get_render_attribute_string($hotspot_id . '-label') . '>' . esc_html($item['hotspot_label']) . '</span>';
						}

						// Tooltip Content
						$tooltip_content = '';
						if (!empty($item['hotspot_title'])) {
							$this->add_render_attribute($hotspot_id . '-title', 'class', 'thegem-hotspot-tooltip-title');
							if(!empty($settings['tooltip_title_text_preset'])) {
								$this->add_render_attribute($hotspot_id . '-title', 'class', $settings['tooltip_title_text_preset']);
							} else {
								$this->add_render_attribute($hotspot_id . '-title', 'class', 'text-style-default');
							}
							if(!empty($settings['tooltip_title_font_weight'])) {
								$this->add_render_attribute($hotspot_id . '-title', 'class', $settings['tooltip_title_font_weight']);
							}
							$tooltip_content .= '<div ' . $this->get_render_attribute_string($hotspot_id . '-title') . '>' . esc_html($item['hotspot_title']) . '</div>';
						}

						if ($item['tooltip_content_type'] === 'global-section' && !empty($item['global_section'])) {
							$section_content = Plugin::instance()->frontend->get_builder_content_for_display( $item['global_section'] );
							if ($section_content) {
								$tooltip_content .= '<div class="thegem-hotspot-tooltip-content">' . $section_content . '</div>';
							}
						} else {
							$tooltip_content .= '<div class="thegem-hotspot-tooltip-content">' . wp_kses_post($item['hotspot_content']) . '</div>';
						}

						?>
						<div <?php echo $this->get_render_attribute_string($hotspot_id); ?>>
							<?php if ($is_link) : 
								$link_attrs = [
									'href' => esc_url($item['hotspot_link']['url']),
									'class' => 'thegem-hotspot-marker-link',
								];

								if (!empty($item['hotspot_link']['is_external'])) {
									$link_attrs['target'] = '_blank';
								}
								if (!empty($item['hotspot_link']['nofollow'])) {
									$link_attrs['rel'] = 'nofollow';
								}
								$output_attr = '';
								foreach ($link_attrs as $key => $value) {
									if (!empty($value)) {
										$output_attr .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
									}
								}
								?>
								<a <?php echo $this->set_html_attributes($link_attrs); ?>>
									<div class="thegem-hotspot-marker">
										<?php echo $marker_content; ?>
									</div>
								</a>
							<?php else : ?>
								<div class="thegem-hotspot-marker">
									<?php echo $marker_content; ?>
								</div>
							<?php endif; ?>

							<?php if (!empty($tooltip_content)) : ?>
								<div class="thegem-hotspot-tooltip">
									<?php echo $tooltip_content; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	public function get_image_sizes() {
		$image_sizes = get_intermediate_image_sizes();
		$options = ['full' => esc_html__('Full', 'thegem')];
		foreach ($image_sizes as $size) {
			$options[$size] = ucwords(str_replace(['-', '_'], ' ', $size));
		}
		return $options;
	}

	public function set_html_attributes($attrs) {
		$string = '';
		if(is_array($attrs)) {
			foreach($attrs as $key => $value) {
				$string .= ' ' . sanitize_key($key) . '="' . esc_attr($value) . '"';
			}
		}
		return $string;
	}

}

Plugin::instance()->widgets_manager->register(new TheGem_Hotspot());
