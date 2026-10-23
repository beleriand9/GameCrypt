<?php
// logout.php:  cierra la sesión del usuario y redirige a Web.php
session_start();

// Destruimos todos los datos de la sesión
session_destroy();

// Redirigimos a la página principal
header("Location: ../Web.php");
exit();
?>

