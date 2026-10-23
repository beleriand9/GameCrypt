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
    <link rel="stylesheet" href="../CSS/perfil.css">
    <link rel="stylesheet" href="../CSS/navegador.css">
    <link rel="stylesheet" href="../CSS/registro.css">
<link rel="stylesheet" href="../CSS/formulario.css">
    <link rel="stylesheet" href="../CSS/quienes-somos.css">
    <link rel="stylesheet" href="../CSS/menu-js.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    <link rel="icon" href="../img/Captura de pantalla 2025-11-12 121824.png">
    <title>¿Quiénes somos?</title>
</head>
<body>
    <div class="pagina-completa">

        <div id="ticker-noticias" style="display:none;">
          <span class="ticker-contenido">
            🎮 Expedition 33 lidera The Game Awards 2025 con 12 nominaciones &nbsp;|&nbsp;
            🎮 Bienvenido a GameCrypt, tu web de referencia gaming &nbsp;|&nbsp;
            🎮 Nuevas noticias cada semana &nbsp;|&nbsp;
            🎮 Regístrate y forma parte de la comunidad
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

        <section class="contenido-quienes-somos">
            <h1>¿Quiénes somos?</h1>
            <p><strong>GameCrypt</strong> es una plataforma dedicada a reunir, organizar y presentar información detallada sobre videojuegos de todos los géneros y plataformas. Nuestro objetivo es ayudar a jugadores, curiosos y entusiastas a encontrar la información que necesitan de forma rápida, clara y fiable.</p>
            <p><br>Aquí podrás descubrir juegos mediante descripciones, valoraciones, capturas, recomendaciones, filtros por categoría y mucho más. Desde grandes títulos reconocidos mundialmente hasta joyas indie menos conocidas, nuestro catálogo está en constante crecimiento.</p>
            <h2>Nuestra misión</h2>
            <p>Queremos crear la base de datos de videojuegos más accesible y completa posible. Trabajamos para que cada juego cuente con información útil: historia, mecánicas, plataformas disponibles, precio, géneros, reseñas y curiosidades. Nuestro objetivo es que cualquier jugador pueda encontrar el título perfecto sin complicaciones.</p>
            <h2>Una experiencia pensada para jugadores</h2>
            <p>GameCrypt está diseñado para ser intuitivo, visual y cómodo. Usamos un sistema de categorías, filtros avanzados y secciones organizadas para que puedas explorar juegos de forma fluida, ya sea que busques algo nuevo para jugar o desees aprender más sobre tus sagas favoritas.</p>
            <h2>Nuestro equipo</h2>
            <p>Somos un grupo de estudiantes apasionados por la tecnología y los videojuegos que decidimos convertir una idea en un proyecto sólido: un espacio donde la información sobre videojuegos esté bien estructurada, verificable y disponible para todos.<br><br>Actualizamos constantemente la plataforma, ampliamos la base de datos y mejoramos la experiencia de navegación.</p>
            <p><br>En GameCrypt creemos que <strong>la información es la mejor herramienta para disfrutar aún más del mundo gaming</strong>. Nos encanta compartir esta pasión contigo y esperamos que encuentres aquí tu próximo gran juego.</p>
            <div class="final">
                <p><br><br>Porque en cada juego descubrimos un nuevo mundo… y en cada mundo, una razón más para seguir soñando.</p>
            </div>
        </section>

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