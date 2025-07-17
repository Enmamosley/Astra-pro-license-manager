<?php
$dominio = $_GET['dominio'] ?? '';
$token = $_GET['token'] ?? '';

// Seguridad: token simple
define('TOKEN_SECRETO', 'TU_TOKEN_SECRETO');

// Rutas a los archivos
$licencias_file = __DIR__ . '/../data/licencias.json';
$bloqueados_file = __DIR__ . '/../data/bloqueados.json';
$log_file = __DIR__ . '/../data/accesos.log';

// Cargar datos
$licencias = file_exists($licencias_file) ? json_decode(file_get_contents($licencias_file), true) : [];
$bloqueados = file_exists($bloqueados_file) ? json_decode(file_get_contents($bloqueados_file), true) : [];

// Registrar acceso
$log = date('Y-m-d H:i:s') . " - Dominio: $dominio - IP: {$_SERVER['REMOTE_ADDR']}\n";
file_put_contents($log_file, $log, FILE_APPEND);

// Verificación
if (isset($bloqueados[$dominio])) {
    http_response_code(403);
    echo 'Dominio bloqueado';
    exit;
}

if (isset($licencias[$dominio]) && $token === TOKEN_SECRETO) {
    echo $licencias[$dominio];
} else {
    http_response_code(403);
    echo 'Acceso no autorizado';
}
?>
