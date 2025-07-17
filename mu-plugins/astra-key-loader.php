<?php
/*
Plugin Name: Astra Key Loader
Description: Carga la licencia de Astra desde servidor remoto.
*/

add_action('init', function() {
    if (defined('ASTRA_EXT_PRO_LICENSE_KEY')) return; // ya definida

    $dominio = parse_url(home_url(), PHP_URL_HOST);
    $url = 'https://tu-dominio.com/licencias/consulta.php?dominio=' . $dominio . '&token=TU_TOKEN_SECRETO';

    $licencia = wp_remote_get($url);
    if (is_array($licencia) && isset($licencia['body']) && !empty($licencia['body'])) {
        define('ASTRA_EXT_PRO_LICENSE_KEY', trim($licencia['body']));
    }
});
