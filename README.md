# Astra License Manager 

Este proyecto permite centralizar y proteger la activación de **Astra Pro** en múltiples sitios WordPress, usando una sola clave **lifetime** o cualquier otra **licencia valida** y un sistema de control automatizado y remoto.

---

## 🔐 Características

- ✅ Activación automática de sitios nuevos
- ✅ Panel de gestión web (con login, bloqueo y edición)
- ✅ Protección contra abuso (bloqueo por dominio)
- ✅ Registro de accesos (IP, dominio, fecha)
- ✅ Totalmente oculto al cliente (MU Plugin)

---

## 🗂️ Estructura del proyecto

```
astra_license_manager/
├── api/
│   └── consulta.php         ← API que entrega la licencia automáticamente y registra nuevos dominios
├── admin/
│   └── index.php            ← Panel de administración con login y controles
├── data/
│   ├── licencias.json       ← Base de datos de dominios autorizados
│   ├── bloqueados.json      ← Dominios bloqueados manualmente
│   └── accesos.log          ← Registro de solicitudes a la API
└── mu-plugins/
    └── astra-key-loader.php ← Plugin oculto que consulta tu servidor para activar Astra Pro
```

---

## 🚀 Cómo funciona

1. El sitio WordPress carga el MU-plugin.
2. Este plugin consulta tu servidor con el dominio del sitio.
3. Si el dominio no existe, el servidor lo **registra automáticamente** y le devuelve la licencia.
4. Si está bloqueado, se rechaza.
5. Si está autorizado, Astra Pro se activa automáticamente.

---

## ⚙️ Instalación

### 1. Subir el sistema a tu servidor

Sube todos los archivos a tu dominio, por ejemplo:

```
https://mosley.mx/
```

### 2. Editar tu licencia y token

Abre `/api/consulta.php` y cambia:

```php
define('TOKEN_SECRETO', '4d1f8b3e6c9a2f1e9083eeabc7412f1d23');
define('LICENCIA_UNICA', 'ASTRA-PRO-UNICA-1234');
```

Reemplaza la licencia por tu clave real de Astra Pro (solo si tienes una licencia valida).

### 3. Instalar el MU-plugin en cada WordPress

Sube `astra-key-loader.php` a esta carpeta del sitio:

```
/wp-content/mu-plugins/
```

No aparecerá como plugin en el panel, y el cliente no podrá desactivarlo.

---

## 🧩 Panel de administración

1. Abre `https://mosley.mx/admin/index.php`
2. Login:  
   - Usuario: `admin`  
   - Contraseña: `12345` (cámbiala en el archivo)
3. Podrás:
   - Ver dominios registrados
   - Editar claves si alguna cambia
   - Bloquear o desbloquear dominios
   - Eliminar entradas
   - Ver historial de accesos

---

## 📌 Notas importantes

- Este sistema funciona solo si tienes una **licencia valida** de Astra.
- Cada sitio recibe **la misma clave**, pero tú controlas quién la puede usar.
- Puedes revocar acceso en cualquier momento sin tocar el sitio cliente.

---

## 🛡️ Consejos de seguridad

- Cambia el token secreto regularmente si sospechas filtración.
- Protege la carpeta `/admin/` con .htaccess o firewall.
- Haz copias de seguridad de `licencias.json` si manejas muchos clientes.

---

## ✉️ Soporte

Desarrollado por Enmanoell Mosley.
Para mejoras o soporte, abre un issue o contáctanos.

Gracias openAI por este hermoso readme.

