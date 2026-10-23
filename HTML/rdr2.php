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
    <title>Red Dead Redemption 2</title>
</head>
<body>
    <div class="pagina-completa">


        <div id="ticker-noticias" style="display:none;">
          <span class="ticker-contenido">
            🎮 Expedition 33 lidera The Game Awards 2025 con 12 nominaciones &nbsp;|&nbsp;
            🎮 Red Dead Redemption 2 sigue siendo uno de los mejores juegos de la generación &nbsp;|&nbsp;
            🎮 Rockstar trabaja en GTA VI &nbsp;|&nbsp;
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

        <section class="datos-juego">
            <div class="contenido-centro">
                <h2 class="titulo-seccion">Red Dead Redemption 2</h2>
                <div class="info-juego">
                    <span><strong>Fecha de Lanzamiento:</strong> 26 de Octubre de 2018</span>
                    <span><strong>Género:</strong> Acción-Aventura, Mundo Abierto</span>
                    <span><strong>Plataforma:</strong> PS4, Xbox One, PC</span>
                    <span><strong>Compañía:</strong> Rockstar Games</span>
                    <span><strong>Precio:</strong> $59.99 USD aprox.</span>
                </div>

                <div class="carrusel">
                    <div class="slides">
                        <div class="slide s1"><img src="../img/red dead redemption2/ss_4ce07ae360b166f0f650e9a895a3b4b7bf15e34f.1920x1080.jpg" alt="Imagen 1"></div>
                        <div class="slide s2"><img src="../img/red dead redemption2/ss_668dafe477743f8b50b818d5bbfcec669e9ba93e.1920x1080.jpg" alt="Imagen 2"></div>
                        <div class="slide s3"><img src="../img/red dead redemption2/ss_66b553f4c209476d3e4ce25fa4714002cc914c4f.1920x1080.jpg" alt="Imagen 3"></div>
                        <div class="slide s4"><img src="../img/red dead redemption2/ss_bac60bacbf5da8945103648c08d27d5e202444ca.1920x1080.jpg" alt="Imagen 4"></div>
                        <div class="slide s5"><img src="../img/red dead redemption2/ss_d1a8f5a69155c3186c65d1da90491fcfd43663d9.1920x1080.jpg" alt="Imagen 5"></div>
                    </div>
                </div>
                                    <div class="descripcion-juego">
                        <h3>Trama</h3>
                        <p>Red Dead Redemption 2 narra la historia de Arthur Morgan, miembro de la banda Van der Linde, en 1899. La banda, liderada por Dutch Van der Linde, intenta sobrevivir frente al avance de la modernización, la ley y traiciones internas. A lo largo del juego, Arthur debe hacer frente a dilemas morales, pérdidas y el desmoronamiento de los valores de la banda, mientras sus elecciones afectan su honor y su destino.</p>
                        <h3>Gameplay</h3>
                        <p>El juego combina acción-aventura con un mundo abierto extremadamente detallado. Los jugadores pueden recorrer el mundo en caballo, disparar desde la cobertura, cazar, pescar, robar trenes o interactuar con cientos de NPC. Tiene un sistema de honor muy presente: las acciones de Arthur modifican su honor, lo que cambia cómo reacciona el mundo a su paso.</p>
                        <h3>Parte artística y técnica</h3>
                        <p>Gráficamente, es muy ambicioso: recrea paisajes del Oeste con gran detalle, ciclos de día/noche y clima dinámico. La banda sonora también es notable, con música original que refuerza la inmersión. El mundo es vivo: los NPC tienen rutinas, reaccionan a tus acciones y hay eventos emergentes.</p>
                        <h3>Experiencia de Jugabilidad</h3>
                        <p>Exploración libre: gran parte del juego es moverte por el mapa, descubrir misiones secundarias, interactuar con la fauna o participar en eventos aleatorios. Jugabilidad emergente: hay muchas formas de hacer las cosas, lo que da un fuerte sentido de libertad.</p>
                    </div>

                    <div class="video-y-compra">
                        <h3>Tráiler Oficial</h3><br>
                        <div class="video-container">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/gmA6MrX81z4?si=YaYorqZ_pjz9R-Lx" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                        <div class="botones-compra">
                            <a href="https://store.steampowered.com/app/1174180/Red_Dead_Redemption_2/" target="_blank" class="boton-compra"><img src="../img/vapor.png" alt="steam"></a>
                            <a href="https://www.xbox.com/es-ES/games/red-dead-redemption-2" target="_blank" class="boton-compra"><img src="../img/xbox.png" alt="xbox"></a>
                            <a href="https://store.playstation.com/es-es/product/EP1004-CUSA08519_00-REDEMPTIONFULL02" target="_blank" class="boton-compra"><img src="../img/pngegg.png" alt="playstation"></a>
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