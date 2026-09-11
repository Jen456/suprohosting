<?php

use Elementor\Controls_Manager;

class TheGem_Ken_Burns {

	private static $instance = null;


	public static function instance() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;

	}

	public function __construct() {

		if (!defined('THEGEM_ELEMENTOR_KEN_BURNS_DIR')) {
			define('THEGEM_ELEMENTOR_KEN_BURNS_DIR', rtrim(__DIR__, ' /\\'));
		}

		if (!defined('THEGEM_ELEMENTOR_KEN_BURNS_URL')) {
			define('THEGEM_ELEMENTOR_KEN_BURNS_URL', rtrim(plugin_dir_url(__FILE__), ' /\\'));
		}

		add_action('elementor/element/container/thegem_background_options/before_section_end', array($this, 'after_section_end'), 10, 2);
		add_action('elementor/frontend/before_enqueue_scripts', array($this, 'enqueue_scripts'), 9);
		add_filter('elementor/element/is_dynamic_content', array($this, 'is_dynamic_content'), 10, 3);
	}

	public function after_section_end($obj, $args) {
		/*$obj->start_controls_section(
			'thegem_ken_burns_section',
			[
				'label' => __('TheGem Ken Burns', 'thegem'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);*/

		$obj->add_control(
			'thegem_ken_burns_heading',
			[
				'label' => __('Ken Burns Effect', 'thegem'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$obj->add_control(
			'thegem_ken_burns_active',
			[
				'label' => __('Ken Burns Effect', 'thegem'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'label_on' => __('On', 'thegem'),
				'label_off' => __('Off', 'thegem'),
				'default' => '',
				'frontend_available' => true,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => __('Choose Image', 'thegem'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'animation_duration',
			[
				'label' => __('Animation Duration (ms)', 'thegem'),
				'type' => Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 30000,
				'step' => 100,
				'default' => '',
			]
		);

		$repeater->add_control(
			'animation_direction',
			[
				'label' => __('Animation Direction', 'thegem'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'zoom-in' => __('Zoom In', 'thegem'),
					'zoom-out' => __('Zoom Out', 'thegem'),
				],
				'default' => 'zoom-in',
			]
		);

		$obj->add_control(
			'thegem_ken_burns_slides',
			[
				'label' => __('Slides', 'thegem'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				//'title_field' => '{{{image.url.split("/").pop()}}}',
				'button_text' => __('Add Slide', 'thegem'),
				'condition' => [
					'thegem_ken_burns_active' => 'yes',
				],
				'frontend_available' => true,
			]
		);

		$obj->add_control(
			'thegem_ken_burns_transition',
			[
				'label' => __('Transition Duration (ms)', 'thegem'),
				'type' => Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 10000,
				'step' => 100,
				'default' => '',
				'condition' => [
					'thegem_ken_burns_active' => 'yes',
				],
				'frontend_available' => true,
			]
		);

		/*$obj->end_controls_section();*/
	}

	public function enqueue_scripts() {
		wp_register_style('thegem-container-ken-burns', THEGEM_ELEMENTOR_KEN_BURNS_URL . '/assets/css/thegem-ken-burns.css');
		wp_register_script('thegem-container-ken-burns', THEGEM_ELEMENTOR_KEN_BURNS_URL . '/assets/js/thegem-ken-burns.js', array('jquery'), null, true);
		if (\Elementor\Plugin::$instance->preview->is_preview_mode()) {
			wp_enqueue_style('thegem-container-ken-burns');
			wp_enqueue_script('thegem-container-ken-burns');
		}
	}

	public function is_dynamic_content($status, $raw_data, $obj) {
		$data = $obj->get_data();
		$type = isset($data['elType']) ? $data['elType'] : 'section';
		$settings = $raw_data['settings'];
		if ('section' === $type || 'column' === $type || 'container' === $type) {
			if (isset($settings['thegem_ken_burns_active']) && $settings['thegem_ken_burns_active'] == 'yes') {
				$status = true;
			}
		}
		return $status;
	}

}

TheGem_Ken_Burns::instance();