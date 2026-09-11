<?php
/**
 * Isolated header for the SuproHosting landing.
 *
 * @package SuproHostingFront
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="supro-skip-link" href="#contenido"><?php esc_html_e( 'Saltar al contenido', 'suprohosting-front' ); ?></a>

<div class="supro-announcement">
	<div class="supro-container supro-announcement__inner">
		<p><span aria-hidden="true"></span><?php esc_html_e( 'Infraestructura propia · soporte real desde Ecuador', 'suprohosting-front' ); ?></p>
		<a href="https://wa.me/593968279747" rel="noopener"><?php esc_html_e( 'Hablar con soporte', 'suprohosting-front' ); ?> <span aria-hidden="true">↗</span></a>
	</div>
</div>

<header class="supro-header" data-header>
	<div class="supro-container supro-header__inner">
		<?php supro_front_brand(); ?>
		<button class="supro-menu-toggle" type="button" aria-expanded="false" aria-controls="supro-primary-nav" data-menu-toggle>
			<span class="screen-reader-text"><?php esc_html_e( 'Abrir menú', 'suprohosting-front' ); ?></span>
			<span></span><span></span><span></span>
		</button>
		<nav id="supro-primary-nav" class="supro-nav" aria-label="<?php esc_attr_e( 'Navegación principal', 'suprohosting-front' ); ?>" data-menu>
			<a href="#hosting"><?php esc_html_e( 'Hosting', 'suprohosting-front' ); ?></a>
			<a href="#dominios"><?php esc_html_e( 'Dominios', 'suprohosting-front' ); ?></a>
			<a href="#correo"><?php esc_html_e( 'Correo', 'suprohosting-front' ); ?></a>
			<a href="#vps"><?php esc_html_e( 'VPS', 'suprohosting-front' ); ?></a>
			<a href="#ingenieria"><?php esc_html_e( 'Ingeniería', 'suprohosting-front' ); ?></a>
			<a class="supro-nav__login" href="#portal-demo" data-open-portal><?php esc_html_e( 'Acceder', 'suprohosting-front' ); ?></a>
			<a class="supro-button supro-button--small" href="#hosting"><?php esc_html_e( 'Elegir hosting', 'suprohosting-front' ); ?></a>
		</nav>
	</div>
</header>
