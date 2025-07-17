<?php
session_start();
define('USUARIO', 'admin');
define('CLAVE', '12345'); // Cambia esto por una contraseña segura

// Login
if (!isset($_SESSION['autenticado'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['usuario'] === USUARIO && $_POST['clave'] === CLAVE) {
        $_SESSION['autenticado'] = true;
    } else {
        echo '<form method="POST"><input name="usuario" placeholder="Usuario"><input name="clave" type="password" placeholder="Clave"><button>Entrar</button></form>';
        exit;
    }
}

// Archivos
$filename = __DIR__ . '/../data/licencias.json';
$bloqueados_file = __DIR__ . '/../data/bloqueados.json';

$licencias = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];
$bloqueados = file_exists($bloqueados_file) ? json_decode(file_get_contents($bloqueados_file), true) : [];

// Acciones: agregar, eliminar, bloquear
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dominio']) && isset($_POST['licencia'])) {
        $licencias[$_POST['dominio']] = $_POST['licencia'];
    }
    if (isset($_POST['eliminar'])) {
        unset($licencias[$_POST['eliminar']]);
    }
    if (isset($_POST['bloquear'])) {
        $bloqueados[$_POST['bloquear']] = true;
    }
    if (isset($_POST['desbloquear'])) {
        unset($bloqueados[$_POST['desbloquear']]);
    }

    file_put_contents($filename, json_encode($licencias, JSON_PRETTY_PRINT));
    file_put_contents($bloqueados_file, json_encode($bloqueados, JSON_PRETTY_PRINT));
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Gestión de Licencias Astra</title></head>
<body>
<h1>Gestión de Licencias</h1>
<form method="POST">
    Dominio: <input type="text" name="dominio" required>
    Licencia: <input type="text" name="licencia" required>
    <button type="submit">Guardar</button>
</form>
<h2>Dominios Registrados</h2>
<ul>
<?php foreach ($licencias as $dominio => $licencia): ?>
    <li>
        <strong><?= $dominio ?></strong>: <?= $licencia ?>
        <form method="POST" style="display:inline">
            <input type="hidden" name="eliminar" value="<?= $dominio ?>">
            <button>Eliminar</button>
        </form>
        <?php if (!isset($bloqueados[$dominio])): ?>
        <form method="POST" style="display:inline">
            <input type="hidden" name="bloquear" value="<?= $dominio ?>">
            <button>Bloquear</button>
        </form>
        <?php else: ?>
        <form method="POST" style="display:inline">
            <input type="hidden" name="desbloquear" value="<?= $dominio ?>">
            <button>Desbloquear</button>
        </form>
        <?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>
</body>
</html>
