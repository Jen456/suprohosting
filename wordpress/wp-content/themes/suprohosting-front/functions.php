<?php
/**
 * SuproHosting Front child theme.
 *
 * @package SuproHostingFront
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SUPRO_FRONT_VERSION', '2.1.0' );

require_once get_stylesheet_directory() . '/inc/domain-checker.php';

/**
 * Theme supports used by the custom landing header.
 */
function supro_front_setup() {
	load_child_theme_textdomain( 'suprohosting-front', get_stylesheet_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 120,
		'width'       => 420,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	register_nav_menus( array(
		'supro_primary' => __( 'Navegación principal SuproHosting', 'suprohosting-front' ),
	) );
}
add_action( 'after_setup_theme', 'supro_front_setup', 20 );

/**
 * Returns true on either of the supplied SuproHosting landing templates.
 */
function supro_front_is_landing() {
	return is_front_page() || is_page_template( 'page-supro-landing.php' );
}

/**
 * Load only the assets used by the new experience.
 */
function supro_front_assets() {
	if ( ! supro_front_is_landing() ) {
		return;
	}

	/* Owl Carousel ships with TheGem. V2 uses the paid theme's own slider engine. */
	wp_enqueue_style( 'owl' );
	wp_enqueue_script( 'owl' );
	wp_enqueue_style(
		'supro-front-fonts',
		'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Roboto+Condensed:wght@700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'supro-front',
		get_stylesheet_directory_uri() . '/assets/css/supro-front.css',
		array( 'owl', 'supro-front-fonts' ),
		SUPRO_FRONT_VERSION
	);

	wp_enqueue_script(
		'supro-front',
		get_stylesheet_directory_uri() . '/assets/js/supro-front.js',
		array( 'jquery', 'owl' ),
		SUPRO_FRONT_VERSION,
		true
	);

	wp_localize_script( 'supro-front', 'suproFrontConfig', array(
		'isPrototype' => true,
		'portalUrl'   => esc_url_raw( apply_filters( 'supro_front_portal_url', '#portal-demo' ) ),
		'whatsappUrl' => esc_url_raw( apply_filters( 'supro_front_whatsapp_url', 'https://wa.me/593968279747' ) ),
		'domain'      => supro_front_domain_config(),
	) );
}
add_action( 'wp_enqueue_scripts', 'supro_front_assets', 30 );

/**
 * Landing-specific body hook.
 *
 * @param string[] $classes Existing body classes.
 * @return string[]
 */
function supro_front_body_classes( $classes ) {
	if ( supro_front_is_landing() ) {
		$classes[] = 'supro-front-active';
	}
	return $classes;
}
add_filter( 'body_class', 'supro_front_body_classes' );

/**
 * Print the configured logo with a bundled fallback.
 */
function supro_front_brand() {
	$logo_id = get_theme_mod( 'custom_logo' );
	$logo    = $logo_id ? wp_get_attachment_image_url( $logo_id, 'full' ) : '';

	if ( ! $logo ) {
		$logo = get_stylesheet_directory_uri() . '/assets/images/logo-suprohosting.png';
	}
	?>
	<a class="supro-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Inicio — SuproHosting', 'suprohosting-front' ); ?>">
		<img src="<?php echo esc_url( $logo ); ?>" alt="SuproHosting" width="230" height="100">
	</a>
	<?php
}
