// ============================================================
//  GAMECRYPT — formulario.js
//  Validacion completa del formulario de registro
//  Criterios cubiertos:
//    · Criterio 1  - DOM: modificar CSS y atributos para marcar errores
//    · Criterio 3  - Eventos: submit, focus, blur, keyup, change, click
//    · Criterio 5  - Validacion de TODOS los campos del formulario
//    · Criterio 6  - Validar al enviar el formulario completo
//    · Criterio 7  - Senalar TODOS los campos con valores no validos
//    · Criterio 8  - 3 formas de indicar errores:
//                    1) borde rojo en el input
//                    2) mensaje de texto debajo del campo
//                    3) atributo aria-invalid
//    · Criterio 9  - Expresiones regulares en todos los campos
// ============================================================

document.addEventListener("DOMContentLoaded", function () {


    const form = document.getElementById("form-registro-completo");
    if (!form) return; 

    const campoNombre      = document.getElementById("campo-nombre");
    const campoEmail       = document.getElementById("campo-email");
    const campoPassword    = document.getElementById("campo-password");
    const campoPasswordRep = document.getElementById("campo-password-rep");
    const campoTelefono    = document.getElementById("campo-telefono");
    const campoFecha       = document.getElementById("campo-fecha");
    const campoGenero      = document.querySelectorAll("input[name='genero']");
    const campoPlataformas = document.querySelectorAll("input[name='plataforma']");
    const campoNivel       = document.getElementById("campo-nivel");
    const campoMensaje     = document.getElementById("campo-mensaje");
    const campoTerminos    = document.getElementById("campo-terminos");

    const errorNombre      = document.getElementById("error-nombre");
    const errorEmail       = document.getElementById("error-email");
    const errorPassword    = document.getElementById("error-password");
    const errorPasswordRep = document.getElementById("error-password-rep");
    const errorTelefono    = document.getElementById("error-telefono");
    const errorFecha       = document.getElementById("error-fecha");
    const errorGenero      = document.getElementById("error-genero");
    const errorPlataformas = document.getElementById("error-plataformas");
    const errorNivel       = document.getElementById("error-nivel");
    const errorMensaje     = document.getElementById("error-mensaje");
    const errorTerminos    = document.getElementById("error-terminos");

    const mensajeExito     = document.getElementById("mensaje-exito");

    const regexNombre   = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,40}$/;
    const regexEmail    = /^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/;
    const regexPassword = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/;
    const regexTelefono = /^(\+34|0034)?[\s\-]?[6789]\d{8}$/;
    const regexMensaje  = /^.{10,500}$/;

    function mostrarError(campo, elementoError, mensaje) {
        if (!campo || !elementoError) return;
        // modificar propiedad CSS
        campo.style.borderBottom    = "2px solid #ff4444";
        campo.style.backgroundColor = "rgba(255, 68, 68, 0.1)";
        // modificar textContent
        elementoError.textContent   = mensaje;
        elementoError.style.display = "block";
        elementoError.style.color   = "#ff4444";
        // setAttribute modifica atributo HTML
        campo.setAttribute("aria-invalid", "true");
        campo.classList.add("campo-error");
        campo.classList.remove("campo-ok");
    }

    // ========================================================
    // FUNCION AUXILIAR: Mostrar campo correcto
    // ========================================================
    function mostrarOk(campo, elementoError) {
        if (!campo || !elementoError) return;
        campo.style.borderBottom    = "2px solid #04BD7D";
        campo.style.backgroundColor = "rgba(4, 189, 125, 0.1)";
        elementoError.textContent   = "";
        elementoError.style.display = "none";
        campo.setAttribute("aria-invalid", "false");
        campo.classList.remove("campo-error");
        campo.classList.add("campo-ok");
    }

    // ========================================================
    // FUNCION AUXILIAR: Limpiar estado
    // ========================================================
    function limpiarEstado(campo, elementoError) {
        if (!campo || !elementoError) return;
        campo.style.borderBottom    = "";
        campo.style.backgroundColor = "";
        elementoError.textContent   = "";
        elementoError.style.display = "none";
        campo.removeAttribute("aria-invalid");
        campo.classList.remove("campo-error", "campo-ok");
    }

    // ========================================================
    // FUNCIONES DE VALIDACION INDIVIDUAL
    // ========================================================

    function validarNombre() {
        const valor = campoNombre.value.trim();
        if (valor.length === 0) {
            mostrarError(campoNombre, errorNombre, "El nombre es obligatorio.");
            return false;
        }
        if (!regexNombre.test(valor)) {
            mostrarError(campoNombre, errorNombre, "Solo letras y espacios. Entre 3 y 40 caracteres.");
            return false;
        }
        mostrarOk(campoNombre, errorNombre);
        return true;
    }

    function validarEmail() {
        const valor = campoEmail.value.trim();
        if (valor.length === 0) {
            mostrarError(campoEmail, errorEmail, "El correo es obligatorio.");
            return false;
        }
        if (!regexEmail.test(valor)) {
            mostrarError(campoEmail, errorEmail, "Introduce un correo válido. Ej: usuario@dominio.com");
            return false;
        }
        mostrarOk(campoEmail, errorEmail);
        return true;
    }

    function validarPassword() {
        const valor = campoPassword.value;
        if (valor.length === 0) {
            mostrarError(campoPassword, errorPassword, "La contraseña es obligatoria.");
            return false;
        }
        if (!regexPassword.test(valor)) {
            mostrarError(campoPassword, errorPassword,
                "Mínimo 8 caracteres, 1 mayúscula, 1 número y 1 carácter especial (!@#$%^&*).");
            return false;
        }
        mostrarOk(campoPassword, errorPassword);
        return true;
    }

    function validarPasswordRep() {
        const valor = campoPasswordRep.value;
        if (valor.length === 0) {
            mostrarError(campoPasswordRep, errorPasswordRep, "Debes repetir la contraseña.");
            return false;
        }
        if (valor !== campoPassword.value) {
            mostrarError(campoPasswordRep, errorPasswordRep, "Las contraseñas no coinciden.");
            return false;
        }
        mostrarOk(campoPasswordRep, errorPasswordRep);
        return true;
    }

    function validarTelefono() {
        const valor = campoTelefono.value.trim();
        if (valor.length === 0) {
            mostrarError(campoTelefono, errorTelefono, "El teléfono es obligatorio.");
            return false;
        }
        if (!regexTelefono.test(valor)) {
            mostrarError(campoTelefono, errorTelefono, "Teléfono español válido. Ej: 612345678 o +34 612345678");
            return false;
        }
        mostrarOk(campoTelefono, errorTelefono);
        return true;
    }

    function validarFecha() {
        const valor = campoFecha.value;
        if (!valor) {
            mostrarError(campoFecha, errorFecha, "La fecha de nacimiento es obligatoria.");
            return false;
        }
        const hoy        = new Date();
        const nacimiento = new Date(valor);
        let edad = hoy.getFullYear() - nacimiento.getFullYear();
        const mes = hoy.getMonth() - nacimiento.getMonth();
        if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) edad--;
        if (edad < 13) {
            mostrarError(campoFecha, errorFecha, "Debes tener al menos 13 años para registrarte.");
            return false;
        }
        if (edad > 120) {
            mostrarError(campoFecha, errorFecha, "Introduce una fecha de nacimiento válida.");
            return false;
        }
        mostrarOk(campoFecha, errorFecha);
        return true;
    }

    function validarGenero() {
        let seleccionado = false;
        campoGenero.forEach(function (radio) {
            if (radio.checked) seleccionado = true;
        });
        if (!seleccionado) {
            errorGenero.textContent   = "Selecciona una opción de género.";
            errorGenero.style.display = "block";
            errorGenero.style.color   = "#ff4444";
            return false;
        }
        errorGenero.textContent   = "";
        errorGenero.style.display = "none";
        return true;
    }

    function validarPlataformas() {
        let marcado = false;
        campoPlataformas.forEach(function (cb) {
            if (cb.checked) marcado = true;
        });
        if (!marcado) {
            errorPlataformas.textContent   = "Selecciona al menos una plataforma.";
            errorPlataformas.style.display = "block";
            errorPlataformas.style.color   = "#ff4444";
            return false;
        }
        errorPlataformas.textContent   = "";
        errorPlataformas.style.display = "none";
        return true;
    }

    function validarNivel() {
        if (campoNivel.value === "" || campoNivel.value === "0") {
            mostrarError(campoNivel, errorNivel, "Selecciona tu nivel de jugador.");
            return false;
        }
        mostrarOk(campoNivel, errorNivel);
        return true;
    }

    function validarMensaje() {
        const valor = campoMensaje.value.trim();
        if (valor.length === 0) {
            mostrarError(campoMensaje, errorMensaje, "El mensaje es obligatorio.");
            return false;
        }
        if (!regexMensaje.test(valor)) {
            mostrarError(campoMensaje, errorMensaje, "El mensaje debe tener entre 10 y 500 caracteres.");
            return false;
        }
        mostrarOk(campoMensaje, errorMensaje);
        return true;
    }

    function validarTerminos() {
        if (!campoTerminos.checked) {
            errorTerminos.textContent   = "Debes aceptar los términos y condiciones.";
            errorTerminos.style.display = "block";
            errorTerminos.style.color   = "#ff4444";
            campoTerminos.setAttribute("aria-invalid", "true");
            return false;
        }
        errorTerminos.textContent   = "";
        errorTerminos.style.display = "none";
        campoTerminos.setAttribute("aria-invalid", "false");
        return true;
    }

    // ========================================================
    // CONTADOR DE CARACTERES EN TEXTAREA
    // ========================================================
    const contadorMensaje = document.getElementById("contador-mensaje");
    if (campoMensaje && contadorMensaje) {
        campoMensaje.addEventListener("keyup", function () {
            const restantes = 500 - campoMensaje.value.length;
            contadorMensaje.textContent = restantes + " caracteres restantes";
            contadorMensaje.style.color = restantes < 50 ? "#ff4444" : "#04BD7D";
        });
    }

    // ========================================================
    // VALIDACION EN TIEMPO REAL AL SALIR DEL CAMPO
    // ========================================================
    if (campoNombre)      campoNombre.addEventListener("blur",   validarNombre);
    if (campoEmail)       campoEmail.addEventListener("blur",    validarEmail);
    if (campoPassword)    campoPassword.addEventListener("blur",  validarPassword);
    if (campoPasswordRep) campoPasswordRep.addEventListener("blur", validarPasswordRep);
    if (campoTelefono)    campoTelefono.addEventListener("blur",  validarTelefono);
    if (campoFecha)       campoFecha.addEventListener("blur",    validarFecha);
    if (campoNivel)       campoNivel.addEventListener("change",  validarNivel);
    if (campoMensaje)     campoMensaje.addEventListener("blur",  validarMensaje);

    /*if (campoNombre)      campoNombre.addEventListener("focus",      function () { limpiarEstado(campoNombre, errorNombre); });
    if (campoEmail)       campoEmail.addEventListener("focus",       function () { limpiarEstado(campoEmail, errorEmail); });
    if (campoPassword)    campoPassword.addEventListener("focus",    function () { limpiarEstado(campoPassword, errorPassword); });
    if (campoPasswordRep) campoPasswordRep.addEventListener("focus", function () { limpiarEstado(campoPasswordRep, errorPasswordRep); });
    if (campoTelefono)    campoTelefono.addEventListener("focus",    function () { limpiarEstado(campoTelefono, errorTelefono); });*/

    // ========================================================
    // BARRA DE FORTALEZA DE CONTRASENA
    // ========================================================
    const barraFuerza = document.getElementById("barra-fuerza-password");
    const textoFuerza = document.getElementById("texto-fuerza-password");
    if (campoPassword && barraFuerza && textoFuerza) {
        campoPassword.addEventListener("keyup", function () {
            const val = campoPassword.value;
            let puntos = 0;
            if (val.length >= 8)        puntos++;
            if (/[A-Z]/.test(val))      puntos++;
            if (/\d/.test(val))         puntos++;
            if (/[!@#$%^&*]/.test(val)) puntos++;

            const pct = (puntos / 4) * 100;
            barraFuerza.style.width = pct + "%";

            if (puntos <= 1) {
                barraFuerza.style.backgroundColor = "#ff4444";
                textoFuerza.textContent = "Contraseña débil";
                textoFuerza.style.color = "#ff4444";
            } else if (puntos <= 3) {
                barraFuerza.style.backgroundColor = "#ffa500";
                textoFuerza.textContent = "Contraseña media";
                textoFuerza.style.color = "#ffa500";
            } else {
                barraFuerza.style.backgroundColor = "#04BD7D";
                textoFuerza.textContent = "Contraseña fuerte";
                textoFuerza.style.color = "#04BD7D";
            }
        });
    }

    // ========================================================
    // ENVIO DEL FORMULARIO
    // ========================================================
    form.addEventListener("submit", function (e) {
        e.preventDefault(); //esto lo usabamos porque no teniamos PHP todavía. Con preventDefault se previene el comportamiento por defecto del navegador. 
                            //necesitabamos que el formulario no recargara la página para poder mostrar el mensaje de éxito en verde

        const okNombre      = validarNombre();
        const okEmail       = validarEmail();
        const okPassword    = validarPassword();
        const okPasswordRep = validarPasswordRep();
        const okTelefono    = validarTelefono();
        const okFecha       = validarFecha();
        const okGenero      = validarGenero();
        const okPlataformas = validarPlataformas();
        const okNivel       = validarNivel();
        const okMensaje     = validarMensaje();
        const okTerminos    = validarTerminos();

        const todoValido = okNombre && okEmail && okPassword && okPasswordRep &&
                           okTelefono && okFecha && okGenero && okPlataformas &&
                           okNivel && okMensaje && okTerminos;

        if (todoValido) {
            if (mensajeExito) {
                mensajeExito.style.display      = "block";
                mensajeExito.style.background   = "rgba(4,189,125,0.2)";
                mensajeExito.style.border       = "1px solid #04BD7D";
                mensajeExito.style.color        = "#04BD7D";
                mensajeExito.style.padding      = "15px";
                mensajeExito.style.borderRadius = "8px";
                mensajeExito.style.textAlign    = "center";
                mensajeExito.style.fontWeight   = "bold";
                mensajeExito.style.marginBottom = "20px";
                mensajeExito.setAttribute("role", "alert");
                mensajeExito.textContent = "Registro completado con éxito! Bienvenido a GameCrypt.";

                setTimeout(function () {
                    form.submit() //envia los datos a guardar_usuario.php. Obedece lo que pone en el action del formulario HTML (en el que conecta el formulario con PHP)
                   // mensajeExito.style.display = "none"; -> esta linea servia para ocultar el mensaje de éxito después de 5 segundos cuando nos quedabamos en la misma pagina. 
                   //Ahora form.submit() cambia la página de todas formas.
                }, 1500);
            }
           
           
            /*

            ANTES DE PHP SE RESETEABA EL FORMULARIO 
            // form.reset(); 
            // Ya no es necesario: antes limpiábamos el formulario porque nos quedábamos 
            // en la misma página. Ahora form.submit() redirige a guardar_usuario.php
            // y la página cambia de todas formas.


            form.reset();
            [campoNombre, campoEmail, campoPassword, campoPasswordRep,
             campoTelefono, campoFecha, campoNivel, campoMensaje].forEach(function (c) {
                if (c) {
                    c.style.borderBottom    = "";
                    c.style.backgroundColor = "";
                    c.classList.remove("campo-ok", "campo-error");
                }
            });*/


        } else {
            const primerError = form.querySelector(".campo-error");
            if (primerError) {
                primerError.scrollIntoView({ behavior: "smooth", block: "center" });
                primerError.focus();
            }
        }
    });

    // ========================================================
    // MOSTRAR / OCULTAR CONTRASENA
    // ========================================================
    const togglePassword = document.getElementById("toggle-password");
    if (togglePassword && campoPassword) {
        togglePassword.addEventListener("click", function () {
            const tipo = campoPassword.getAttribute("type");
            if (tipo === "password") {
                campoPassword.setAttribute("type", "text");    // DOM: setAttribute
                togglePassword.textContent = "Ocultar";
                togglePassword.setAttribute("title", "Ocultar contraseña");
            } else {
                campoPassword.setAttribute("type", "password");
                togglePassword.textContent = "Mostrar";
                togglePassword.setAttribute("title", "Mostrar contraseña");
            }
        });
    }

}); 