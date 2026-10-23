<?php
// adminEditarGuardar.php — recoge los datos del formulario de edición y actualiza en la BD
session_start();
include 'conexion.php';

$estaLogueado = isset($_SESSION['usuario']);
$esAdmin = isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';

if (!$estaLogueado || !$esAdmin) {
    header("Location: ../Web.php");
    exit();
}

// Recogemos los datos del formulario que vienen por POST
$id       = (int)$_POST['id'];
$nombre   = $_POST['nombre'];
$email    = $_POST['email'];
$telefono = $_POST['telefono'];
$nivel    = $_POST['nivel'];
$rol      = $_POST['rol'];

// Sentencia preparada para actualizar el usuario (UPDATE = U de CRUD)
$stmt = $conexion->prepare("UPDATE usuarios 
    SET nombre = ?, email = ?, telefono = ?, nivel = ?, rol = ?
    WHERE id = ?");

// "sssss i" → nombre=string, email=string, telefono=string, nivel=string, rol=string, id=integer
$stmt->bind_param("sssssi", $nombre, $email, $telefono, $nivel, $rol, $id);

if ($stmt->execute() === TRUE) {
    $_SESSION['admin_msg'] = "Usuario actualizado correctamente.";
} else {
    $_SESSION['admin_msg'] = "Error al actualizar el usuario.";
}

$stmt->close();

// Volvemos al panel de administración
header("Location: adminListar.php");
exit();
?>