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
    <link rel="stylesheet" href="../CSS/perfil.css">
    <link rel="stylesheet" href="../CSS/navegador.css">
    <link rel="stylesheet" href="../CSS/registro.css">
<link rel="stylesheet" href="../CSS/formulario.css">
    <link rel="stylesheet" href="../CSS/fichasjuegos.css">
    <link rel="stylesheet" href="../CSS/menu-js.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    <link rel="icon" href="../img/Captura de pantalla 2025-11-12 121824.png">
    <title>The Legend Of Zelda Tears of Kingdom</title>
</head>
<body>
    <div class="pagina-completa">


        <div id="ticker-noticias" style="display:none;">
          <span class="ticker-contenido">
            🎮 Expedition 33 lidera The Game Awards 2025 con 12 nominaciones &nbsp;|&nbsp;
            🎮 Nuevas imágenes del live-action de Zelda &nbsp;|&nbsp;
            🎮 Resident Evil Requiem busca superar ventas de Village &nbsp;|&nbsp;
            🎮 Silent Hill Townfall filtrado para marzo 2026
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

        <section class="datos-juego">
            <div class="contenido-centro">
                <h2 class="titulo-seccion">The Legend Of Zelda Tears Of Kingdom</h2>
                <div class="info-juego">
                    <span><strong>Fecha de Lanzamiento:</strong> 12 de mayo de 2023</span>
                    <span><strong>Género:</strong> Acción-Aventura, Mundo Abierto</span>
                    <span><strong>Plataforma:</strong> Nintendo Switch</span>
                    <span><strong>Compañía:</strong> Nintendo</span>
                    <span><strong>Precio:</strong> 69,99€</span>
                </div>

                <div class="carrusel">
                    <div class="slides">
                        <div class="slide s1"><img src="../img/the legend of zelda tears of kingdom/the-legend-of-zelda-tears-of-the-kingdom-sky-islands-get.jpg" alt="Imagen 1"></div>
                        <div class="slide s2"><img src="../img/the legend of zelda tears of kingdom/Captura de pantalla 2025-11-17 204416.png" alt="Imagen 2"></div>
                        <div class="slide s3"><img src="../img/the legend of zelda tears of kingdom/Captura de pantalla 2025-11-17 204501.png" alt="Imagen 3"></div>
                        <div class="slide s4"><img src="../img/the legend of zelda tears of kingdom/Captura de pantalla 2025-11-17 204535.png" alt="Imagen 4"></div>
                        <div class="slide s5"><img src="../img/the legend of zelda tears of kingdom/Captura de pantalla 2025-11-17 205030.png" alt="Imagen 5"></div>
                    </div>
                </div>
                                    <div class="descripcion-juego">
                        <h3>Trama</h3>
                        <p>The Legend of Zelda: Tears of the Kingdom continúa los eventos de Breath of the Wild, situando a Link y Zelda en una nueva amenaza que surge desde las profundidades bajo Hyrule. Tras un misterioso mal que resurge y libera al temible Ganondorf, el castillo se eleva y el reino entero queda alterado por la aparición de islas celestes y grietas subterráneas.</p>
                        <h3>Gameplay</h3>
                        <p>El juego expande la estructura de mundo abierto con total libertad para explorar tierra, cielo y subsuelo. Las nuevas habilidades de Link redefinen la jugabilidad: Ultramano permite combinar objetos para crear vehículos o estructuras; Combinación mejora el equipamiento; Ascenso abre rutas verticales; y Retrospectiva manipula el tiempo de objetos específicos.</p>
                        <h3>Parte artística y técnica</h3>
                        <p>Mantiene el estilo artístico estilizado de su predecesor, pero con mayor complejidad en iluminación, climas y detalle de escenarios. Las islas celestes ofrecen paisajes luminosos y contrastados, mientras que las Profundidades muestran entornos oscuros y hostiles.</p>
                        <h3>Experiencia de Jugabilidad</h3>
                        <p>Exploración libre: el jugador puede crear vehículos, planear entre islas, explorar cavernas, o viajar a las Profundidades en busca de recursos únicos. Los desafíos pueden resolverse con combate, sigilo, ingeniería, habilidades o rutas alternativas.</p>
                    </div>

                    <div class="video-y-compra">
                        <h3>Tráiler Oficial</h3><br>
                        <div class="video-container">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/2SNF4M_v7wc?si=ZNQ-6ETtaB5OUYGi" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                        <div class="botones-compra">
                            <a href="https://www.nintendo.com/es-es/Juegos/Juegos-de-Nintendo-Switch/The-Legend-of-Zelda-Tears-of-the-Kingdom-1576884.html" target="_blank" class="boton-compra"><img src="../img/switch.png" alt="switch"></a>
                        </div>
                    </div>
            </div>
        </section>

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