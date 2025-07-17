# Astra License Manager

Este proyecto permite centralizar, proteger y administrar licencias de **Astra Pro** para sitios WordPress que entregas a tus clientes, sin revelar la clave original.

---

## 🔐 Características

- **Carga remota de licencia**: los sitios consultan tu servidor para obtener la licencia en tiempo real.
- **MU Plugin**: oculta la clave, evita que el cliente la vea o copie.
- **Panel web seguro**: gestiona dominios, licencias y bloqueos.
- **Registro de accesos**: guarda historial de consultas con IP y dominio.
- **Sistema de bloqueo**: revoca licencias por dominio fácilmente.

---

## 🗂️ Estructura del proyecto

```
astra_license_manager/
├── api/
│   └── consulta.php         ← API que devuelve licencia si el dominio/token coinciden
├── admin/
│   └── index.php            ← Interfaz web con login para administrar licencias
├── data/
│   ├── licencias.json       ← Lista de dominios y sus claves de licencia
│   ├── bloqueados.json      ← Lista de dominios bloqueados
│   └── accesos.log          ← Registro de llamadas a la API
└── mu-plugins/
    └── astra-key-loader.php ← Plugin WordPress que carga la licencia desde la API
```

---

## 🚀 Instalación

### 1. Subir al servidor

Coloca el contenido del proyecto en tu dominio, por ejemplo:

```
https://as.mosley.mx/
```

### 2. Configurar token

Edita `consulta.php` y cambia esta línea:

```php
define('TOKEN_SECRETO', 'TU_TOKEN_SECRETO');
```

Reemplaza `'TU_TOKEN_SECRETO'` por tu clave real, como:

```php
define('TOKEN_SECRETO', '4d1f8b3e6c9a2f1e9083eeabc7412f1d23');
```

### 3. Agregar MU Plugin a WordPress

Coloca `astra-key-loader.php` dentro de:

```
/wp-content/mu-plugins/
```

El plugin se ejecutará automáticamente y definirá la constante que Astra Pro necesita.

---

## ✏️ Uso del panel de gestión

1. Visita `/admin/index.php`
2. Inicia sesión con:
   - Usuario: `admin`
   - Contraseña: `12345` (modificable en `index.php`)
3. Puedes:
   - Agregar dominios con sus licencias
   - Eliminar dominios
   - Bloquear y desbloquear el uso por dominio

---

## ✅ Requisitos

- PHP 7.2+
- Servidor con HTTPS
- WordPress con Astra Pro instalado

---

## 🛡️ Seguridad recomendada

- Cambia el token frecuentemente si sospechas abuso.
- Protege el directorio `/admin/` con .htaccess o un firewall.
- No compartas `astra-key-loader.php` públicamente.

---

## 📄 Licencia

Este sistema es una implementación personalizada para gestionar tus propias licencias de Astra Pro. No está afiliado con Brainstorm Force.

---

## ✉️ Soporte

Desarrollado por [tu nombre o empresa].  
Para mejoras o soporte, abre un issue o contáctanos.
