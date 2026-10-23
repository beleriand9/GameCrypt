<?php
// login.php — solo procesa el formulario, el HTML está en el modal de Web.php
// session_start() al principio del todo: necesario para usar $_SESSION
session_start();

// Incluimos conexion.php siempre, no solo en POST
// Así se crea la BD si no existe aunque el usuario no haya enviado el formulario
include 'conexion.php';

// Si ya está logueado, redirigir según su rol sin pasar por el login
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['rol'] === 'admin') {
        header("Location: adminListar.php");
    } else {
        header("Location: ../Web.php");
    }
    exit();
}

// Procesamos el formulario cuando el usuario pulsa "Entrar"
// $_SERVER['REQUEST_METHOD'] comprueba si la petición es POST (viene del formulario)
// o GET (el usuario acaba de abrir la página sin enviar nada)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

// Validación básica antes de consultar la BD
    // Evita hacer consultas innecesarias si los campos están vacíos
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Por favor rellena todos los campos.";
        header("Location: ../Web.php");
        exit();
    }

    // filter_var con FILTER_VALIDATE_EMAIL es la función de PHP equivalente 
    // al regex de email que tenemos en formulario.js
    // Comprueba que el email tiene formato válido (algo@algo.algo)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['login_error'] = "El formato del email no es válido.";
        header("Location: ../Web.php");
        exit();
    }


    // Buscamos el usuario por email en la BD con sentencia preparada
    $stmt = $conexion->prepare("SELECT id, nombre, password, rol, nivel FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc(); // fetch_assoc devuelve la fila como array asociativo
    $stmt->close();

    // Comprobamos si el usuario existe y si la contraseña es correcta
    if ($usuario && $password === $usuario['password']) {
        // Guardamos los datos del usuario en la sesión
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['rol'] = $usuario['rol'];
        $_SESSION['email']   = $email; 
        $_SESSION['nivel']   = $usuario['nivel'];

        // Redirigimos según el rol
        if ($usuario['rol'] === 'admin') {
            header("Location: adminListar.php"); // admin va al panel de administración
        } else {
            header("Location: ../Web.php"); // usuario normal vuelve a la web
        }
        exit();

    } else {
        // Login incorrecto — guardamos el error en sesión y volvemos a Web.php
        $_SESSION['login_error'] = "Email o contraseña incorrectos.";
        header("Location: ../Web.php");
        exit();
    }
}


?>