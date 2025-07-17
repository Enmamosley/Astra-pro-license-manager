<?php
/*
Plugin Name: Astra Key Loader
Description: Carga la licencia de Astra desde servidor remoto de forma segura.
*/

add_action('init', function() {
    if (defined('ASTRA_EXT_PRO_LICENSE_KEY')) return;

    $dominio = parse_url(home_url(), PHP_URL_HOST);
    $token = '4d1f8b3e6c9a2f1e9083eeabc7412f1d23';
    $url = 'https://as.mosley.mx/api/consulta.php?dominio=' . urlencode($dominio) . '&token=' . $token;

    $response = wp_remote_get($url);
    if (is_array($response) && isset($response['body']) && !empty($response['body'])) {
        define('ASTRA_EXT_PRO_LICENSE_KEY', trim($response['body']));
    }
});
