
document.addEventListener("DOMContentLoaded", function () {

    
    // 1. RELOJ EN TIEMPO REAL
    
    const relojEl = document.getElementById("reloj-tiempo-real");
    let intervaloReloj = null;

    if (relojEl) {
        function actualizarReloj() {
            const ahora = new Date();
            const h = String(ahora.getHours()).padStart(2, "0");
            const m = String(ahora.getMinutes()).padStart(2, "0");
            const s = String(ahora.getSeconds()).padStart(2, "0");
            relojEl.textContent = h + ":" + m + ":" + s;
        }
        actualizarReloj();
        intervaloReloj = setInterval(actualizarReloj, 1000);

        relojEl.addEventListener("click", function () {
            if (intervaloReloj) {
                clearInterval(intervaloReloj);
                intervaloReloj = null;
                relojEl.style.color = "#ff4444";
                relojEl.style.opacity = "0.7";
                relojEl.title = "Pausado — clic para reanudar";
            } else {
                actualizarReloj();
                intervaloReloj = setInterval(actualizarReloj, 1000);
                relojEl.style.color = "#04BD7D";
                relojEl.style.opacity = "1";
                relojEl.title = "Haz clic para pausar";
            }
        });
    }

    
    // 2. TICKER DE NOTICIAS
    
    const tickerEl = document.getElementById("ticker-noticias");
    if (tickerEl) {
        setTimeout(function () {
            tickerEl.style.position = "fixed";
            tickerEl.style.top = "0";
            tickerEl.style.left = "0";
            tickerEl.style.width = "100%";
            tickerEl.style.zIndex = "1100";
            tickerEl.style.backgroundColor = "#ffa500";
            tickerEl.style.padding = "6px 0";
            tickerEl.style.overflow = "hidden";
            tickerEl.style.whiteSpace = "nowrap";
            tickerEl.style.borderBottom = "2px solid #ffa500";
            tickerEl.style.display = "block";
            tickerEl.style.opacity = "0";
            tickerEl.style.transition = "opacity 1s ease";
            setTimeout(function () {
                tickerEl.style.opacity = "1";
            }, 50);
        }, 3000);
    }

  
    // 2. CARRUSEL AUTOMÁTICO
   
    const contenedorSlides = document.querySelector('.slides');
    
    if (contenedorSlides) {
        const imagenes = contenedorSlides.querySelectorAll('img');
        
        if (imagenes.length > 0) {
            imagenes.forEach((img, index) => {
                if (index === 0) {
                    img.style.opacity = '1';
                    img.style.zIndex = '1';
                } else {
                    img.style.opacity = '0';
                    img.style.zIndex = '0';
                }
                img.style.transition = 'opacity 1s ease-in-out';
            });

            // Intervalo de cambio 3s
            let indiceActual = 0;
            setInterval(() => {
                // Ocultar actual
                imagenes[indiceActual].style.opacity = '0';
                imagenes[indiceActual].style.zIndex = '0';
                
                // Calcular siguiente
                indiceActual = (indiceActual + 1) % imagenes.length;
                
                // Mostrar siguiente
                imagenes[indiceActual].style.opacity = '1';
                imagenes[indiceActual].style.zIndex = '1';
            }, 3000);
        }
    }

    
    // 5. MENÚ CON JAVASCRIPT
  
    const esRaiz = !window.location.pathname.includes("/HTML/");
    const preRaiz = esRaiz ? "HTML/" : "";
    const preInicio = esRaiz ? "" : "../";

    const menuData = [
        {
            texto: "Categoría ▾",
            subs: [
                { t: "RPG", h: preRaiz + "rpg.php" },
                { t: "Terror", h: preRaiz + "terror.php" },
                { t: "Plataformeo", h: preRaiz + "plataformeo.php" },
                { t: "Acción Aventura", h: preRaiz + "accion.php" }
            ]
        },
        {
            texto: "Noticias ▾",
            subs: [
                { t: "Silent Hill Townfall", h: preRaiz + "noticias.php#noticia1" },
                { t: "Resident Evil Requiem", h: preRaiz + "noticias.php#noticia2" },
                { t: "Ubisoft Tendencias", h: preRaiz + "noticias.php#noticia3" },
                { t: "Live-action Zelda", h: preRaiz + "noticias.php#noticia4" },
                { t: "Expedition 33", h: preRaiz + "noticias.php#noticia5" }
            ]
        },
        {
            texto: "Comunidad ▾",
            subs: [
                { t: "Reseñas", h: preInicio + "Web.php#reseñas-usuarios" },
                { t: "¿Quiénes somos?", h: preRaiz + "quienes-somos.php" },
                { t: "Registro", h: preInicio + "Web.php#registro-completo" }
            ]
        }
    ];

    const contenedorMenu = document.getElementById("menu-js");
    if (contenedorMenu) {
        contenedorMenu.innerHTML = "";
        menuData.forEach(function (op) {
            const div = document.createElement("div");
            div.setAttribute("class", "menu-opcion");
            const span = document.createElement("span");
            span.setAttribute("class", "menu-opcion-texto");
            span.textContent = op.texto;
            const sub = document.createElement("div");
            sub.setAttribute("class", "menu-submenu");
            sub.style.display = "none";

            op.subs.forEach(function (s) {
                const a = document.createElement("a");
                a.setAttribute("href", s.h);
                a.setAttribute("class", "menu-subopcion");
                a.textContent = s.t;
                sub.appendChild(a);
            });

            div.appendChild(span);
            div.appendChild(sub);
            contenedorMenu.appendChild(div);

            div.addEventListener("mouseover", function () {
                sub.style.display = "flex";
                sub.style.flexDirection = "column";
                span.style.color = "#ffa500";
            });
            div.addEventListener("mouseout", function (e) {
                if (!div.contains(e.relatedTarget)) {
                    sub.style.display = "none";
                    span.style.color = "white";
                }
            });
            span.addEventListener("click", function () {
                const vis = sub.style.display === "flex";
                sub.style.display = vis ? "none" : "flex";
                if (!vis) sub.style.flexDirection = "column";
            });
        });
    }

    
    // 6. PERFIL DE USUARIO
    
    const overlayPerfil = document.getElementById("overlay-perfil");
    const btnAbrirPerfil = document.getElementById("btn-abrir-perfil");
    const btnCerrarPerfil = document.getElementById("btn-cerrar-perfil");

    if (btnAbrirPerfil && overlayPerfil) {
        btnAbrirPerfil.addEventListener("click", function () {
            overlayPerfil.classList.add("activo");
        });
    }
    if (btnCerrarPerfil && overlayPerfil) {
        btnCerrarPerfil.addEventListener("click", function () {
            overlayPerfil.classList.remove("activo");
        });
    }
    if (overlayPerfil) {
        overlayPerfil.addEventListener("click", function (e) {
            if (e.target === overlayPerfil) {
                overlayPerfil.classList.remove("activo");
            }
        });
    }

    // Datos del perfil
    const ventanaPerfil = document.querySelector(".ventana-perfil");
    if (ventanaPerfil) {
        const nav = window.navigator;
        const scr = window.screen;
        const fecha = new Date();
        const ua = new String(nav.userAgent);
        const xp = Math.floor(Math.random() * 100) + 1;

        let nombreNav = "Otro";
        if (ua.indexOf("Edg") > -1) nombreNav = "Edge";
        else if (ua.indexOf("Chrome") > -1) nombreNav = "Chrome";
        else if (ua.indexOf("Firefox") > -1) nombreNav = "Firefox";
        else if (ua.indexOf("Safari") > -1) nombreNav = "Safari";

        let so = "Desconocido";
        if (ua.indexOf("Windows") > -1) so = "Windows";
        else if (ua.indexOf("Mac") > -1) so = "macOS";
        else if (ua.indexOf("Linux") > -1) so = "Linux";
        else if (ua.indexOf("Android") > -1) so = "Android";
        else if (ua.indexOf("iPhone") > -1) so = "iOS";

        const hora = String(fecha.getHours()).padStart(2, "0") + ":" +
                     String(fecha.getMinutes()).padStart(2, "0");

        const perfilInfo = ventanaPerfil.querySelector(".perfil-info");
        if (perfilInfo) {
            const nombreGuardado = perfilInfo.querySelector('p:nth-child(2)')?.innerText.replace('Nombre: ', '') || 'Usuario Invitado';
            const emailGuardado  = perfilInfo.querySelector('p:nth-child(3)')?.innerText.replace('Correo: ', '')  || 'usuario@invitado.com';
            const nivelGuardado  = perfilInfo.querySelector('p:nth-child(4)')?.innerText.replace('Nivel: ', '')   || 'No disponible';
            perfilInfo.innerHTML =
                '<div class="foto-perfil" id="avatar-perfil">' +
                    '<i class="fa-solid fa-user"></i>' +
                '</div>' +
                '<p><strong>Nombre:</strong> ' + nombreGuardado + '</p>' +
                '<p><strong>Correo:</strong> ' + emailGuardado  + '</p>' +
                '<p><strong>Nivel:</strong> '  + nivelGuardado  + '</p>' +
                '<div class="perfil-separador"></div>' +
                '<p class="perfil-subtitulo">📊 Tu sesión actual</p>' +
                '<p><strong>Conectado a las:</strong> ' + hora + '</p>' +
                '<p><strong>Navegador:</strong> ' + nombreNav + '</p>' +
                '<p><strong>Sistema:</strong> ' + so + '</p>' +
                '<p><strong>Resolución:</strong> ' + scr.width + '×' + scr.height + '</p>' +
                '<p><strong>XP:</strong> ' + xp + ' / 100</p>' +
                '<div class="perfil-barra-xp-wrapper">' +
                    '<div class="perfil-barra-xp" id="barra-xp-anim" style="width:0%"></div>' +
                '</div>' +
                '<div class="perfil-separador"></div>' +
                '<p class="perfil-subtitulo">🎮 Elige tu avatar</p>' +
                '<select id="select-avatar" class="perfil-select">' +
                    '<option value="user">👤 Por defecto</option>' +
                    '<option value="ghost">👻 Fantasma</option>' +
                    '<option value="robot">🤖 Robot</option>' +
                    '<option value="dragon">🐲 Dragón</option>' +
                    '<option value="ninja">🥷 Ninja</option>' +
                    '<option value="alien">👾 Alien</option>' +
                '</select>';

            setTimeout(function () {
                const barra = document.getElementById("barra-xp-anim");
                if (barra) {
                    barra.style.transition = "width 1.2s ease";
                    barra.style.width = xp + "%";
                }
            }, 300);

            const selAvatar = document.getElementById("select-avatar");
            const iconoAv = document.getElementById("avatar-perfil");
            const avatares = {
                user: '<i class="fa-solid fa-user"></i>',
                ghost: '<span style="font-size:40px">👻</span>',
                robot: '<span style="font-size:40px">🤖</span>',
                dragon: '<span style="font-size:40px">🐲</span>',
                ninja: '<span style="font-size:40px">🥷</span>',
                alien: '<span style="font-size:40px">👾</span>'
            };
            if (selAvatar && iconoAv) {
                selAvatar.addEventListener("change", function () {
                    iconoAv.innerHTML = avatares[selAvatar.value];
                    iconoAv.style.transform = "scale(1.2)";
                    iconoAv.style.transition = "transform 0.3s";
                    setTimeout(function () {
                        iconoAv.style.transform = "scale(1)";
                    }, 300);
                });
            }
        }
    }

   
    // 7. BOTÓN REGISTRARSE 
 
    const btnRegistrarse = document.getElementById("btn-registrarse");
    if (btnRegistrarse) {
        btnRegistrarse.addEventListener("click", function () {
            if (document.getElementById("form-registro-completo")) {
                crearModalRegistro();
                const modal = document.getElementById("modal-registro-js");
                if (modal) modal.style.display = "flex";
            } else {
                const esRaizLocal = !window.location.pathname.includes("/HTML/");
                const base = esRaizLocal ? "" : "../../";
                window.location.href = base + "Web.php#registro-completo";
            }
        });
    }

    
    // 8. BOTÓN VOLVER ARRIBA
   
    const btnArriba = document.getElementById("btn-volver-arriba");
    if (btnArriba) {
        window.addEventListener("scroll", function () {
            btnArriba.style.display = window.scrollY > 400 ? "flex" : "none";
        });
        btnArriba.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

   
    // 9. INFO DEL SISTEMA EN FOOTER
    
    const infoEl = document.getElementById("info-sistema");
    if (infoEl) {
        const f = new Date();
        const nombre = new String("GameCrypt");
        const semilla = Math.floor(Math.random() * 9999);
        const dia = String(f.getDate()).padStart(2, "0");
        const mes = String(f.getMonth() + 1).padStart(2, "0");
        infoEl.textContent =
            nombre.toUpperCase() + " · " +
            dia + "/" + mes + "/" + f.getFullYear() + " · " +
            screen.width + "×" + screen.height + " · #" + semilla;
        infoEl.setAttribute("title", "Navegador: " + navigator.userAgent);
    }

    
    // 10. HOVER EN TARJETAS DE NOTICIAS
   
    document.querySelectorAll(".noticia-resumen, .noticia-col").forEach(function (t) {
        t.addEventListener("mouseover", function () {
            t.style.transform = "translateY(-5px)";
            t.style.transition = "transform 0.3s ease, box-shadow 0.3s ease";
            t.style.boxShadow = "0 8px 30px rgba(255,165,0,0.3)";
        });
        t.addEventListener("mouseout", function () {
            t.style.transform = "translateY(0)";
            t.style.boxShadow = "none";
        });
    });

    
    // 11. BOTÓN INICIAR SESIÓN — abre modal de login
    
    const btnIniciarSesion = document.getElementById("btn-iniciar-sesion");
    const overlayLogin = document.getElementById("overlay-login");
    const btnCerrarLogin = document.getElementById("btn-cerrar-login");

    if (btnIniciarSesion && overlayLogin) {
        btnIniciarSesion.addEventListener("click", function () {
            overlayLogin.classList.add("activo");
        });
    }
    if (btnCerrarLogin && overlayLogin) {
    btnCerrarLogin.addEventListener("click", function () {
        overlayLogin.classList.remove("activo");
        // Eliminamos el mensaje de error del DOM al cerrar el modal
        const errorLogin = document.getElementById("error-login-msg");
        if (errorLogin) errorLogin.remove();
    });
}
// Cerrar al hacer clic fuera del modal
if (overlayLogin) {
    overlayLogin.addEventListener("click", function (e) {
        if (e.target === overlayLogin) {
            overlayLogin.classList.remove("activo");
            // Eliminamos el mensaje de error del DOM al cerrar el modal
            const errorLogin = document.getElementById("error-login-msg");
            if (errorLogin) errorLogin.remove();
        }
    });
}


});  //FIN DOMContentLoaded


function crearModalRegistro() {
    if (document.getElementById("modal-registro-js")) return;

    const overlay = document.createElement("div");
    overlay.id = "modal-registro-js";
    overlay.style.cssText =
        "position:fixed; top:0; left:0; width:100%; height:100%;" +
        "background:rgba(0,0,0,0.7); display:none;" +
        "justify-content:center; align-items:center; z-index:99999;";

    const contenedor = document.createElement("div");
    contenedor.style.cssText =
        "background:#2C2F35; border-radius:20px; padding:30px 40px;" +
        "width:90%; max-width:600px; max-height:85vh;" +
        "overflow-y:auto; position:relative; color:#fff;";

    const btnCerrar = document.createElement("button");
    btnCerrar.innerHTML = '<i class="fa-solid fa-xmark"></i>';
    btnCerrar.style.cssText =
        "position:absolute; top:15px; right:20px; background:none;" +
        "border:none; color:#fff; font-size:22px; cursor:pointer;";
    btnCerrar.addEventListener("click", function () {
        overlay.style.display = "none";
    });

    overlay.addEventListener("click", function (e) {
        if (e.target === overlay) overlay.style.display = "none";
    });

    const titulo = document.createElement("h2");
    titulo.textContent = "Crear cuenta en GameCrypt";
    titulo.style.cssText =
        "text-align:center; color:#04BD7D; font-family:'VT323',monospace;" +
        "font-size:32px; margin-bottom:20px;";

    const formOriginal = document.getElementById("form-registro-completo");
    let formClonado;
    if (formOriginal) {
        formClonado = formOriginal.cloneNode(true);
        formClonado.id = "form-registro-modal";
        formClonado.querySelectorAll("[id]").forEach(function (el) {
            el.id = el.id + "-modal";
        });
        formClonado.querySelectorAll("[for]").forEach(function (el) {
            el.setAttribute("for", el.getAttribute("for") + "-modal");
        });
    } else {
        formClonado = document.createElement("p");
        formClonado.textContent = "Formulario no disponible.";
    }

    contenedor.appendChild(btnCerrar);
    contenedor.appendChild(titulo);
    contenedor.appendChild(formClonado);
    overlay.appendChild(contenedor);
    document.body.appendChild(overlay);
}