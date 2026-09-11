<?php
/**
 * Plugin Name: Suprohosting — Endurecimiento
 * Description: Cierra las vías usadas en el incidente 92412623: enumeración de
 *              usuarios, endpoint batch de la REST API y XML-RPC.
 * Version:     1.0
 *
 * Se instala como must-use plugin: se activa solo y no se puede desactivar
 * desde el panel. Para quitarlo, borrá este archivo.
 */
defined('ABSPATH') || exit;

/* ---------------------------------------------------------------------------
 * 1. Enumeración de usuarios por REST API
 *    Antes: /wp-json/wp/v2/users/ devolvía la lista completa a cualquiera.
 *    Es el primer paso de la fuerza bruta que sufrieron estos sitios.
 * ------------------------------------------------------------------------- */
add_filter('rest_endpoints', function ($endpoints) {
    if (is_user_logged_in()) {
        return $endpoints;
    }
    unset($endpoints['/wp/v2/users']);
    unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    return $endpoints;
});

/* ---------------------------------------------------------------------------
 * 2. Enumeración por ?author=N  y por las URLs de autor
 * ------------------------------------------------------------------------- */
add_action('init', function () {
    if (is_admin() || is_user_logged_in()) {
        return;
    }
    if (isset($_GET['author']) && !empty($_GET['author'])) {
        wp_safe_redirect(home_url(), 301);
        exit;
    }
});
add_action('template_redirect', function () {
    if (is_author() && !is_user_logged_in()) {
        wp_safe_redirect(home_url(), 301);
        exit;
    }
});

/* ---------------------------------------------------------------------------
 * 3. Endpoint batch de la REST API
 *    Permite empaquetar decenas de peticiones en una sola y así saltarse
 *    cualquier límite de intentos. En los logs aparecía devolviendo 207.
 * ------------------------------------------------------------------------- */
add_filter('rest_endpoints', function ($endpoints) {
    unset($endpoints['/batch/v1']);
    return $endpoints;
});

/* ---------------------------------------------------------------------------
 * 4. XML-RPC  (solo si el sitio no lo necesita — ver SUPRO_XMLRPC_OFF)
 * ------------------------------------------------------------------------- */
if (defined('SUPRO_XMLRPC_OFF') && SUPRO_XMLRPC_OFF) {
    add_filter('xmlrpc_enabled', '__return_false');
    add_filter('xmlrpc_methods', function () { return array(); });
    add_filter('wp_headers', function ($h) { unset($h['X-Pingback']); return $h; });
}

/* ---------------------------------------------------------------------------
 * 5. Dejar de anunciar la versión de WordPress
 * ------------------------------------------------------------------------- */
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

/* ---------------------------------------------------------------------------
 * 6. Mensajes de login genéricos
 *    Por defecto WordPress dice si el usuario existe o si falla la contraseña.
 *    Eso confirma usuarios válidos al atacante.
 * ------------------------------------------------------------------------- */
add_filter('login_errors', function () {
    return __('Las credenciales no son correctas.');
});
