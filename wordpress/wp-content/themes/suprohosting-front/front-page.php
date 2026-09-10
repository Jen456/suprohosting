<?php
/**
 * SuproHosting V2 commercial landing and front-end flow.
 *
 * @package SuproHostingFront
 */

get_header( 'supro' );
?>

<svg class="supro-icon-sprite" aria-hidden="true" focusable="false">
	<symbol id="supro-i-server" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="7" rx="2"/><rect x="3" y="14" width="18" height="7" rx="2"/><path d="M7 6.5h.01M7 17.5h.01M11 6.5h6M11 17.5h6"/></symbol>
	<symbol id="supro-i-headset" viewBox="0 0 24 24"><path d="M4 14v-2a8 8 0 0 1 16 0v2"/><path d="M18 19c0 1.1-.9 2-2 2h-4"/><rect x="2" y="13" width="4" height="6" rx="2"/><rect x="18" y="13" width="4" height="6" rx="2"/></symbol>
	<symbol id="supro-i-receipt" viewBox="0 0 24 24"><path d="M6 3h12v18l-3-2-3 2-3-2-3 2V3Z"/><path d="M9 8h6M9 12h6M9 16h3"/></symbol>
	<symbol id="supro-i-shield" viewBox="0 0 24 24"><path d="M12 3 20 6v6c0 5-3.4 8-8 9-4.6-1-8-4-8-9V6l8-3Z"/><path d="m9 12 2 2 4-5"/></symbol>
	<symbol id="supro-i-domain" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.2 2.5 3.3 5.5 3.3 9S14.2 18.5 12 21M12 3c-2.2 2.5-3.3 5.5-3.3 9S9.8 18.5 12 21"/></symbol>
	<symbol id="supro-i-mail" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></symbol>
	<symbol id="supro-i-cloud" viewBox="0 0 24 24"><path d="M7 18h11a4 4 0 0 0 .5-8A7 7 0 0 0 5 9.5 4.5 4.5 0 0 0 7 18Z"/><path d="m10 15 2-2 2 2M12 13v6"/></symbol>
	<symbol id="supro-i-cart" viewBox="0 0 24 24"><path d="M3 4h2l2.3 10h10.8l2-7H6"/><circle cx="9" cy="19" r="1.5"/><circle cx="18" cy="19" r="1.5"/></symbol>
	<symbol id="supro-i-erp" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M8 8h8M8 12h3M14 12h2M8 16h3M14 16h2"/></symbol>
	<symbol id="supro-i-camera" viewBox="0 0 24 24"><path d="M4 7h11a2 2 0 0 1 2 2v7H4V7Z"/><path d="m17 11 4-2v7l-4-2M8 20h5M10.5 16v4"/></symbol>
	<symbol id="supro-i-code" viewBox="0 0 24 24"><path d="m8 7-5 5 5 5M16 7l5 5-5 5M14 4l-4 16"/></symbol>
	<symbol id="supro-i-grid" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></symbol>
	<symbol id="supro-i-speed" viewBox="0 0 24 24"><path d="M4 18a9 9 0 1 1 16 0"/><path d="m12 14 4-5"/><circle cx="12" cy="15" r="2"/></symbol>
	<symbol id="supro-i-backup" viewBox="0 0 24 24"><path d="M4 12a8 8 0 1 0 2-5.3"/><path d="M4 4v5h5"/><path d="M12 8v4l3 2"/></symbol>
	<symbol id="supro-i-lock" viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3M12 14v3"/></symbol>
	<symbol id="supro-i-support" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/><path d="m5.6 5.6 3.6 3.6M14.8 14.8l3.6 3.6M18.4 5.6l-3.6 3.6M9.2 14.8l-3.6 3.6"/></symbol>
</svg>

<main id="contenido" class="supro-main">
	<section class="supro-hero-v2" aria-labelledby="hero-title">
		<div class="supro-hero-v2__orb supro-hero-v2__orb--one" aria-hidden="true"></div>
		<div class="supro-hero-v2__orb supro-hero-v2__orb--two" aria-hidden="true"></div>
		<div class="supro-container supro-hero-v2__grid">
			<div class="supro-hero-v2__copy" data-reveal>
				<p class="supro-eyebrow"><span></span><?php esc_html_e( 'Hosting ecuatoriano, de verdad', 'suprohosting-front' ); ?></p>
				<h1 id="hero-title"><?php esc_html_e( 'Tu negocio en línea.', 'suprohosting-front' ); ?> <em><?php esc_html_e( 'Nuestra infraestructura detrás.', 'suprohosting-front' ); ?></em></h1>
				<p class="supro-hero-v2__lead"><?php esc_html_e( 'Hosting administrado sobre infraestructura propia, con soporte real en español y factura ecuatoriana.', 'suprohosting-front' ); ?></p>
				<div class="supro-actions">
					<a class="supro-button supro-button--lime" href="#hosting"><?php esc_html_e( 'Elegir mi hosting', 'suprohosting-front' ); ?> <span aria-hidden="true">→</span></a>
					<a class="supro-text-link supro-text-link--light" href="#dominios"><?php esc_html_e( 'Ya tengo un dominio', 'suprohosting-front' ); ?> <span aria-hidden="true">↓</span></a>
				</div>
				<ul class="supro-hero-v2__proof" aria-label="<?php esc_attr_e( 'Ventajas SuproHosting', 'suprohosting-front' ); ?>">
					<li><span>01</span><?php esc_html_e( 'Proxmox propio', 'suprohosting-front' ); ?></li>
					<li><span>02</span><?php esc_html_e( 'Correo iRedMail', 'suprohosting-front' ); ?></li>
					<li><span>03</span><?php esc_html_e( 'Equipo local', 'suprohosting-front' ); ?></li>
				</ul>
			</div>

			<div class="supro-hero-scene" data-reveal>
				<div class="supro-hero-scene__photo">
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/datacenter-technician.webp' ); ?>" alt="<?php esc_attr_e( 'Técnico trabajando en infraestructura de centro de datos', 'suprohosting-front' ); ?>">
					<div class="supro-hero-scene__shade"></div>
					<div class="supro-hero-scene__top"><span><i></i><?php esc_html_e( 'Infraestructura operativa', 'suprohosting-front' ); ?></span><b><?php esc_html_e( 'En línea', 'suprohosting-front' ); ?></b></div>
					<div class="supro-hero-scene__caption"><small><?php esc_html_e( 'Administrado por SuproHosting', 'suprohosting-front' ); ?></small><strong><?php esc_html_e( 'Control local. Alcance global.', 'suprohosting-front' ); ?></strong></div>
				</div>
				<article class="supro-float-card supro-float-card--mail"><svg><use href="#supro-i-mail"></use></svg><div><small><?php esc_html_e( 'Correo propio', 'suprohosting-front' ); ?></small><strong>iRedMail</strong></div><span>✓</span></article>
				<article class="supro-float-card supro-float-card--server"><svg><use href="#supro-i-server"></use></svg><div><small><?php esc_html_e( 'Virtualización', 'suprohosting-front' ); ?></small><strong>Proxmox</strong></div><span>✓</span></article>
				<div class="supro-route-dot supro-route-dot--a" aria-hidden="true"></div><div class="supro-route-dot supro-route-dot--b" aria-hidden="true"></div>
			</div>
		</div>
	</section>

	<section class="supro-reasons" aria-label="<?php esc_attr_e( 'Razones para elegir SuproHosting', 'suprohosting-front' ); ?>">
		<div class="supro-container supro-reasons__grid">
			<article data-reveal><span class="supro-icon-box supro-icon-box--blue"><svg><use href="#supro-i-server"></use></svg></span><div><small>01 · <?php esc_html_e( 'Control', 'suprohosting-front' ); ?></small><h2><?php esc_html_e( 'Infraestructura que conocemos', 'suprohosting-front' ); ?></h2><p><?php esc_html_e( 'Operamos la base tecnológica y respondemos por ella.', 'suprohosting-front' ); ?></p></div></article>
			<article data-reveal><span class="supro-icon-box supro-icon-box--green"><svg><use href="#supro-i-headset"></use></svg></span><div><small>02 · <?php esc_html_e( 'Cercanía', 'suprohosting-front' ); ?></small><h2><?php esc_html_e( 'Soporte que sí conversa', 'suprohosting-front' ); ?></h2><p><?php esc_html_e( 'Personas en español, con contexto de tu negocio.', 'suprohosting-front' ); ?></p></div></article>
			<article data-reveal><span class="supro-icon-box supro-icon-box--amber"><svg><use href="#supro-i-receipt"></use></svg></span><div><small>03 · <?php esc_html_e( 'Confianza', 'suprohosting-front' ); ?></small><h2><?php esc_html_e( 'Factura en Ecuador', 'suprohosting-front' ); ?></h2><p><?php esc_html_e( 'Contratación clara y respaldo comercial local.', 'suprohosting-front' ); ?></p></div></article>
		</div>
	</section>

	<section class="supro-section supro-hosting" id="hosting" aria-labelledby="hosting-title">
		<div class="supro-container">
			<div class="supro-hosting__head">
				<div class="supro-section-heading" data-reveal>
					<p class="supro-kicker"><?php esc_html_e( 'El punto de partida', 'suprohosting-front' ); ?></p>
					<h2 id="hosting-title"><?php esc_html_e( 'Una base sólida para cada etapa.', 'suprohosting-front' ); ?></h2>
					<p><?php esc_html_e( 'Elige según el momento de tu proyecto. Conectarás dominio, correo y extras en el siguiente paso.', 'suprohosting-front' ); ?></p>
				</div>
				<div class="supro-carousel-nav" aria-label="<?php esc_attr_e( 'Controles de planes', 'suprohosting-front' ); ?>"><button type="button" data-carousel-prev="plans" aria-label="<?php esc_attr_e( 'Plan anterior', 'suprohosting-front' ); ?>">←</button><button type="button" data-carousel-next="plans" aria-label="<?php esc_attr_e( 'Plan siguiente', 'suprohosting-front' ); ?>">→</button></div>
			</div>

			<div class="supro-plan-carousel owl-carousel" data-carousel="plans">
				<article class="supro-plan-v2">
					<div class="supro-plan-v2__top"><p>START</p><span>01</span></div>
					<h3><?php esc_html_e( 'Presencia', 'suprohosting-front' ); ?></h3>
					<p class="supro-plan-v2__promise"><?php esc_html_e( 'Para lanzar tu primera web profesional con una base segura.', 'suprohosting-front' ); ?></p>
					<div class="supro-plan-v2__price"><strong><?php esc_html_e( 'Cotización automática', 'suprohosting-front' ); ?></strong><small><?php esc_html_e( 'Alta y renovación visibles antes de pagar', 'suprohosting-front' ); ?></small></div>
					<ul><li><?php esc_html_e( 'Un proyecto web', 'suprohosting-front' ); ?></li><li><?php esc_html_e( 'SSL y respaldos incluidos', 'suprohosting-front' ); ?></li><li><?php esc_html_e( 'Dominio elegible el primer año', 'suprohosting-front' ); ?></li><li><?php esc_html_e( 'Soporte de puesta en marcha', 'suprohosting-front' ); ?></li></ul>
					<button class="supro-button supro-button--outline" type="button" data-start-flow data-plan="Hosting START"><?php esc_html_e( 'Configurar START', 'suprohosting-front' ); ?> <span>→</span></button>
				</article>

				<article class="supro-plan-v2 supro-plan-v2--featured">
					<span class="supro-plan-v2__badge"><?php esc_html_e( 'Más elegido', 'suprohosting-front' ); ?></span>
					<div class="supro-plan-v2__top"><p>GROW</p><span>02</span></div>
					<h3><?php esc_html_e( 'Negocio', 'suprohosting-front' ); ?></h3>
					<p class="supro-plan-v2__promise"><?php esc_html_e( 'Para crecer, vender y trabajar con más capacidad.', 'suprohosting-front' ); ?></p>
					<div class="supro-plan-v2__price"><strong><?php esc_html_e( 'Cotización automática', 'suprohosting-front' ); ?></strong><small><?php esc_html_e( 'Alta y renovación visibles antes de pagar', 'suprohosting-front' ); ?></small></div>
					<ul><li><?php esc_html_e( 'Sitios y tienda en línea', 'suprohosting-front' ); ?></li><li><?php esc_html_e( 'Más recursos y rendimiento', 'suprohosting-front' ); ?></li><li><?php esc_html_e( 'Migración asistida', 'suprohosting-front' ); ?></li><li><?php esc_html_e( 'Monitoreo y soporte prioritario', 'suprohosting-front' ); ?></li></ul>
					<button class="supro-button supro-button--lime" type="button" data-start-flow data-plan="Hosting GROW"><?php esc_html_e( 'Configurar GROW', 'suprohosting-front' ); ?> <span>→</span></button>
				</article>

				<article class="supro-plan-v2">
					<div class="supro-plan-v2__top"><p>SCALE</p><span>03</span></div>
					<h3><?php esc_html_e( 'Operación', 'suprohosting-front' ); ?></h3>
					<p class="supro-plan-v2__promise"><?php esc_html_e( 'Para aplicaciones y operaciones que no pueden detenerse.', 'suprohosting-front' ); ?></p>
					<div class="supro-plan-v2__price"><strong><?php esc_html_e( 'Diseño a tu medida', 'suprohosting-front' ); ?></strong><small><?php esc_html_e( 'Alcance y renovación documentados', 'suprohosting-front' ); ?></small></div>
					<ul><li><?php esc_html_e( 'Recursos dedicados', 'suprohosting-front' ); ?></li><li><?php esc_html_e( 'Arquitectura administrada', 'suprohosting-front' ); ?></li><li><?php esc_html_e( 'Continuidad y recuperación', 'suprohosting-front' ); ?></li><li><?php esc_html_e( 'Acompañamiento de ingeniería', 'suprohosting-front' ); ?></li></ul>
					<button class="supro-button supro-button--outline" type="button" data-start-flow data-plan="Hosting SCALE"><?php esc_html_e( 'Diseñar SCALE', 'suprohosting-front' ); ?> <span>→</span></button>
				</article>
			</div>
			<p class="supro-catalog-note"><span>i</span><?php esc_html_e( 'Las capacidades y los precios definitivos se sincronizarán con el catálogo comercial; no se han inventado valores en este prototipo.', 'suprohosting-front' ); ?></p>
		</div>
	</section>

	<section class="supro-domain-stage" id="dominios" aria-labelledby="domain-title">
		<div class="supro-domain-stage__grid" aria-hidden="true"></div>
		<div class="supro-container supro-domain-stage__layout">
			<div class="supro-domain-stage__copy" data-reveal>
				<p class="supro-kicker supro-kicker--light"><?php esc_html_e( 'Conecta tu nombre', 'suprohosting-front' ); ?></p>
				<h2 id="domain-title"><?php esc_html_e( '¿Tu hosting necesita dominio?', 'suprohosting-front' ); ?></h2>
				<p><?php esc_html_e( 'Busca el nombre, revisa alternativas y conéctalo al plan que elijas. Si ya tienes uno, lo configuramos contigo.', 'suprohosting-front' ); ?></p>
				<div class="supro-domain-perks"><span><svg><use href="#supro-i-domain"></use></svg><?php esc_html_e( 'Búsqueda simple', 'suprohosting-front' ); ?></span><span><svg><use href="#supro-i-shield"></use></svg><?php esc_html_e( 'DNS protegido', 'suprohosting-front' ); ?></span><span><svg><use href="#supro-i-headset"></use></svg><?php esc_html_e( 'Conexión asistida', 'suprohosting-front' ); ?></span></div>
			</div>
			<div class="supro-domain-console" data-reveal>
				<div class="supro-domain-console__bar"><span></span><span></span><span></span><p><?php esc_html_e( 'Buscador de dominios', 'suprohosting-front' ); ?></p></div>
				<div class="supro-domain-console__body">
					<?php echo supro_front_domain_checker(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<div class="supro-tld-strip" aria-label="<?php esc_attr_e( 'Extensiones sugeridas', 'suprohosting-front' ); ?>"><span>.com</span><span>.net</span><span>.org</span><span>.ec</span><span>.com.ec</span></div>
				</div>
			</div>
		</div>
	</section>

	<section class="supro-section supro-email" id="correo" aria-labelledby="email-title">
		<div class="supro-container supro-email__grid">
			<div class="supro-email__visual" data-reveal>
				<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/business-owner.webp' ); ?>" alt="<?php esc_attr_e( 'Profesional trabajando con sus canales digitales', 'suprohosting-front' ); ?>">
				<div class="supro-email__message"><span class="supro-icon-box supro-icon-box--green"><svg><use href="#supro-i-mail"></use></svg></span><div><small><?php esc_html_e( 'Mensaje entregado', 'suprohosting-front' ); ?></small><strong>ventas@tuempresa.com</strong></div><i>✓</i></div>
				<div class="supro-email__stamp"><b>SPF</b><b>DKIM</b><b>DMARC</b></div>
			</div>
			<div class="supro-email__content" data-reveal>
				<p class="supro-kicker"><?php esc_html_e( 'Correo corporativo', 'suprohosting-front' ); ?></p>
				<h2 id="email-title"><?php esc_html_e( 'Que cada mensaje hable bien de tu empresa.', 'suprohosting-front' ); ?></h2>
				<p><?php esc_html_e( 'Cuentas con tu dominio, administradas sobre nuestro servidor iRedMail y configuradas por personas.', 'suprohosting-front' ); ?></p>
				<div class="supro-email__bento">
					<article><span>01</span><h3><?php esc_html_e( 'Tu propia identidad', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Correos con el nombre de tu empresa.', 'suprohosting-front' ); ?></p></article>
					<article class="is-blue"><span>02</span><h3><?php esc_html_e( 'Entrega protegida', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Autenticación, antispam y buenas prácticas.', 'suprohosting-front' ); ?></p></article>
					<article class="is-wide"><span>03</span><h3><?php esc_html_e( 'Migración acompañada', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Movemos tus cuentas y te ayudamos a configurar los equipos.', 'suprohosting-front' ); ?></p></article>
				</div>
				<button class="supro-button supro-button--dark" type="button" data-start-flow data-plan="Correo Corporativo"><?php esc_html_e( 'Configurar mi correo', 'suprohosting-front' ); ?> <span>→</span></button>
			</div>
		</div>
	</section>

	<section class="supro-vps" id="vps" aria-labelledby="vps-title">
		<div class="supro-vps__glow" aria-hidden="true"></div>
		<div class="supro-container">
			<div class="supro-vps__head">
				<div class="supro-section-heading" data-reveal><p class="supro-kicker supro-kicker--light"><?php esc_html_e( 'VPS sobre Proxmox', 'suprohosting-front' ); ?></p><h2 id="vps-title"><?php esc_html_e( 'Más control para lo que hace funcionar tu negocio.', 'suprohosting-front' ); ?></h2><p><?php esc_html_e( 'Servidores virtuales dimensionados por caso de uso, con administración local cuando la necesitas.', 'suprohosting-front' ); ?></p></div>
				<div class="supro-carousel-nav supro-carousel-nav--dark"><button type="button" data-carousel-prev="vps" aria-label="<?php esc_attr_e( 'Caso anterior', 'suprohosting-front' ); ?>">←</button><button type="button" data-carousel-next="vps" aria-label="<?php esc_attr_e( 'Caso siguiente', 'suprohosting-front' ); ?>">→</button></div>
			</div>
			<div class="supro-vps-carousel owl-carousel" data-carousel="vps">
				<article class="supro-use-card supro-use-card--cyan"><span class="supro-use-card__number">01</span><svg><use href="#supro-i-cart"></use></svg><p><?php esc_html_e( 'Comercio', 'suprohosting-front' ); ?></p><h3><?php esc_html_e( 'Tiendas y WooCommerce', 'suprohosting-front' ); ?></h3><span class="supro-use-card__link"><?php esc_html_e( 'Rendimiento para vender', 'suprohosting-front' ); ?> ↗</span></article>
				<article class="supro-use-card supro-use-card--lime"><span class="supro-use-card__number">02</span><svg><use href="#supro-i-erp"></use></svg><p><?php esc_html_e( 'Operación', 'suprohosting-front' ); ?></p><h3><?php esc_html_e( 'Odoo, ERP y facturación', 'suprohosting-front' ); ?></h3><span class="supro-use-card__link"><?php esc_html_e( 'Continuidad para operar', 'suprohosting-front' ); ?> ↗</span></article>
				<article class="supro-use-card supro-use-card--amber"><span class="supro-use-card__number">03</span><svg><use href="#supro-i-camera"></use></svg><p><?php esc_html_e( 'Seguridad', 'suprohosting-front' ); ?></p><h3><?php esc_html_e( 'Video y control de acceso', 'suprohosting-front' ); ?></h3><span class="supro-use-card__link"><?php esc_html_e( 'Datos siempre disponibles', 'suprohosting-front' ); ?> ↗</span></article>
				<article class="supro-use-card supro-use-card--blue"><span class="supro-use-card__number">04</span><svg><use href="#supro-i-code"></use></svg><p><?php esc_html_e( 'Desarrollo', 'suprohosting-front' ); ?></p><h3><?php esc_html_e( 'Pruebas y aplicaciones', 'suprohosting-front' ); ?></h3><span class="supro-use-card__link"><?php esc_html_e( 'Entornos bajo control', 'suprohosting-front' ); ?> ↗</span></article>
			</div>
			<div class="supro-vps__footer"><p><?php esc_html_e( '¿No sabes cuánto necesitas? Te ayudamos a dimensionarlo.', 'suprohosting-front' ); ?></p><button class="supro-button supro-button--ghost-light" type="button" data-start-flow data-plan="VPS administrado"><?php esc_html_e( 'Configurar un VPS', 'suprohosting-front' ); ?> <span>→</span></button></div>
		</div>
	</section>

	<section class="supro-section supro-journey" id="proceso" aria-labelledby="journey-title">
		<div class="supro-container">
			<div class="supro-section-heading supro-section-heading--center" data-reveal><p class="supro-kicker"><?php esc_html_e( 'Puesta en marcha guiada', 'suprohosting-front' ); ?></p><h2 id="journey-title"><?php esc_html_e( 'De elegir a publicar, sin perderte.', 'suprohosting-front' ); ?></h2><p><?php esc_html_e( 'Un recorrido corto que conserva tus decisiones y deja la complejidad técnica detrás.', 'suprohosting-front' ); ?></p></div>
			<div class="supro-journey__line" aria-hidden="true"><span></span><span></span><span></span><span></span></div>
			<ol class="supro-journey__steps">
				<li data-reveal><span>01</span><div><small><?php esc_html_e( 'Primero', 'suprohosting-front' ); ?></small><h3><?php esc_html_e( 'Elige', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Selecciona hosting, correo o VPS.', 'suprohosting-front' ); ?></p></div></li>
				<li data-reveal><span>02</span><div><small><?php esc_html_e( 'Después', 'suprohosting-front' ); ?></small><h3><?php esc_html_e( 'Conecta', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Registra, transfiere o usa tu dominio.', 'suprohosting-front' ); ?></p></div></li>
				<li data-reveal><span>03</span><div><small><?php esc_html_e( 'A tu manera', 'suprohosting-front' ); ?></small><h3><?php esc_html_e( 'Configura', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Añade correo, respaldo y soporte.', 'suprohosting-front' ); ?></p></div></li>
				<li data-reveal><span>04</span><div><small><?php esc_html_e( 'Listo', 'suprohosting-front' ); ?></small><h3><?php esc_html_e( 'Publica', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Recibe accesos y administra todo.', 'suprohosting-front' ); ?></p></div></li>
			</ol>
			<div class="supro-journey__action"><button class="supro-button" type="button" data-start-flow data-plan="Hosting GROW"><?php esc_html_e( 'Probar el recorrido', 'suprohosting-front' ); ?> <span>→</span></button><small><?php esc_html_e( 'Demo visual: no genera órdenes ni cobros.', 'suprohosting-front' ); ?></small></div>
		</div>
	</section>

	<section class="supro-section supro-panel" id="panel" aria-labelledby="panel-title">
		<div class="supro-container">
			<div class="supro-panel__intro" data-reveal><div><p class="supro-kicker"><?php esc_html_e( 'Panel Supro', 'suprohosting-front' ); ?></p><h2 id="panel-title"><?php esc_html_e( 'Todo lo importante, sin ruido.', 'suprohosting-front' ); ?></h2></div><p><?php esc_html_e( 'Servicios, dominios, correo, facturas y soporte en una vista clara; los accesos técnicos siguen disponibles cuando hacen falta.', 'suprohosting-front' ); ?></p></div>
			<div class="supro-panel__showcase">
				<div class="supro-dashboard" data-reveal>
					<aside><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/icon-suprohosting.svg' ); ?>" alt=""><span class="is-active"><svg><use href="#supro-i-grid"></use></svg></span><span><svg><use href="#supro-i-server"></use></svg></span><span><svg><use href="#supro-i-domain"></use></svg></span><span><svg><use href="#supro-i-mail"></use></svg></span></aside>
					<div class="supro-dashboard__main">
						<header><div><small><?php esc_html_e( 'Buenos días', 'suprohosting-front' ); ?></small><strong><?php esc_html_e( 'Tu operación está saludable', 'suprohosting-front' ); ?></strong></div><span>JS</span></header>
						<div class="supro-dashboard__metrics"><article><small><?php esc_html_e( 'Servicios', 'suprohosting-front' ); ?></small><b>03</b><i>+1</i></article><article><small><?php esc_html_e( 'Estado', 'suprohosting-front' ); ?></small><b><?php esc_html_e( 'OK', 'suprohosting-front' ); ?></b><i>✓</i></article><article><small><?php esc_html_e( 'Por pagar', 'suprohosting-front' ); ?></small><b>$0</b><i>✓</i></article></div>
						<div class="supro-dashboard__service"><div class="supro-dashboard__service-head"><span>S</span><div><small>Hosting GROW</small><strong>suprohosting.com</strong></div><i><?php esc_html_e( 'Activo', 'suprohosting-front' ); ?></i></div><div class="supro-dashboard__bars"><span><?php esc_html_e( 'Almacenamiento', 'suprohosting-front' ); ?> <b>42%</b></span><em><i style="width:42%"></i></em><span><?php esc_html_e( 'Transferencia', 'suprohosting-front' ); ?> <b>28%</b></span><em><i style="width:28%"></i></em></div></div>
					</div>
				</div>
				<div class="supro-panel-bento" data-reveal>
					<article class="is-large"><svg><use href="#supro-i-grid"></use></svg><span>01</span><h3><?php esc_html_e( 'Servicios', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Estado, consumo y accesos.', 'suprohosting-front' ); ?></p></article>
					<article><svg><use href="#supro-i-domain"></use></svg><span>02</span><h3><?php esc_html_e( 'Dominios', 'suprohosting-front' ); ?></h3></article>
					<article class="is-green"><svg><use href="#supro-i-mail"></use></svg><span>03</span><h3><?php esc_html_e( 'Correo', 'suprohosting-front' ); ?></h3></article>
					<article><svg><use href="#supro-i-receipt"></use></svg><span>04</span><h3><?php esc_html_e( 'Facturas', 'suprohosting-front' ); ?></h3></article>
					<article class="is-dark"><svg><use href="#supro-i-support"></use></svg><span>05</span><h3><?php esc_html_e( 'Soporte', 'suprohosting-front' ); ?></h3></article>
					<article class="is-wide"><svg><use href="#supro-i-speed"></use></svg><span>06</span><h3><?php esc_html_e( 'Salud y métricas', 'suprohosting-front' ); ?></h3></article>
				</div>
			</div>
			<div class="supro-panel__action"><button class="supro-button supro-button--dark" type="button" data-open-portal><?php esc_html_e( 'Abrir demo del panel', 'suprohosting-front' ); ?> <span>↗</span></button></div>
		</div>
	</section>

	<section class="supro-engineering" id="ingenieria" aria-labelledby="engineering-title">
		<div class="supro-container supro-engineering__grid">
			<div class="supro-engineering__photos" data-reveal>
				<div class="supro-engineering__photo supro-engineering__photo--main"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/onsite-technician.webp' ); ?>" alt="<?php esc_attr_e( 'Especialista de Supro trabajando en sitio', 'suprohosting-front' ); ?>"><span><?php esc_html_e( 'Capacidad en sitio', 'suprohosting-front' ); ?></span></div>
				<div class="supro-engineering__photo supro-engineering__photo--small"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/network-rack.webp' ); ?>" alt="<?php esc_attr_e( 'Infraestructura de red', 'suprohosting-front' ); ?>"><span><?php esc_html_e( 'Red e infraestructura', 'suprohosting-front' ); ?></span></div>
				<div class="supro-engineering__mark">SH<span>+</span></div>
			</div>
			<div class="supro-engineering__copy" data-reveal>
				<p class="supro-kicker supro-kicker--amber"><?php esc_html_e( 'Ingeniería Supro', 'suprohosting-front' ); ?></p>
				<h2 id="engineering-title"><?php esc_html_e( 'Cuando tu proyecto supera un plan.', 'suprohosting-front' ); ?></h2>
				<p><?php esc_html_e( 'Diseñamos, conectamos y protegemos soluciones que mezclan nube, infraestructura física y software.', 'suprohosting-front' ); ?></p>
				<div class="supro-engineering__list"><article><span>01</span><div><h3><?php esc_html_e( 'Infraestructura y redes', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Servidores, virtualización, conectividad y continuidad.', 'suprohosting-front' ); ?></p></div></article><article><span>02</span><div><h3><?php esc_html_e( 'Software y automatización', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Portales, integraciones y procesos conectados.', 'suprohosting-front' ); ?></p></div></article><article><span>03</span><div><h3><?php esc_html_e( 'Seguridad y proyectos smart', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Protección, video, accesos y monitoreo.', 'suprohosting-front' ); ?></p></div></article></div>
				<a class="supro-button supro-button--amber" href="https://wa.me/593968279747" rel="noopener"><?php esc_html_e( 'Cotizar con un especialista', 'suprohosting-front' ); ?> <span>↗</span></a>
			</div>
		</div>
	</section>

	<section class="supro-section supro-stories" aria-labelledby="stories-title">
		<div class="supro-container">
			<div class="supro-stories__head"><div class="supro-section-heading" data-reveal><p class="supro-kicker"><?php esc_html_e( 'Resultados que se sienten', 'suprohosting-front' ); ?></p><h2 id="stories-title"><?php esc_html_e( 'Negocios que ya avanzan con Supro.', 'suprohosting-front' ); ?></h2></div><div class="supro-carousel-nav"><button type="button" data-carousel-prev="stories" aria-label="<?php esc_attr_e( 'Testimonio anterior', 'suprohosting-front' ); ?>">←</button><button type="button" data-carousel-next="stories" aria-label="<?php esc_attr_e( 'Testimonio siguiente', 'suprohosting-front' ); ?>">→</button></div></div>
			<div class="supro-stories-carousel owl-carousel" data-carousel="stories">
				<blockquote class="supro-story"><span class="supro-story__quote">“</span><p><?php esc_html_e( 'Lo que más valoramos es que no solo nos ofrecieron un servicio, sino una solución pensada para nuestro negocio. Hoy contamos con una plataforma más seria, comunicación más ordenada y una presencia digital que transmite confianza.', 'suprohosting-front' ); ?></p><footer><span>WP</span><div><strong>William’s Private Services</strong><small>Brooklyn, New York</small></div></footer></blockquote>
				<blockquote class="supro-story supro-story--blue"><span class="supro-story__quote">“</span><p><?php esc_html_e( 'Como marca de estética y nutrición, necesitábamos una presencia digital que transmitiera confianza, elegancia y profesionalismo. SuproHosting nos ayudó a estructurar mejor nuestra imagen online y presentar nuestros servicios de una forma más clara.', 'suprohosting-front' ); ?></p><footer><span>NL</span><div><strong>Nutriesthetic LV</strong><small>Guayaquil, Ecuador</small></div></footer></blockquote>
				<blockquote class="supro-story supro-story--green"><span class="supro-story__quote">“</span><p><?php esc_html_e( 'Recomiendo SuproHosting a profesionales, arquitectos y empresas constructoras que quieren verse más sólidos en internet y convertir su presencia digital en una herramienta comercial real.', 'suprohosting-front' ); ?></p><footer><span>JA</span><div><strong>Arq. Jaime Ayaica</strong><small>Construcciones Inmobiliarias</small></div></footer></blockquote>
			</div>
		</div>
	</section>

	<section class="supro-section supro-faq" id="preguntas" aria-labelledby="faq-title">
		<div class="supro-container supro-faq__grid">
			<div class="supro-faq__intro" data-reveal><p class="supro-kicker"><?php esc_html_e( 'Respuestas claras', 'suprohosting-front' ); ?></p><h2 id="faq-title"><?php esc_html_e( 'Antes de comenzar.', 'suprohosting-front' ); ?></h2><p><?php esc_html_e( 'Si tu caso es distinto, el equipo lo revisa contigo antes de contratar.', 'suprohosting-front' ); ?></p><a class="supro-text-link" href="https://wa.me/593968279747" rel="noopener"><?php esc_html_e( 'Hacer otra pregunta', 'suprohosting-front' ); ?> <span>↗</span></a></div>
			<div class="supro-accordion" data-reveal>
				<details open><summary><?php esc_html_e( '¿Qué significa que la infraestructura sea propia?', 'suprohosting-front' ); ?><span></span></summary><p><?php esc_html_e( 'Que SuproHosting administra directamente su entorno de virtualización Proxmox y toma responsabilidad operativa sobre el servicio.', 'suprohosting-front' ); ?></p></details>
				<details><summary><?php esc_html_e( '¿El soporte está en Ecuador?', 'suprohosting-front' ); ?><span></span></summary><p><?php esc_html_e( 'Sí. Recibes atención en español y acompañamiento comercial y técnico local.', 'suprohosting-front' ); ?></p></details>
				<details><summary><?php esc_html_e( '¿Puedo migrar mi sitio actual?', 'suprohosting-front' ); ?><span></span></summary><p><?php esc_html_e( 'Sí. Revisamos el origen, preparamos la migración y validamos el funcionamiento antes del cambio final.', 'suprohosting-front' ); ?></p></details>
				<details><summary><?php esc_html_e( '¿El dominio viene incluido?', 'suprohosting-front' ); ?><span></span></summary><p><?php esc_html_e( 'La propuesta contempla un dominio elegible durante el primer año en planes seleccionados. La extensión y la renovación se mostrarán antes del pago.', 'suprohosting-front' ); ?></p></details>
				<details><summary><?php esc_html_e( '¿Puedo usar un dominio que ya tengo?', 'suprohosting-front' ); ?><span></span></summary><p><?php esc_html_e( 'Sí. Puedes mantenerlo con tu proveedor y apuntarlo al hosting, o solicitar ayuda para transferirlo cuando aplique.', 'suprohosting-front' ); ?></p></details>
				<details><summary><?php esc_html_e( '¿Cómo se comprueba la disponibilidad del dominio?', 'suprohosting-front' ); ?><span></span></summary><p><?php esc_html_e( 'El buscador realiza una consulta inicial; disponibilidad y precio se vuelven a confirmar antes de registrar.', 'suprohosting-front' ); ?></p></details>
				<details><summary><?php esc_html_e( '¿El correo usa mi propio dominio?', 'suprohosting-front' ); ?><span></span></summary><p><?php esc_html_e( 'Sí. Las cuentas se crean con el dominio de tu empresa y se configuran con autenticación y protección antispam.', 'suprohosting-front' ); ?></p></details>
				<details><summary><?php esc_html_e( '¿Cuándo necesito un VPS?', 'suprohosting-front' ); ?><span></span></summary><p><?php esc_html_e( 'Cuando una tienda, ERP, aplicación o sistema necesita recursos aislados, mayor control o una configuración especial.', 'suprohosting-front' ); ?></p></details>
				<details><summary><?php esc_html_e( '¿Recibo factura ecuatoriana?', 'suprohosting-front' ); ?><span></span></summary><p><?php esc_html_e( 'Sí. La contratación se realiza con respaldo comercial local y emisión de factura en Ecuador.', 'suprohosting-front' ); ?></p></details>
				<details><summary><?php esc_html_e( '¿Dónde administro mis servicios?', 'suprohosting-front' ); ?><span></span></summary><p><?php esc_html_e( 'En el portal del cliente podrás revisar servicios, dominios, correo, facturas y solicitudes de soporte.', 'suprohosting-front' ); ?></p></details>
			</div>
		</div>
	</section>
</main>

<div class="supro-modal supro-modal--flow" data-flow-modal hidden>
	<div class="supro-modal__backdrop" data-close-flow></div>
	<section class="supro-flow" role="dialog" aria-modal="true" aria-labelledby="flow-title" tabindex="-1">
		<header class="supro-flow__head">
			<div><p><?php esc_html_e( 'Configurador Supro', 'suprohosting-front' ); ?></p><h2 id="flow-title"><?php esc_html_e( 'Prepara tu servicio', 'suprohosting-front' ); ?></h2></div>
			<button class="supro-icon-button" type="button" data-close-flow aria-label="<?php esc_attr_e( 'Cerrar configurador', 'suprohosting-front' ); ?>">×</button>
		</header>
		<ol class="supro-flow__steps" aria-label="<?php esc_attr_e( 'Pasos del configurador', 'suprohosting-front' ); ?>">
			<li class="is-active" data-step-indicator="1"><span>1</span><small><?php esc_html_e( 'Elige', 'suprohosting-front' ); ?></small></li>
			<li data-step-indicator="2"><span>2</span><small><?php esc_html_e( 'Conecta', 'suprohosting-front' ); ?></small></li>
			<li data-step-indicator="3"><span>3</span><small><?php esc_html_e( 'Configura', 'suprohosting-front' ); ?></small></li>
			<li data-step-indicator="4"><span>4</span><small><?php esc_html_e( 'Publica', 'suprohosting-front' ); ?></small></li>
		</ol>
		<div class="supro-flow__body">
			<section class="supro-flow-panel is-active" data-flow-step="1">
				<div class="supro-flow-panel__title"><span>01</span><div><h3><?php esc_html_e( 'Confirma tu punto de partida', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Puedes cambiar de opción sin perder el resto del recorrido.', 'suprohosting-front' ); ?></p></div></div>
				<div class="supro-selected-product"><span class="supro-icon-box supro-icon-box--blue"><svg><use href="#supro-i-server"></use></svg></span><div><small><?php esc_html_e( 'Servicio seleccionado', 'suprohosting-front' ); ?></small><strong data-selected-plan>Hosting GROW</strong></div><i>✓</i></div>
				<fieldset class="supro-flow-options"><legend><?php esc_html_e( 'Otras opciones', 'suprohosting-front' ); ?></legend><label><input type="radio" name="flow-plan" value="Hosting START"><span><b>START</b><small><?php esc_html_e( 'Para comenzar', 'suprohosting-front' ); ?></small></span></label><label><input type="radio" name="flow-plan" value="Hosting GROW"><span><b>GROW</b><small><?php esc_html_e( 'Para crecer', 'suprohosting-front' ); ?></small></span></label><label><input type="radio" name="flow-plan" value="Hosting SCALE"><span><b>SCALE</b><small><?php esc_html_e( 'Para escalar', 'suprohosting-front' ); ?></small></span></label></fieldset>
			</section>

			<section class="supro-flow-panel" data-flow-step="2" hidden>
				<div class="supro-flow-panel__title"><span>02</span><div><h3><?php esc_html_e( 'Conecta tu dominio', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Elige la ruta que corresponde a tu proyecto.', 'suprohosting-front' ); ?></p></div></div>
				<fieldset class="supro-path-options"><legend class="screen-reader-text"><?php esc_html_e( 'Opciones de dominio', 'suprohosting-front' ); ?></legend><label><input type="radio" name="domain-path" value="register" checked><span><svg><use href="#supro-i-domain"></use></svg><b><?php esc_html_e( 'Quiero registrar uno', 'suprohosting-front' ); ?></b><small><?php esc_html_e( 'Confirmaremos precio y disponibilidad.', 'suprohosting-front' ); ?></small></span></label><label><input type="radio" name="domain-path" value="existing"><span><svg><use href="#supro-i-cloud"></use></svg><b><?php esc_html_e( 'Ya tengo dominio', 'suprohosting-front' ); ?></b><small><?php esc_html_e( 'Te ayudamos a conectarlo.', 'suprohosting-front' ); ?></small></span></label><label><input type="radio" name="domain-path" value="later"><span><svg><use href="#supro-i-backup"></use></svg><b><?php esc_html_e( 'Lo haré después', 'suprohosting-front' ); ?></b><small><?php esc_html_e( 'Continúa sin bloquear el alta.', 'suprohosting-front' ); ?></small></span></label></fieldset>
				<label class="supro-field"><span><?php esc_html_e( 'Dominio', 'suprohosting-front' ); ?></span><input name="flow-domain" type="text" placeholder="tunegocio.com" autocomplete="off"><small><?php esc_html_e( 'En producción se validará en tiempo real antes de cobrar.', 'suprohosting-front' ); ?></small></label>
			</section>

			<section class="supro-flow-panel" data-flow-step="3" hidden>
				<div class="supro-flow-panel__title"><span>03</span><div><h3><?php esc_html_e( 'Configura lo esencial', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Solo pedimos los datos necesarios para preparar la orden.', 'suprohosting-front' ); ?></p></div></div>
				<div class="supro-flow-form"><label class="supro-field"><span><?php esc_html_e( 'Nombre o empresa', 'suprohosting-front' ); ?></span><input name="customer-name" type="text" placeholder="Tu empresa"></label><label class="supro-field"><span><?php esc_html_e( 'Correo de contacto', 'suprohosting-front' ); ?></span><input name="customer-email" type="email" placeholder="hola@tuempresa.com"></label></div>
				<fieldset class="supro-extra-options"><legend><?php esc_html_e( 'Añade acompañamiento', 'suprohosting-front' ); ?></legend><label><input type="checkbox" name="extra" value="Correo corporativo"><span><svg><use href="#supro-i-mail"></use></svg><b><?php esc_html_e( 'Correo corporativo', 'suprohosting-front' ); ?></b><small><?php esc_html_e( 'Con tu dominio', 'suprohosting-front' ); ?></small></span></label><label><input type="checkbox" name="extra" value="Migración asistida"><span><svg><use href="#supro-i-backup"></use></svg><b><?php esc_html_e( 'Migración asistida', 'suprohosting-front' ); ?></b><small><?php esc_html_e( 'Nos encargamos del traslado', 'suprohosting-front' ); ?></small></span></label><label><input type="checkbox" name="extra" value="Soporte prioritario"><span><svg><use href="#supro-i-headset"></use></svg><b><?php esc_html_e( 'Soporte prioritario', 'suprohosting-front' ); ?></b><small><?php esc_html_e( 'Acompañamiento ampliado', 'suprohosting-front' ); ?></small></span></label></fieldset>
				<div class="supro-payment-note"><svg><use href="#supro-i-lock"></use></svg><div><strong><?php esc_html_e( 'Pago seguro en la siguiente fase', 'suprohosting-front' ); ?></strong><p><?php esc_html_e( 'Este prototipo no solicita datos de tarjeta. En producción verás total, impuestos y renovación antes de confirmar.', 'suprohosting-front' ); ?></p></div></div>
			</section>

			<section class="supro-flow-panel" data-flow-step="4" hidden>
				<div class="supro-review" data-review-state>
					<div class="supro-flow-panel__title"><span>04</span><div><h3><?php esc_html_e( 'Revisa y publica', 'suprohosting-front' ); ?></h3><p><?php esc_html_e( 'Así se verá el resumen antes de entrar al pago real.', 'suprohosting-front' ); ?></p></div></div>
					<dl><div><dt><?php esc_html_e( 'Servicio', 'suprohosting-front' ); ?></dt><dd data-review-plan>Hosting GROW</dd></div><div><dt><?php esc_html_e( 'Dominio', 'suprohosting-front' ); ?></dt><dd data-review-domain><?php esc_html_e( 'Por definir', 'suprohosting-front' ); ?></dd></div><div><dt><?php esc_html_e( 'Extras', 'suprohosting-front' ); ?></dt><dd data-review-extras><?php esc_html_e( 'Sin extras', 'suprohosting-front' ); ?></dd></div><div><dt><?php esc_html_e( 'Precio y renovación', 'suprohosting-front' ); ?></dt><dd><?php esc_html_e( 'Se mostrarán antes de pagar', 'suprohosting-front' ); ?></dd></div></dl>
					<div class="supro-review__assurance"><span>✓</span><?php esc_html_e( 'Factura ecuatoriana y soporte local incluidos en la experiencia.', 'suprohosting-front' ); ?></div>
				</div>
				<div class="supro-activation" data-activation-state hidden><span class="supro-activation__icon" data-activation-icon>↻</span><h3 data-activation-title><?php esc_html_e( 'Preparando tu servicio…', 'suprohosting-front' ); ?></h3><p data-activation-copy><?php esc_html_e( 'Esta animación representa el pago y el aprovisionamiento automático.', 'suprohosting-front' ); ?></p><div class="supro-activation__bar"><span data-activation-progress></span></div><ul><li class="is-done"><?php esc_html_e( 'Orden validada', 'suprohosting-front' ); ?></li><li data-activation-item><?php esc_html_e( 'Configurando infraestructura', 'suprohosting-front' ); ?></li><li data-activation-item><?php esc_html_e( 'Creando accesos', 'suprohosting-front' ); ?></li></ul></div>
			</section>
		</div>
		<footer class="supro-flow__footer"><button class="supro-button supro-button--text" type="button" data-flow-back hidden>← <?php esc_html_e( 'Atrás', 'suprohosting-front' ); ?></button><p><?php esc_html_e( 'Prototipo de interacción · sin cobros', 'suprohosting-front' ); ?></p><button class="supro-button" type="button" data-flow-next><?php esc_html_e( 'Continuar', 'suprohosting-front' ); ?> →</button></footer>
	</section>
</div>

<div class="supro-modal supro-modal--portal" id="portal-demo" data-portal-modal hidden>
	<div class="supro-modal__backdrop" data-close-portal></div>
	<section class="supro-portal" role="dialog" aria-modal="true" aria-labelledby="portal-modal-title" tabindex="-1">
		<aside class="supro-portal__side">
			<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/icon-suprohosting.svg' ); ?>" alt="SuproHosting">
			<nav aria-label="<?php esc_attr_e( 'Portal del cliente', 'suprohosting-front' ); ?>"><button class="is-active"><svg><use href="#supro-i-grid"></use></svg><?php esc_html_e( 'Resumen', 'suprohosting-front' ); ?></button><button><svg><use href="#supro-i-server"></use></svg><?php esc_html_e( 'Servicios', 'suprohosting-front' ); ?></button><button><svg><use href="#supro-i-domain"></use></svg><?php esc_html_e( 'Dominios', 'suprohosting-front' ); ?></button><button><svg><use href="#supro-i-mail"></use></svg><?php esc_html_e( 'Correo', 'suprohosting-front' ); ?></button><button><svg><use href="#supro-i-receipt"></use></svg><?php esc_html_e( 'Facturas', 'suprohosting-front' ); ?></button><button><svg><use href="#supro-i-support"></use></svg><?php esc_html_e( 'Soporte', 'suprohosting-front' ); ?></button></nav>
			<p><?php esc_html_e( 'Demo visual V2.1', 'suprohosting-front' ); ?></p>
		</aside>
		<div class="supro-portal__main">
			<header><div><small><?php esc_html_e( 'Portal del cliente', 'suprohosting-front' ); ?></small><h2 id="portal-modal-title"><?php esc_html_e( 'Tu infraestructura', 'suprohosting-front' ); ?></h2></div><div><span class="supro-portal__help"><?php esc_html_e( '¿Necesitas ayuda?', 'suprohosting-front' ); ?></span><span class="supro-portal__avatar">JS</span><button class="supro-icon-button" type="button" data-close-portal aria-label="<?php esc_attr_e( 'Cerrar portal', 'suprohosting-front' ); ?>">×</button></div></header>
			<div class="supro-portal__welcome"><div><p><?php esc_html_e( 'Buenos días', 'suprohosting-front' ); ?></p><span><?php esc_html_e( 'Todos tus servicios están operativos.', 'suprohosting-front' ); ?></span></div><span class="supro-chip supro-chip--success"><i></i><?php esc_html_e( 'Sistema saludable', 'suprohosting-front' ); ?></span></div>
			<div class="supro-portal__metrics"><article><svg><use href="#supro-i-server"></use></svg><div><small><?php esc_html_e( 'Servicios activos', 'suprohosting-front' ); ?></small><strong>03</strong></div></article><article><svg><use href="#supro-i-domain"></use></svg><div><small><?php esc_html_e( 'Dominios', 'suprohosting-front' ); ?></small><strong>02</strong></div></article><article><svg><use href="#supro-i-receipt"></use></svg><div><small><?php esc_html_e( 'Facturas pendientes', 'suprohosting-front' ); ?></small><strong>$0,00</strong></div></article><article><svg><use href="#supro-i-speed"></use></svg><div><small><?php esc_html_e( 'Estado', 'suprohosting-front' ); ?></small><strong><?php esc_html_e( 'OK', 'suprohosting-front' ); ?></strong></div></article></div>
			<div class="supro-portal__columns"><section><div class="supro-portal__section-head"><h3><?php esc_html_e( 'Mis servicios', 'suprohosting-front' ); ?></h3><button><?php esc_html_e( 'Ver todos', 'suprohosting-front' ); ?></button></div><article class="supro-portal__service"><div class="supro-portal__service-title"><span>S</span><div><small>Hosting GROW</small><strong>suprohosting.com</strong></div><i><?php esc_html_e( 'Activo', 'suprohosting-front' ); ?></i></div><div class="supro-portal__usage"><div><span><?php esc_html_e( 'Almacenamiento', 'suprohosting-front' ); ?></span><b>42%</b></div><div class="supro-progress"><span style="width:42%"></span></div><div><span><?php esc_html_e( 'Transferencia', 'suprohosting-front' ); ?></span><b>28%</b></div><div class="supro-progress"><span style="width:28%"></span></div></div><div class="supro-portal__service-actions"><button data-demo-action><?php esc_html_e( 'Administrar hosting', 'suprohosting-front' ); ?> ↗</button><button data-demo-action><?php esc_html_e( 'Abrir correo', 'suprohosting-front' ); ?> ↗</button></div></article></section><aside><div class="supro-portal__section-head"><h3><?php esc_html_e( 'Actividad reciente', 'suprohosting-front' ); ?></h3></div><ol class="supro-activity"><li><span>✓</span><div><strong><?php esc_html_e( 'Backup completado', 'suprohosting-front' ); ?></strong><small><?php esc_html_e( 'Hoy, 03:15', 'suprohosting-front' ); ?></small></div></li><li><span>↻</span><div><strong><?php esc_html_e( 'SSL renovado', 'suprohosting-front' ); ?></strong><small><?php esc_html_e( 'Ayer, 22:40', 'suprohosting-front' ); ?></small></div></li><li><span>▣</span><div><strong><?php esc_html_e( 'Factura pagada', 'suprohosting-front' ); ?></strong><small><?php esc_html_e( '2 sep, 10:12', 'suprohosting-front' ); ?></small></div></li></ol></aside></div>
		</div>
	</section>
</div>

<div class="supro-toast" data-toast role="status" aria-live="polite" hidden></div>
<?php
get_footer( 'supro' );
