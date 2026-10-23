<?php
session_start();
$loginError = "";
if (isset($_SESSION['login_error'])) {
    $loginError = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Web.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/galeria.css">
    <link rel="stylesheet" href="../CSS/terror-galeria.css">
    <link rel="stylesheet" href="../CSS/perfil.css">
    <link rel="stylesheet" href="../CSS/navegador.css">
    <link rel="stylesheet" href="../CSS/registro.css">
<link rel="stylesheet" href="../CSS/formulario.css">
    <link rel="stylesheet" href="../CSS/menu-js.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    <link rel="icon" href="../img/Captura de pantalla 2025-11-12 121824.png">
    <title>Plataformeo</title>
</head>
<body>
    <div class="pagina-completa">


        <div id="ticker-noticias" style="display:none;">
          <span class="ticker-contenido">
            🎮 Super Mario Bros Wonder sigue siendo el plataformas más vendido de Switch &nbsp;|&nbsp;
            🎮 Nintendo anuncia nuevos juegos para Switch 2 &nbsp;|&nbsp;
            🎮 Expedition 33 lidera The Game Awards 2025 &nbsp;|&nbsp;
            🎮 Nuevas imágenes del live-action de Zelda
          </span>
        </div>

        <div class="overlay-perfil" id="overlay-perfil">
            <div class="ventana-perfil">
                <button id="btn-cerrar-perfil" class="cerrar-perfil-btn">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <h1>Mi Perfil</h1>
                <div class="perfil-info">
                    <div class="foto-perfil"><i class="fa-solid fa-user"></i></div>
                    <p><strong>Nombre:</strong> Usuario Invitado</p>
                    <p><strong>Correo:</strong> usuario@invitado.com</p>
                    <p><strong>Miembro desde:</strong> 2025</p>
                </div>
            </div>
        </div>

        <!-- MODAL LOGIN -->
<div class="overlay-perfil" id="overlay-login">
    <div class="ventana-perfil">
        <button id="btn-cerrar-login" class="cerrar-perfil-btn">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <h1>Iniciar Sesión</h1>
<?php if ($loginError !== ""): ?>
    <p id="error-login-msg" style="color:#ff4444; text-align:center; margin-bottom:15px; font-size:14px;">
        <?php echo $loginError; ?>
    </p>
<?php endif; ?>
        <form method="POST" action="../PHP/login.php" novalidate>
            <div class="form-grupo">
                <label for="login-email">Correo electrónico</label>
                <input type="email" name="email" id="login-email" placeholder="usuario@dominio.com" required>
            </div>
            <div class="form-grupo">
                <label for="login-password">Contraseña</label>
                <input type="password" name="password" id="login-password" placeholder="Tu contraseña" required>
            </div>
            <button type="submit" class="btn-enviar">
                <i class="fa-solid fa-right-to-bracket"></i> Entrar
            </button>
        </form>
        <p style="text-align:center; margin-top:15px; color:#ccc; font-size:13px;">
            ¿No tienes cuenta? 
            <a href="../Web.php#registro-completo" style="color:#04BD7D;" id="link-ir-registro">Regístrate aquí</a>
        </p>
    </div>
</div>


        <!-- NAVEGACIÓN -->
        <div class="nav">
            <h1><a href="../Web.php">GameCrypt</a></h1>
            <div class="nav-right">
                <span id="reloj-tiempo-real" title="Haz clic para pausar">00:00:00</span>
                                <button id="btn-abrir-perfil" class="perfil-circulo"><i class="fa-solid fa-user"></i></button>
                <?php if (isset($_SESSION['usuario'])): ?>
                <form method="POST" action="../PHP/logout.php" style="display:inline;">
                    <button type="submit" class="boton-emergente" style="background-color:#ff4444;">
                        <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
                    </button>
                </form>
            <?php else: ?>
                <button id="btn-iniciar-sesion" class="boton-emergente">Iniciar Sesión</button>
            <?php endif; ?>
            </div>
            <nav class="nav-center">
                <div id="menu-js"></div>
            </nav>
        </div>

        <div class="galeria-principal">
            <a href="mario.php"><img src="../img/2x1_NSwitch_SuperMarioBrosWonder.jpg" alt="Super Mario Bros Wonder"></a>
        </div>

    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo"><a href="../Web.php">GameCrypt</a></div>
            <div class="footer-links">
                <a href="#contacto">Contacto</a>
                <a href="quienes-somos.php">¿Quiénes somos?</a>
            </div>
            <div id="info-sistema" title="Info del navegador"></div>
            <div class="footer-copy">&copy; 2025 GameCrypt. Todos los derechos reservados.</div>
        </div>
    </footer>

    <button id="btn-volver-arriba" aria-label="Volver al inicio" aria-hidden="true">↑</button>
    <script src="../JS/main.js"></script>
<?php if ($loginError !== ""): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var overlayLogin = document.getElementById('overlay-login');
        if (overlayLogin) overlayLogin.classList.add('activo');
    });
</script>
<?php endif; ?>
</body>
</html>