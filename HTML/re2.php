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
    <title>Resident Evil 2</title>
</head>
<body>
    <div class="pagina-completa">


        <div id="ticker-noticias" style="display:none;">
          <span class="ticker-contenido">
            🎮 Expedition 33 lidera The Game Awards 2025 con 12 nominaciones &nbsp;|&nbsp;
            🎮 Resident Evil Requiem busca superar ventas de Village &nbsp;|&nbsp;
            🎮 Nuevas imágenes del live-action de Zelda &nbsp;|&nbsp;
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
                <h2 class="titulo-seccion">Resident Evil 2</h2>
                <div class="info-juego">
                    <span><strong>Fecha de Lanzamiento:</strong> 25 de enero de 2019</span>
                    <span><strong>Género:</strong> Survival Horror</span>
                    <span><strong>Plataforma:</strong> PS4, PS5, Xbox One, Xbox Series X|S, PC</span>
                    <span><strong>Compañía:</strong> Capcom</span>
                    <span><strong>Precio:</strong> 69,99€</span>
                </div>

                <div class="carrusel">
                    <div class="slides">
                        <div class="slide s1"><img src="../img/resident evil 2 remake/ss_1392581cd29817e44099cf05416b70ffb159c58b.1920x1080.jpg" alt="Imagen 1"></div>
                        <div class="slide s2"><img src="../img/resident evil 2 remake/ss_153bd5afa0b45e74b0242a3805dc29aab9f1685e.1920x1080.jpg" alt="Imagen 2"></div>
                        <div class="slide s3"><img src="../img/resident evil 2 remake/ss_2a5d36713b40b27d1b8ed68ddcbf408af76ec1a1.1920x1080.jpg" alt="Imagen 3"></div>
                        <div class="slide s4"><img src="../img/resident evil 2 remake/ss_3d6d32d7e17c139e81a6fc64954ef35c73e5478d.1920x1080.jpg" alt="Imagen 4"></div>
                        <div class="slide s5"><img src="../img/resident evil 2 remake/ss_90cc41d4c52d56f5ab26ad64223922a93b60eba6.1920x1080.jpg" alt="Imagen 5"></div>
                    </div>
                </div>
                                    <div class="descripcion-juego">
                        <h3>Trama</h3>
                        <p>Resident Evil 2 Remake se sitúa en 1998, cuando un brote viral convierte Raccoon City en una pesadilla infestada de zombis. Los protagonistas, Leon S. Kennedy y Claire Redfield, llegan a la ciudad buscando respuestas y una salida entre el caos. Ambos descubren los experimentos de Umbrella Corporation y la propagación del virus G, mientras huyen de criaturas mutantes y del implacable Tyrant.</p>
                        <h3>Gameplay</h3>
                        <p>El juego combina exploración, gestión de recursos y combate tenso con perspectiva en tercera persona. La munición y los objetos son limitados, obligando a priorizar enfrentamientos o evitar enemigos. Tyrant (Mr. X) patrulla activamente ciertos escenarios, presionando al jugador a moverse mientras escucha sus pasos resonando por los pasillos.</p>
                        <h3>Parte artística y técnica</h3>
                        <p>Utiliza el RE Engine para ofrecer modelos detallados, iluminación realista y ambientes oscuros que potencian la atmósfera de terror. Los escenarios clásicos fueron completamente rediseñados con un nivel visual moderno, pero manteniendo su esencia.</p>
                        <h3>Experiencia de Jugabilidad</h3>
                        <p>Gestión estratégica: la escasez de recursos exige tomar decisiones cuidadosas sobre cuándo luchar o cuándo huir. Rejugabilidad alta: las dos campañas principales, los escenarios alternativos y modos adicionales ofrecen múltiples variaciones en narrativa y desafíos.</p>
                    </div>

                    <div class="video-y-compra">
                        <h3>Tráiler Oficial</h3><br>
                        <div class="video-container">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/u3wS-Q2KBpk?si=rfiKiMHDTOJ4O_oi" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                        <div class="botones-compra">
                            <a href="https://store.steampowered.com/app/883710/Resident_Evil_2/" target="_blank" class="boton-compra"><img src="../img/vapor.png" alt="steam"></a>
                            <a href="https://www.xbox.com/es-ES/games/store/resident-evil-2/BWMH951M3G3P/0001" target="_blank" class="boton-compra"><img src="../img/xbox.png" alt="xbox"></a>
                            <a href="https://www.playstation.com/es-es/games/resident-evil-2/" target="_blank" class="boton-compra"><img src="../img/pngegg.png" alt="playstation"></a>
                            <a href="https://www.nintendo.com/es-es/Juegos/Programas-descargables-Nintendo-Switch/Resident-Evil-2-Cloud-2291644.html" target="_blank" class="boton-compra"><img src="../img/switch.png" alt="switch"></a>
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