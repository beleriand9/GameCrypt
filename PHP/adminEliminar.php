<?php
// adminEliminar.php — elimina un usuario de la BD
// Solo accesible para el rol 'admin'
session_start();
include 'conexion.php';

// Comprobamos que hay sesión activa y que el usuario es admin
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../Web.php");
    exit();
}

// Recogemos el id del usuario a borrar que viene por POST
$id = (int)$_POST['id'];

// Sentencia preparada para borrar el usuario
// (int) convierte a entero por seguridad antes de usarlo
$stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute() === TRUE) {
    // Guardamos mensaje de confirmación en sesión para mostrarlo en adminListar
    $_SESSION['admin_msg'] = "Usuario eliminado correctamente.";
} else {
    $_SESSION['admin_msg'] = "Error al eliminar el usuario.";
}

$stmt->close();

// Volvemos al panel de administración
header("Location: adminListar.php");
exit();
?>