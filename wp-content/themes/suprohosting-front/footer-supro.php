<?php
/**
 * Isolated footer for the SuproHosting landing.
 *
 * @package SuproHostingFront
 */
?>
<footer class="supro-footer" id="soporte">
	<div class="supro-container supro-footer__lead">
		<div>
			<p class="supro-kicker"><?php esc_html_e( '¿Listo para ponerlo en línea?', 'suprohosting-front' ); ?></p>
			<h2><?php esc_html_e( 'Tu proyecto merece una base que responda.', 'suprohosting-front' ); ?></h2>
		</div>
		<a class="supro-button supro-button--lime" href="#hosting"><?php esc_html_e( 'Elegir mi hosting', 'suprohosting-front' ); ?> <span aria-hidden="true">→</span></a>
	</div>
	<div class="supro-container supro-footer__grid">
		<div class="supro-footer__brand">
			<?php supro_front_brand(); ?>
			<p><?php esc_html_e( 'Infraestructura propia y acompañamiento local para transformar tu operación digital.', 'suprohosting-front' ); ?></p>
		</div>
		<div>
			<h3><?php esc_html_e( 'Productos', 'suprohosting-front' ); ?></h3>
			<a href="#hosting"><?php esc_html_e( 'Hosting administrado', 'suprohosting-front' ); ?></a>
			<a href="#dominios"><?php esc_html_e( 'Dominios', 'suprohosting-front' ); ?></a>
			<a href="#correo"><?php esc_html_e( 'Correo corporativo', 'suprohosting-front' ); ?></a>
			<a href="#vps"><?php esc_html_e( 'Servidores VPS', 'suprohosting-front' ); ?></a>
		</div>
		<div>
			<h3><?php esc_html_e( 'Capacidades', 'suprohosting-front' ); ?></h3>
			<a href="#ingenieria"><?php esc_html_e( 'Infraestructura', 'suprohosting-front' ); ?></a>
			<a href="#ingenieria"><?php esc_html_e( 'Desarrollo y automatización', 'suprohosting-front' ); ?></a>
			<a href="#ingenieria"><?php esc_html_e( 'Ciberseguridad', 'suprohosting-front' ); ?></a>
			<a href="#panel"><?php esc_html_e( 'Panel del cliente', 'suprohosting-front' ); ?></a>
		</div>
		<div>
			<h3><?php esc_html_e( 'Contacto Ecuador', 'suprohosting-front' ); ?></h3>
			<a href="mailto:ventas@suprohosting.com">ventas@suprohosting.com</a>
			<a href="https://wa.me/593968279747" rel="noopener">+593 96 827 9747</a>
			<span><?php esc_html_e( 'Tulcán y Primero de Mayo #1006', 'suprohosting-front' ); ?></span>
			<a href="#preguntas"><?php esc_html_e( 'Preguntas frecuentes', 'suprohosting-front' ); ?></a>
		</div>
	</div>
	<div class="supro-container supro-footer__bottom">
		<p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> SuproHosting · PEDESTAL-TEK S.A.</p>
		<p><?php esc_html_e( 'Transformación digital sin límites', 'suprohosting-front' ); ?></p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
