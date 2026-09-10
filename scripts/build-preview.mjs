import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const scriptDirectory = path.dirname(fileURLToPath(import.meta.url));
const projectRoot = path.dirname(scriptDirectory);
const themeRoot = path.join(projectRoot, 'wordpress/wp-content/themes/suprohosting-front');
const previewRoot = path.join(projectRoot, 'preview');
const previewAssets = path.join(previewRoot, 'assets');

fs.mkdirSync(previewAssets, { recursive: true });

const header = `<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Prototipo interactivo del nuevo frontend de SuproHosting">
  <title>SuproHosting — Frontend V2.1</title>
  <link rel="icon" href="assets/icon-suprohosting.svg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/supro-front.css">
</head>
<body class="supro-front-active">
<a class="supro-skip-link" href="#contenido">Saltar al contenido</a>
<div class="supro-announcement"><div class="supro-container supro-announcement__inner"><p><span aria-hidden="true"></span>Infraestructura propia · soporte real desde Ecuador</p><a href="https://wa.me/593968279747">Hablar con soporte <span aria-hidden="true">↗</span></a></div></div>
<header class="supro-header" data-header>
  <div class="supro-container supro-header__inner">
    <a class="supro-brand" href="#contenido" aria-label="Inicio — SuproHosting"><img src="assets/logo-suprohosting.png" alt="SuproHosting" width="230" height="100"></a>
    <button class="supro-menu-toggle" type="button" aria-expanded="false" aria-controls="supro-primary-nav" data-menu-toggle><span class="screen-reader-text">Abrir menú</span><span></span><span></span><span></span></button>
    <nav id="supro-primary-nav" class="supro-nav" aria-label="Navegación principal" data-menu>
      <a href="#hosting">Hosting</a><a href="#dominios">Dominios</a><a href="#correo">Correo</a><a href="#vps">VPS</a><a href="#ingenieria">Ingeniería</a><a class="supro-nav__login" href="#portal-demo" data-open-portal>Acceder</a><a class="supro-button supro-button--small" href="#hosting">Elegir hosting</a>
    </nav>
  </div>
</header>`;

const footer = `<footer class="supro-footer" id="soporte">
  <div class="supro-container supro-footer__lead"><div><p class="supro-kicker">¿Listo para ponerlo en línea?</p><h2>Tu proyecto merece una base que responda.</h2></div><a class="supro-button supro-button--lime" href="#hosting">Elegir mi hosting <span aria-hidden="true">→</span></a></div>
  <div class="supro-container supro-footer__grid">
    <div class="supro-footer__brand"><a class="supro-brand" href="#contenido"><img src="assets/logo-suprohosting.png" alt="SuproHosting"></a><p>Infraestructura propia y acompañamiento local para transformar tu operación digital.</p></div>
    <div><h3>Productos</h3><a href="#hosting">Hosting administrado</a><a href="#dominios">Dominios</a><a href="#correo">Correo corporativo</a><a href="#vps">Servidores VPS</a></div>
    <div><h3>Capacidades</h3><a href="#ingenieria">Infraestructura</a><a href="#ingenieria">Desarrollo y automatización</a><a href="#ingenieria">Ciberseguridad</a><a href="#panel">Panel del cliente</a></div>
    <div><h3>Contacto Ecuador</h3><a href="mailto:ventas@suprohosting.com">ventas@suprohosting.com</a><a href="https://wa.me/593968279747">+593 96 827 9747</a><span>Tulcán y Primero de Mayo #1006</span><a href="#preguntas">Preguntas frecuentes</a></div>
  </div>
  <div class="supro-container supro-footer__bottom"><p>© 2026 SuproHosting · PEDESTAL-TEK S.A.</p><p>Transformación digital sin límites</p></div>
</footer>
<script src="assets/supro-front.js"></script>
</body>
</html>`;

const domainFallback = `<form class="supro-domain-form" data-domain-search data-domain-mode="demo" novalidate>
  <label class="screen-reader-text" for="supro-domain-name">Nombre de dominio</label>
  <div class="supro-domain-input-wrap"><span aria-hidden="true">www.</span><input id="supro-domain-name" name="domain" type="text" inputmode="url" autocomplete="off" placeholder="tunegocio.com" required></div>
  <button class="supro-button supro-button--accent" type="submit">Buscar dominio</button>
</form><div class="supro-domain-result" data-domain-result role="status" aria-live="polite"></div><p class="supro-prototype-note"><span aria-hidden="true">●</span> Vista de demostración. En WordPress, instala Dominion para consultar disponibilidad mediante WHOIS.</p>`;

let html = fs.readFileSync(path.join(themeRoot, 'front-page.php'), 'utf8');
html = html.replace(/^<\?php[\s\S]*?get_header\(\s*'supro'\s*\);\s*\?>/, '');
html = html.replace(/<\?php\s+esc_(?:html|attr)_e\(\s*'([^']*)'\s*,\s*'suprohosting-front'\s*\);\s*\?>/g, (_, text) => text);
html = html.replace(/<\?php echo esc_url\( get_stylesheet_directory_uri\(\) \. '\/assets\/images\/([^']+)' \); \?>/g, 'assets/$1');
html = html.replace(/<\?php echo supro_front_domain_checker\(\);[^?]*\?>/, domainFallback);
html = html.replace(/<\?php\s*get_footer\(\s*'supro'\s*\);[\s\S]*$/, '');

if (html.includes('<?php')) {
  throw new Error('La vista previa todavía contiene PHP sin procesar.');
}

fs.writeFileSync(path.join(previewRoot, 'index.html'), `${header}\n${html.trim()}\n${footer}\n`, 'utf8');
fs.copyFileSync(path.join(themeRoot, 'assets/css/supro-front.css'), path.join(previewAssets, 'supro-front.css'));
fs.copyFileSync(path.join(themeRoot, 'assets/js/supro-front.js'), path.join(previewAssets, 'supro-front.js'));

for (const filename of fs.readdirSync(path.join(themeRoot, 'assets/images'))) {
  fs.copyFileSync(path.join(themeRoot, 'assets/images', filename), path.join(previewAssets, filename));
}

console.log('Vista previa regenerada en preview/index.html');
