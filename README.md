# GameCrypt 🎮

Web de noticias y fichas de videojuegos con registro de usuarios, inicio de sesión y panel de administración.

Proyecto académico del Ciclo Formativo de Grado Superior en Desarrollo de Aplicaciones Multiplataforma (DAM) — Universidad Europea de Madrid.

## Funcionalidades

- Página principal con galería, últimas noticias y reseñas de usuarios
- Fichas de juegos por categoría (RPG, acción, terror, plataformas…)
- Registro de usuarios con validación en JavaScript
- Inicio y cierre de sesión con sesiones de PHP
- Panel de administración: listar, editar y eliminar usuarios
- Creación automática de la base de datos y la tabla `usuarios` en la primera conexión

## Tecnologías

HTML5 · CSS3 · JavaScript · PHP 8 · MySQL / MariaDB · XAMPP

## Estructura

```
GameCrypt/
├── Web.php      → página principal
├── HTML/        → páginas de categorías, juegos, noticias y "quiénes somos"
├── CSS/         → hojas de estilo
├── JS/          → scripts (menú, reloj, validación del formulario…)
├── PHP/         → conexión a la BD, login, registro y panel de administración
└── img/         → imágenes
```

## Cómo ejecutarlo en local

1. Instala [XAMPP](https://www.apachefriends.org/) y arranca **Apache** y **MySQL**.
2. Copia la carpeta `GameCrypt` dentro de `htdocs`.
3. Abre en el navegador: `http://localhost/GameCrypt/Web.php`

La base de datos `gamecrypt_db` se crea sola la primera vez que se conecta (por ejemplo, al abrir `http://localhost/GameCrypt/PHP/test.php`).

> **Puerto de MySQL:** el proyecto conecta por el puerto **3307**. Si tu MySQL usa el puerto por defecto (3306), cambia esta línea en `PHP/conexion.php`:
> ```php
> $servidor = 'localhost:3306';
> ```

## Usuario administrador de prueba

| Email | Contraseña |
|---|---|
| admin@gamecrypt.com | admin123 |

## Autoría

Ana Belén Rueda Reina
Gabriel Fernández Cañadas
