<?php

// session_start() debe ir al principio del todo — solo se llama una vez por archivo
// Es necesario para poder usar $_SESSION en este archivo
session_start();
// Incluimos la conexión a la BD
include 'conexion.php';

// Recogemos los datos del formulario que vienen por POST. El name se define en el HTML del formulario en Web.php.
$nombre = $_POST['campo-nombre'];  //los campos son atributos de tipo name, que pertenecen al metodo POST
$email = $_POST['campo-email'];
$password = $_POST['campo-password'];
$telefono = $_POST['campo-telefono'];
$fecha_nacimiento = $_POST['campo-fecha'];
$genero = $_POST['genero'];
$nivel = $_POST['campo-nivel'];
$mensaje = $_POST['campo-mensaje'];

// Comprobamos que los campos obligatorios no estén vacíos
if (empty($nombre) || empty($email) || empty($password)) {
    $_SESSION['registro_error'] = "Los campos obligatorios no pueden estar vacíos.";
    header("Location: ../Web.php#registro-completo");
    exit();
}
// Comprobamos si el email ya existe en la BD. Usamos el e-mail porque es un campo UNIQUE en la creacion de la tabla usuarios. Asi comprobamos si ese usuario ya existe
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // El email ya existe — guardamos el error en sesión y redirigimos
    $_SESSION['registro_error'] = "Ese email ya está registrado. Prueba con otro.";
    header("Location: ../Web.php#registro-completo");
    exit();
}
$stmt->close(); //le digo que ya he terminado con esta sentencia, y libera la memoria que estaba usando 

// Insertamos el usuario en la BD con sentencia preparada
$stmt = $conexion->prepare("INSERT INTO usuarios 
    (nombre, email, password, telefono, fecha_nacimiento, genero, nivel, mensaje) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssss", 
    $nombre, $email, $password, 
    $telefono, $fecha_nacimiento, 
    $genero, $nivel, $mensaje);

    if ($stmt->execute() === TRUE) {
        // Guardamos el mensaje de éxito en la sesión para mostrarlo en Web.php
        // $_SESSION guarda datos entre páginas sin que aparezcan en la URL
        $_SESSION['registro_ok'] = "¡Bienvenido a GameCrypt! Tu cuenta ha sido creada correctamente.";
        
        // header() redirige al navegador a Web.php. 
        // Es una instrucción HTTP que el navegador obedece automáticamente.
        // exit() para la ejecución de PHP inmediatamente después del redireccionamiento
        header("Location: ../Web.php");
        exit();
    
    } else {
        // Si falla el INSERT, guardamos el error en sesión y volvemos al formulario
        $_SESSION['registro_error'] = "Error al registrar. Inténtalo de nuevo.";
        header("Location: ../Web.php#registro-completo");
        exit();
    }

/* $_SESSION es un array especial de PHP que permite guardar datos que persisten entre páginas mientras el usuario navega por la web.
El problema que resuelve es este: normalmente PHP no recuerda nada entre una página y otra. Cuando vas de guardar_usuario.php a Web.php, 
PHP empieza de cero y no sabe nada de lo que pasó antes. Es como si cada página fuera independiente.
$_SESSION soluciona esto guardando datos en el servidor asociados a ese usuario concreto. 
El navegador guarda una cookie con un ID de sesión único, y PHP usa ese ID para encontrar los datos guardados en el servidor.  */



// $stmt->close();      // ya no necesario: exit() para la ejecución antes de llegar aquí
// $conexion->close();  // ya no necesario: exit() para la ejecución antes de llegar aquí
?>