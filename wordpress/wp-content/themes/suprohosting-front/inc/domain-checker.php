<?php
/**
 * Optional Dominion bridge.
 *
 * Dominion 2.2.1 provides the WHOIS lookup used by the first frontend phase.
 * SuproHosting keeps its own accessible form and only consumes Dominion's
 * existing AJAX action. Registration, pricing and checkout remain backend work.
 *
 * @package SuproHostingFront
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether Dominion's domain lookup action is available.
 */
function supro_front_has_dominion() {
	return function_exists( 'domain_search_6_display_func' );
}

/**
 * Build the public configuration used by the child theme's domain form.
 *
 * No Cloudflare, registrar or server credential is ever exposed here.
 *
 * @return array<string, mixed>
 */
function supro_front_domain_config() {
	$enabled = supro_front_has_dominion();

	return array(
		'enabled'     => $enabled,
		'ajaxUrl'     => $enabled ? admin_url( 'admin-ajax.php' ) : '',
		'nonce'       => $enabled ? wp_create_nonce( 'domain_search_6_nonce' ) : '',
		'purchaseUrl' => esc_url_raw(
			apply_filters( 'supro_front_domain_purchase_url', home_url( '/configurar/?domain=' ) )
		),
	);
}

/**
 * Render one stable form for both the visual prototype and Dominion WHOIS mode.
 *
 * @return string
 */
function supro_front_domain_checker() {
	$has_dominion = supro_front_has_dominion();
	ob_start();
	?>
	<form class="supro-domain-form" data-domain-search data-domain-mode="<?php echo $has_dominion ? 'whois' : 'demo'; ?>" novalidate>
		<label class="screen-reader-text" for="supro-domain-name"><?php esc_html_e( 'Nombre de dominio', 'suprohosting-front' ); ?></label>
		<div class="supro-domain-input-wrap">
			<span aria-hidden="true">www.</span>
			<input id="supro-domain-name" name="domain" type="text" inputmode="url" autocomplete="off" placeholder="tunegocio.com" required>
		</div>
		<button class="supro-button supro-button--accent" type="submit"><?php esc_html_e( 'Buscar dominio', 'suprohosting-front' ); ?></button>
	</form>
	<div class="supro-domain-result" data-domain-result role="status" aria-live="polite"></div>
	<?php if ( $has_dominion ) : ?>
		<p class="supro-prototype-note"><span aria-hidden="true">●</span> <?php esc_html_e( 'Consulta WHOIS informativa mediante Dominion. El precio y el registro se confirman antes del pago.', 'suprohosting-front' ); ?></p>
	<?php else : ?>
		<p class="supro-prototype-note"><span aria-hidden="true">●</span> <?php esc_html_e( 'Vista de demostración. Instala Dominion para consultar disponibilidad mediante WHOIS.', 'suprohosting-front' ); ?></p>
	<?php endif; ?>
	<?php
	return ob_get_clean();
}
