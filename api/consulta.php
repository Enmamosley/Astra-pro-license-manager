<?php
$dominio = $_GET['dominio'] ?? '';
$token = $_GET['token'] ?? '';

// Configuración
define('TOKEN_SECRETO', '4d1f8b3e6c9a2f1e9083eeabc7412f1d23');
define('LICENCIA_UNICA', 'ASTRA-PRO-UNICA-1234'); // Tu clave real aquí

// Rutas de archivos
$licencias_file = __DIR__ . '/../data/licencias.json';
$bloqueados_file = __DIR__ . '/../data/bloqueados.json';
$log_file = __DIR__ . '/../data/accesos.log';

// Leer datos
$licencias = file_exists($licencias_file) ? json_decode(file_get_contents($licencias_file), true) : [];
$bloqueados = file_exists($bloqueados_file) ? json_decode(file_get_contents($bloqueados_file), true) : [];

// Registrar acceso
$log = date('c') . " - $dominio - IP: {$_SERVER['REMOTE_ADDR']}\n";
file_put_contents($log_file, $log, FILE_APPEND);

// Rechazar si está bloqueado
if (isset($bloqueados[$dominio])) {
    http_response_code(403);
    echo 'Dominio bloqueado';
    exit;
}

// Registrar dominio automáticamente
if (!isset($licencias[$dominio]) && $token === TOKEN_SECRETO) {
    $licencias[$dominio] = LICENCIA_UNICA;
    file_put_contents($licencias_file, json_encode($licencias, JSON_PRETTY_PRINT));
}

// Devolver licencia
if (isset($licencias[$dominio]) && $token === TOKEN_SECRETO) {
    echo $licencias[$dominio];
} else {
    http_response_code(403);
    echo 'Token inválido';
}
?>
