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
    <link rel="stylesheet" href="../CSS/noticias.css">
    <link rel="stylesheet" href="../CSS/menu-js.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    <link rel="icon" href="../img/Captura de pantalla 2025-11-12 121824.png">
    <title>Noticias</title>
</head>
<body>
    <div class="pagina-completa">

        <div id="ticker-noticias" style="display:none;">
          <span class="ticker-contenido">
            🎮 Expedition 33 lidera The Game Awards 2025 con 12 nominaciones &nbsp;|&nbsp;
            🎮 Resident Evil Requiem busca superar ventas de Village &nbsp;|&nbsp;
            🎮 Nuevas imágenes del live-action de Zelda &nbsp;|&nbsp;
            🎮 Silent Hill Townfall filtrado para marzo 2026 &nbsp;|&nbsp;
            🎮 Ubisoft advierte cambio en hábitos de consumo gaming
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

        <!-- NOTICIAS -->
        <div class="noticias-grid">
            <div class="noticia-col" id="noticia1">
                <img src="../img/silenthill.webp" alt="Silent Hill Townfall">
                <h3 class="titulo-noticia">Filtrada la posible fecha de lanzamiento de "Silent Hill Townfall"</h3>
                <p class="meta">Publicado por <strong>Gabriel Fernández</strong> — 17 nov 2025</p>
                <p class="resumen">Una filtración reciente sugiere que Silent Hill Townfall podría lanzarse a inicios de 2026. El dato proviene de una tienda mexicana que listó el juego con fecha del 26 de marzo de 2026 antes de eliminar la publicación. Aunque no hay confirmación oficial de Konami o Annapurna Interactive, la filtración ha ganado fuerza gracias a capturas previas y menciones de figuras relevantes de la comunidad.<br><br>El proyecto, anunciado originalmente en 2022, ha estado envuelto en misterio desde su primer avance críptico. El resurgimiento de Silent Hill, impulsado por el éxito del remake de Silent Hill 2 y Silent Hill f, ha devuelto la confianza en que el título está en camino.</p>
            </div>
            <div class="noticia-col" id="noticia2">
                <img src="../img/residentevilrequiem.jpg" alt="Resident Evil Requiem">
                <h3 class="titulo-noticia">Resident Evil Requiem superaría las ventas de RE Village, según Capcom</h3>
                <p class="meta">Publicado por <strong>Ana Belén Rueda</strong> — 17 nov 2025</p>
                <p class="resumen">Capcom ha compartido nuevas expectativas para Resident Evil Requiem, indicando que esperan que el título supere las ventas iniciales de Resident Evil Village. La compañía afirmó que el juego ha recibido grandes elogios en varios eventos y que su anuncio impulsó la venta de entregas anteriores de la saga.<br><br>En entrevistas recientes, los desarrolladores revelaron que Requiem comenzó su producción incluso antes que Village. También explicaron que descartaron incorporar un modo multijugador para centrarse por completo en una experiencia más cuidada.</p>
            </div>
            <div class="noticia-col" id="noticia3">
                <img src="../img/ubisoft.webp" alt="Ubisoft tendencias del mercado">
                <h3 class="titulo-noticia">Ubisoft afirma que los jugadores consumen "menos juegos", dificultando que los nuevos destaquen</h3>
                <p class="meta">Publicado por <strong>Gabriel Fernández</strong> — 17 nov 2025</p>
                <p class="resumen">En un informe reciente presentado ante las autoridades del Reino Unido, Ubisoft expuso una visión poco optimista sobre el mercado actual. La compañía asegura que los jugadores están "jugando menos títulos, pero durante más tiempo", lo que provoca que los nuevos lanzamientos tengan más dificultades para destacar.<br><br>Según Ubisoft, este cambio en los hábitos de consumo está directamente relacionado con el auge de los servicios de suscripción, los juegos como servicio y los títulos free-to-play.</p>
            </div>
            <div class="noticia-col" id="noticia4">
                <img src="../img/zeldaliveaction.jpg" alt="The Legend of Zelda Live Action">
                <h3 class="titulo-noticia">Reveladas nuevas imágenes del live-action de "The Legend of Zelda"</h3>
                <p class="meta">Publicado por <strong>Gabriel Fernández</strong> — 17 nov 2025</p>
                <p class="resumen">Nuevas imágenes oficiales de Link y Zelda han sido publicadas para la esperada adaptación live-action de The Legend of Zelda. Las imágenes fueron reveladas directamente por Nintendo a través de la aplicación Nintendo Today. Se confirma que Link llevará su clásica túnica verde y que Zelda vestirá tonos azules, evocando su estilo en Breath of the Wild y Tears of the Kingdom.</p>
            </div>
            <div class="noticia-col" id="noticia5">
                <img src="../img/exp33.jpg" alt="Clair Obscur Expedition 33">
                <h3 class="titulo-noticia">Clair Obscur: Expedition 33 rompe récord en The Game Awards 2025</h3>
                <p class="meta">Publicado por <strong>Ana Belén Rueda</strong> — 17 nov 2025</p>
                <p class="resumen">Clair Obscur: Expedition 33, desarrollado por Sandfall Interactive, ha logrado un récord histórico tras recibir 12 nominaciones en The Game Awards 2025, incluyendo Juego del Año. Las 12 nominaciones del juego superan el récord de 11 establecido por The Last of Us Part II y God of War: Ragnarok. El ganador a Juego del Año se conocerá el 11 de diciembre durante la ceremonia.</p>
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

    </div>

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