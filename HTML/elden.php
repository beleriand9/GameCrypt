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
    <title>Elden Ring</title>
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
                <h2 class="titulo-seccion">Elden Ring</h2>
                <div class="info-juego">
                    <span><strong>Fecha de Lanzamiento:</strong> 25 de febrero de 2022</span>
                    <span><strong>Género:</strong> Acción-RPG, Mundo Abierto</span>
                    <span><strong>Plataforma:</strong> PS4, PS5, Xbox One, Xbox Series X|S, PC</span>
                    <span><strong>Compañía:</strong> FromSoftware / Bandai Namco</span>
                    <span><strong>Precio:</strong> 69,99€</span>
                </div>

                <div class="carrusel">
                    <div class="slides">
                        <div class="slide s1"><img src="../img/eldenring/ss_943bf6fe62352757d9070c1d33e50b92fe8539f1.1920x1080.jpg" alt="Imagen 1"></div>
                        <div class="slide s2"><img src="../img/eldenring/ss_c2baf8aada6140beee79d701d14043899e91af47.1920x1080.jpg" alt="Imagen 2"></div>
                        <div class="slide s3"><img src="../img/eldenring/ss_c494372930ca791bdc6221eca134f2270fb2cb9f.1920x1080.jpg" alt="Imagen 3"></div>
                        <div class="slide s4"><img src="../img/eldenring/ss_e0316c76f8197405c1312d072b84331dd735d60b.1920x1080.jpg" alt="Imagen 4"></div>
                        <div class="slide s5"><img src="../img/eldenring/ss_ef61b771ee6b269b1f0cb484233e07a0bfb5f81b.1920x1080.jpg" alt="Imagen 5"></div>
                    </div>

                </div>
                                    <div class="descripcion-juego">
                        <h3>Trama</h3>
                        <p>Elden Ring se desarrolla en las Tierras Intermedias, un vasto mundo fracturado tras la destrucción del Círculo de Elden. Como un "Sinluz", el jugador debe recorrer estas tierras en busca de fragmentos del Círculo —las Grandes Runas— que poseen los semidioses descendientes de la Reina Márika. La historia gira en torno a temas de ambición, decadencia y poder, con narrativa ambiental y fragmentaria típica de FromSoftware.</p>
                        <h3>Gameplay</h3>
                        <p>Combina combate de acción tipo Souls con un mundo abierto extenso. Los jugadores pueden luchar con armas cuerpo a cuerpo, magia, invocaciones espirituales y montura de combate. La montura, Torrentera, permite desplazamientos rápidos y batallas a caballo. El combate mantiene la dificultad y precisión de la saga Souls, con una mayor libertad estratégica gracias a la variedad de builds y cenizas de guerra.</p>
                        <h3>Parte artística y técnica</h3>
                        <p>Destaca por su dirección artística oscura y épica, con paisajes que van desde pantanos pútridos hasta castillos colosales. La música acompaña de forma atmosférica en exploración y se vuelve intensa en jefes. Técnicamente mantiene buena estabilidad y tiempos de carga reducidos, especialmente en consolas de nueva generación.</p>
                        <h3>Experiencia de Jugabilidad</h3>
                        <p>Exploración libre: se premia la curiosidad con nuevas armas, mazmorras, jefes secretos y zonas escondidas. Construcción del personaje: múltiples estilos de combate, magias, armas y cenizas permiten builds muy variadas. Libertad de progresión: si un jefe es muy difícil, se puede explorar otras áreas antes de volver.</p>
                    </div>

                    <div class="video-y-compra">
                        <h3>Tráiler Oficial</h3><br>
                        <div class="video-container">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/E3Huy2cdih0?si=u-mDpJo1k0JBlYBd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="botones-compra">
                        <a href="https://store.steampowered.com/app/1245620/ELDEN_RING/?l=spanish" target="_blank" class="boton-compra"><img src="../img/vapor.png" alt="steam"></a>
                        <a href="https://www.xbox.com/es-ES/games/elden-ring" target="_blank" class="boton-compra"><img src="../img/xbox.png" alt="xbox"></a>
                        <a href="https://www.playstation.com/es-es/games/elden-ring/" target="_blank" class="boton-compra"><img src="../img/pngegg.png" alt="playstation"></a>
                        <a href="https://www.nintendo.com/es-es/Juegos/Juegos-de-Nintendo-Switch-2/ELDEN-RING-Tarnished-Edition-2791969.html" target="_blank" class="boton-compra"><img src="../img/switch.png" alt="switch"></a>
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