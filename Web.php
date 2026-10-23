<!--session_start() le dice a PHP "quiero usar sesiones en esta página". Las sesiones son la forma que tiene PHP de recordar quién está logueado mientras navegas por la web.
Sin session_start() no puedes usar $_SESSION. Lo necesitamos en Web.php para dos cosas:

Cuando el usuario se registre, poder iniciar su sesión automáticamente después
Poder comprobar si ya hay alguien logueado para mostrar su nombre en la nav en vez del botón "Iniciar Sesión"

Hay que ponerlo al principio del todo porque PHP exige que session_start() se llame antes de que se envíe cualquier contenido HTML al navegador. Si lo pones después del <!DOCTYPE html> da error. -->


<?php 
session_start();
?>

<?php
// Comprobamos si viene un mensaje de la sesión después del registro
// isset() comprueba si la variable existe en la sesión
// unset() la borra después de leerla para que no aparezca si el usuario recarga la página

//inicializamos dos variables vacias. Si no viene ningun mensaje de sesion, quedan vacias y no se muestra nada
$mensajeRegistro = "";  
$tipoMensaje = "";

//si en la sesion existe una clave registro_ok. Esto será verdad si guardar_usuario.php la guardó antes de redirigir (si fue exitoso)
if (isset($_SESSION['registro_ok'])) {
    $mensajeRegistro = $_SESSION['registro_ok']; //si existe, guardamos el mensaje en $mensajeRegistro y marcamos el tipo como "ok", para saber que es un éxito y mostrar color verde
    $tipoMensaje = "ok";
    unset($_SESSION['registro_ok']); // borramos para que no se repita al recargar la página. Si no, el mensaje volvería a aparecer
}

//si en insert falló, mostramos el mensaje en rojo
if (isset($_SESSION['registro_error'])) {
    $mensajeRegistro = $_SESSION['registro_error'];
    $tipoMensaje = "error";
    unset($_SESSION['registro_error']); // borramos para que no se repita al recargar
}


// Comprobamos si hay error de login para abrir el modal automáticamente
$loginError = "";
if (isset($_SESSION['login_error'])) {
    $loginError = $_SESSION['login_error'];
    unset($_SESSION['login_error']); // lo borramos para que no se repita
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GameCrypt</title>

  <link rel="stylesheet" href="CSS/Web.css">
  <link rel="stylesheet" href="CSS/footer.css">
  <link rel="stylesheet" href="CSS/galeria.css">
  <link rel="stylesheet" href="CSS/perfil.css">
  <link rel="stylesheet" href="CSS/navegador.css">
  <link rel="stylesheet" href="CSS/registro.css">
  <link rel="stylesheet" href="CSS/resenas-web.css">
  <link rel="stylesheet" href="CSS/menu-js.css">
  <link rel="stylesheet" href="CSS/formulario.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
  <link rel="icon" href="img/Captura de pantalla 2025-11-12 121824.png">
</head>

<body>


<?php if ($mensajeRegistro !== ""): ?>
    <!-- Ventana emergente que aparece cuando el usuario viene de registrarse -->
    <!-- Solo se muestra si $mensajeRegistro tiene contenido -->
    <div id="mensaje-registro-flotante" style="
        position:fixed; top:50%; left:50%; 
        transform:translate(-50%,-50%);
        background:#2C2F35; 
        border-radius:20px; 
        padding:40px 50px;
        text-align:center; 
        z-index:99999; 
        max-width:500px; 
        width:90%;
        box-shadow: 0 10px 40px rgba(0,0,0,0.7);
        border: 2px solid <?php echo $tipoMensaje === 'ok' ? '#04BD7D' : '#ff4444'; ?>;">

        <!-- Logo GameCrypt con fuente VT323 -->
        <p style="font-family:'VT323',monospace; font-size:48px; color:#ffa500; margin-bottom:10px;">
            GameCrypt
        </p>

        <!-- Icono verde si es éxito, rojo si es error -->
         <!-- Operador ternario: si $tipoMensaje es igual a 'ok', usa fa-circle-check (el tick verde), si no, usa fa-circle-xmark (la X roja)". -->
        <i class="fa-solid <?php echo $tipoMensaje === 'ok' ? 'fa-circle-check' : 'fa-circle-xmark'; ?>" 
           style="font-size:50px; 
                  color:<?php echo $tipoMensaje === 'ok' ? '#04BD7D' : '#ff4444'; ?>; 
                  margin-bottom:20px; 
                  display:block;">
        </i>

        <!-- Mensaje de texto que viene de $_SESSION -->
        <p style="color:white; font-size:18px; margin-bottom:30px;">
            <?php echo $mensajeRegistro; ?>
        </p>

        <!-- Botón con id para que JavaScript lo encuentre sin usar onclick inline -->
        <button id="btn-cerrar-registro" style="
            background:#04BD7D; 
            color:white; 
            border:none; 
            border-radius:10px; 
            padding:12px 30px; 
            font-size:16px; 
            cursor:pointer; 
            font-weight:bold;">
            Aceptar
        </button>
    </div>
<?php endif; ?>
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
            <div class="foto-perfil">
                <i class="fa-solid fa-user"></i>
            </div>
            <?php if (isset($_SESSION['usuario'])): ?>
                <p><strong>Nombre:</strong> <?php echo $_SESSION['usuario']; ?></p>
                <p><strong>Correo:</strong> <?php echo $_SESSION['email'] ?? 'No disponible'; ?></p>
                <p><strong>Nivel:</strong> <?php echo $_SESSION['nivel'] ?? 'No disponible'; ?></p>
            <?php else: ?>
                <p><strong>Nombre:</strong> Usuario Invitado</p>
                <p><strong>Correo:</strong> usuario@invitado.com</p>
                <p><strong>Miembro desde:</strong> 2025</p>
            <?php endif; ?>
        </div>
    </div>
</div>

    <!-- MODAL LOGIN — oculto por defecto, JS lo abre/cierra con classList -->
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


    <!-- El formulario envía a login.php por POST -->
    <form method="POST" action="PHP/login.php" novalidate>
                <div class="form-grupo">
                    <label for="login-email">Correo electrónico</label>
                    <input type="email" name="email" id="login-email" 
                           placeholder="usuario@dominio.com" required>
                </div>
                <div class="form-grupo">
                    <label for="login-password">Contraseña</label>
                    <input type="password" name="password" id="login-password" 
                           placeholder="Tu contraseña" required>
                </div>
                <button type="submit" class="btn-enviar">
                    <i class="fa-solid fa-right-to-bracket"></i> Entrar
                </button>
            </form>


<!--EXPLICACIÓN del bloque de abajo: onclick se ejecuta INMEDIATAMENTE al hacer clic, antes de que el navegador
procese el href="#registro-completo" y haga el scroll.
 
 document.getElementById('overlay-login')  → busca el modal de login en el DOM
 .classList.remove('activo')               → le quita la clase 'activo', que es 
                                             la que hace que el modal sea visible
 
El orden es: onclick primero → modal desaparece → después hace el scroll al registro

DIFERENCIA con los otros HTML: en rpg.html, accion.html, etc. el link apunta a "../Web.php#registro-completo",
lo que provoca un cambio de página completo y el modal desaparece solo al recargar.
Aquí en Web.php el href="#registro-completo" es un scroll dentro de la misma página,
por eso necesitamos el onclick para cerrar el modal manualmente antes del scroll. -->


            <p style="text-align:center; margin-top:15px; color:#ccc; font-size:13px;">
                ¿No tienes cuenta? 
                <a href="#registro-completo" style="color:#04BD7D;" 
   id="link-ir-registro" onclick="document.getElementById('overlay-login').classList.remove('activo')">Regístrate aquí</a>
            </p>
        </div>
    </div>




    <!-- NAVEGACIÓN -->
    <div class="nav">
      <h1><a href="Web.php">GameCrypt</a></h1>

<div class="nav-right">
    <span id="reloj-tiempo-real" title="Haz clic para pausar el reloj">00:00:00</span>
    <button id="btn-abrir-perfil" class="perfil-circulo">
        <i class="fa-solid fa-user"></i>
    </button>
    <?php if (isset($_SESSION['usuario']) && $_SESSION['rol'] !== 'admin'): ?>
        <form method="POST" action="PHP/logout.php" style="display:inline;">
            <button type="submit" class="boton-emergente" style="background-color:#ff4444;">
                 <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
            </button>
        </form>
    <?php else: ?>
        <button id="btn-iniciar-sesion" class="boton-emergente">Iniciar Sesión</button>
    <?php endif; ?>
</div>

      <nav class="nav-center">
        <div id="menu-js">
          <noscript>
            <a href="HTML/rpg.php">RPG</a>
            <a href="HTML/noticias.php">Noticias</a>
            <a href="#reseñas-usuarios">Reseñas</a>
          </noscript>
        </div>
      </nav>
    </div>

    <!-- GALERÍA PRINCIPAL -->
    <div class="galeria-principal">
      <div class="columna-izquierda">
        <img src="img/ChatGPT Image 12 nov 2025, 10_06_41.png" alt="Imagen-fusionada">
      </div>
      <div class="columna-derecha">
        <img src="img/2x1_HP_NSwitch2_TLoZTotKN_image1600w.jpg" alt="zelda">
        <img src="img/Elden-Ring.jpg" alt="Elden-Ring">
      </div>
    </div>
  </div>

  <!-- NOTICIAS RESUMIDAS -->
  <section class="noticias-resumen">
    <h2 class="titulo-seccion">ÚLTIMAS NOTICIAS</h2>
    <div class="noticias-resumen-grid">

      <a href="HTML/noticias.php#noticia5" class="noticia-resumen">
        <span class="etiqueta-noticia">NEWS</span>
        <img src="img/exp33.jpg" alt="Expedition 33">
        <h3>Clair Obscur: Expedition 33 rompe récord en The Game Awards 2025</h3>
        <p class="meta">17 nov 2025 — Ana Belén Rueda</p>
        <p class="resumen">Clair Obscur: Expedition 33 bate récords en The Game Awards 2025 con 12 nominaciones y se consolida como uno de los juegos más destacados del año.</p>
      </a>

      <a href="HTML/noticias.php#noticia2" class="noticia-resumen">
        <span class="etiqueta-noticia">NEWS</span>
        <img src="img/residentevilrequiem.jpg" alt="Resident Evil Requiem">
        <h3>RE Requiem superará ventas de Village</h3>
        <p class="meta">17 nov 2025 — Ana Belén Rueda</p>
        <p class="resumen">Capcom espera que Resident Evil Requiem supere las ventas de Village, ofreciendo una experiencia centrada y sin modo multijugador.</p>
      </a>

      <a href="HTML/noticias.php#noticia3" class="noticia-resumen">
        <span class="etiqueta-noticia">NEWS</span>
        <img src="img/ubisoft.webp" alt="Ubisoft mercado gaming">
        <h3>Ubisoft: "los jugadores consumen menos juegos"</h3>
        <p class="meta">17 nov 2025 — Gabriel Fernández</p>
        <p class="resumen">Ubisoft advierte que los jugadores compran menos títulos completos, lo que dificulta que los nuevos lanzamientos destaquen en el mercado.</p>
      </a>

      <a href="HTML/noticias.php#noticia4" class="noticia-resumen">
        <span class="etiqueta-noticia">NEWS</span>
        <img src="img/zeldaliveaction.jpg" alt="Live-action Zelda">
        <h3>Nuevas imágenes del live-action de Zelda</h3>
        <p class="meta">17 nov 2025 — Gabriel Fernández</p>
        <p class="resumen">Se revelan nuevas imágenes del live-action de The Legend of Zelda, mostrando a Link y Zelda en un esperado avance de la película.</p>
      </a>

    </div>
  </section>

  <!-- RESEÑAS DE USUARIOS -->
  <section id="reseñas-usuarios">
    <h2 class="titulo-seccion">Lo que dicen nuestros usuarios</h2>
    <div class="reseñas-grid">

      <div class="reseña">
        <div class="estrellas">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>
        <p class="comentario">GameCrypt es increíblemente visual y fácil de navegar. Las noticias siempre son rigurosas y actualizadas, y la experiencia de usuario es impecable. ¡Una web imprescindible para gamers!</p>
        <p class="usuario">— Alex Gamer</p>
      </div>

      <div class="reseña">
        <div class="estrellas">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>
        <p class="comentario">Me encanta cómo GameCrypt organiza las noticias. La información es clara, precisa y completa, y siempre descubro novedades interesantes sobre videojuegos.</p>
        <p class="usuario">— Carla Pixel</p>
      </div>

      <div class="reseña">
        <div class="estrellas">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>
        <p class="comentario">La web es super atractiva y la experiencia de lectura es fantástica. Cada noticia está bien investigada y me mantiene al día con todo el mundo gaming. ¡Totalmente recomendable!</p>
        <p class="usuario">— Javier Console</p>
      </div>

    </div>
  </section>

  <!-- FORMULARIO DE REGISTRO COMPLETO -->
  <section class="seccion-formulario" id="registro-completo">
    <h2 class="titulo-seccion">REGÍSTRATE EN GAMECRYPT</h2>
    <div class="form-completo-wrapper">
      <h2>Crear cuenta</h2>
      <div id="mensaje-exito"></div>

<!-- Al pulsar "Crear mi cuenta", los datos viajan 
de forma oculta mediante POST hasta guardar_usuario.php que los guardará en la BD. 
Se usa novalidate para que solo actúe la validación de formulario.js y no la del navegador. 
session_start() se pone al principio para poder usar sesiones en esta página, 
necesarias para saber si hay un usuario logueado y mostrar su nombre en la navegación.  -->

      <form id="form-registro-completo" method="POST" action="PHP/guardar_usuario.php" novalidate>

        <div class="form-grupo">
          <label for="campo-nombre">Nombre completo *
            <span style="font-size:11px; color:#888; font-weight:normal;">(Solo letras, 3-40 caracteres)</span>
          </label>
          <input type="text" id="campo-nombre" name="campo-nombre" placeholder="Ej: Ana García López" autocomplete="name">
          <span class="error-msg" id="error-nombre"></span>
        </div>

        <div class="form-grupo">
          <label for="campo-email">Correo electrónico *
            <span style="font-size:11px; color:#888; font-weight:normal;">(Ej: usuario@dominio.com)</span>
          </label>
          <input type="email" id="campo-email" name="campo-email" placeholder="usuario@dominio.com" autocomplete="email">
          <span class="error-msg" id="error-email"></span>
        </div>

        <div class="form-grupo">
          <label for="campo-password">Contraseña *
            <span style="font-size:11px; color:#888; font-weight:normal;">(Mín. 8 caracteres, 1 mayúscula, 1 número, 1 especial)</span>
          </label>
          <div class="password-wrapper">
          <input type="password" id="campo-password" name="campo-password" placeholder="Tu contraseña segura" autocomplete="new-password">
            <button type="button" id="toggle-password" title="Mostrar contraseña">👁</button>
          </div>
          <div class="barra-fuerza-wrapper">
            <div id="barra-fuerza-password"></div>
          </div>
          <span id="texto-fuerza-password"></span>
          <span class="error-msg" id="error-password"></span>
        </div>

        <div class="form-grupo">
          <label for="campo-password-rep">Repetir contraseña *</label>
          <input type="password" id="campo-password-rep" name="campo-password-rep" placeholder="Repite tu contraseña" autocomplete="new-password">
          <span class="error-msg" id="error-password-rep"></span>
        </div>

        <div class="form-grupo">
          <label for="campo-telefono">Teléfono *
            <span style="font-size:11px; color:#888; font-weight:normal;">(Ej: 612345678 o +34 612345678)</span>
          </label>
          <input type="tel" id="campo-telefono" name="campo-telefono" placeholder="612 345 678">
          <span class="error-msg" id="error-telefono"></span>
        </div>

        <div class="form-grupo">
          <label for="campo-fecha">Fecha de nacimiento *
            <span style="font-size:11px; color:#888; font-weight:normal;">(Debes tener al menos 13 años)</span>
          </label>
          <input type="date" id="campo-fecha" name="campo-fecha">
          <span class="error-msg" id="error-fecha"></span>
        </div>

        <div class="form-grupo-radio">
          <label class="titulo-grupo">Género *</label>
          <div class="opciones-radio">
            <label class="opcion-radio"><input type="radio" name="genero" value="masculino"> Masculino</label>
            <label class="opcion-radio"><input type="radio" name="genero" value="femenino"> Femenino</label>
            <label class="opcion-radio"><input type="radio" name="genero" value="otro"> Otro</label>
            <label class="opcion-radio"><input type="radio" name="genero" value="prefiero-no-decir"> Prefiero no decirlo</label>
          </div>
          <span class="error-msg" id="error-genero"></span>
        </div>

        <div class="form-grupo-check">
          <label class="titulo-grupo">Plataformas favoritas * (selecciona al menos una)</label>
          <div class="opciones-check">
            <label class="opcion-check"><input type="checkbox" name="plataforma" value="pc"> PC</label>
            <label class="opcion-check"><input type="checkbox" name="plataforma" value="ps5"> PlayStation</label>
            <label class="opcion-check"><input type="checkbox" name="plataforma" value="xbox"> Xbox</label>
            <label class="opcion-check"><input type="checkbox" name="plataforma" value="switch"> Nintendo Switch</label>
            <label class="opcion-check"><input type="checkbox" name="plataforma" value="movil"> Móvil</label>
          </div>
          <span class="error-msg" id="error-plataformas"></span>
        </div>

        <div class="form-grupo">
          <label for="campo-nivel">Nivel de jugador *</label>
          <select id="campo-nivel" name="campo-nivel">
            <option value="0">-- Selecciona tu nivel --</option>
            <option value="casual">Casual (juego de vez en cuando)</option>
            <option value="regular">Regular (varias horas a la semana)</option>
            <option value="hardcore">Hardcore (juego todos los días)</option>
            <option value="competitivo">Competitivo (torneos y rankings)</option>
            <option value="speedrunner">Speedrunner / Completista</option>
          </select>
          <span class="error-msg" id="error-nivel"></span>
        </div>

        <div class="form-grupo">
          <label for="campo-mensaje">Preséntate a la comunidad *
            <span style="font-size:11px; color:#888; font-weight:normal;">(Entre 10 y 500 caracteres)</span>
          </label>
          <textarea id="campo-mensaje" name="campo-mensaje" placeholder="Cuéntanos quién eres, qué géneros te gustan, cuál es tu juego favorito..." maxlength="500"></textarea>
          <span id="contador-mensaje">500 caracteres restantes</span>
          <span class="error-msg" id="error-mensaje"></span>
        </div>

        <div class="terminos-wrapper">
          <input type="checkbox" id="campo-terminos">
          <label for="campo-terminos">
            Acepto los <a href="#">términos y condiciones</a> y la
            <a href="#">política de privacidad</a> de GameCrypt *
          </label>
        </div>
        <span class="error-msg" id="error-terminos"></span>

        <button type="submit" class="btn-enviar">
          <i class="fa-solid fa-gamepad"></i> Crear mi cuenta en GameCrypt
        </button>

      </form>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-logo">
        <a href="Web.php">GameCrypt</a>
      </div>
      <div class="footer-links">
        <a href="#contacto">Contacto</a>
        <a href="HTML/quienes-somos.php">¿Quiénes somos?</a>
      </div>
      <div class="footer-location">
        <i class="fa-solid fa-location-dot"></i>
        <a href="https://www.google.com/maps/place/Universidad+Europea+de+Madrid+(Campus+de+Alcobendas)/@40.5351308,-3.6187949,16z">
          Avenida de Fernando Alonso 8
        </a>
      </div>
      <div id="info-sistema" title="Info del navegador"></div>
      <div class="footer-copy">
        &copy; 2025 GameCrypt. Todos los derechos reservados.
      </div>
    </div>
  </footer>

  <button id="btn-volver-arriba" aria-label="Volver al inicio" aria-hidden="true">↑</button>

  <script src="JS/main.js"></script>
  <script src="JS/formulario.js"></script>

  <?php if ($mensajeRegistro !== ""): ?>
<script>
    // Cerramos el mensaje flotante al hacer clic en Aceptar
    // Separamos el JS del HTML para no usar onclick inline
    document.getElementById('btn-cerrar-registro').addEventListener('click', function() {
        document.getElementById('mensaje-registro-flotante').style.display = 'none';
    });
</script>
<?php endif; ?>

<?php if ($loginError !== ""): ?>
<script>
    // Si hay error de login, abrimos el modal automáticamente
    document.addEventListener('DOMContentLoaded', function() {
        const overlayLogin = document.getElementById('overlay-login');
        if (overlayLogin) {
            overlayLogin.classList.add('activo');
        }
    });
</script>
<?php endif; ?>


</body>

</html>