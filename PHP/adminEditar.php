<?php
// adminEditar.php muestra el formulario con los datos actuales del usuario a editar
// Solo accesible para el rol 'admin'
session_start();
include 'conexion.php';

// Comprobamos que hay sesión activa y que el usuario es admin

//lectura del if: SI (no hay sesión iniciada) O (el rol no es admin)
//  redirige a Web.php y para
$estaLogueado = isset($_SESSION['usuario']);
$esAdmin = isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';

// Si no está logueado o no es admin, redirigir a Web.php
if (!$estaLogueado || !$esAdmin) {
    header("Location: ../Web.php");
    exit();
}

// Recogemos el id del usuario a editar que viene por POST
$id = (int)$_POST['id'];

// Buscamos el usuario en la BD con sentencia preparada
// Necesitamos sus datos actuales para rellenar el formulario
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = mysqli_fetch_row($resultado);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - GameCrypt</title>
    <link rel="stylesheet" href="../CSS/Web.css">
    <link rel="stylesheet" href="../CSS/navegador.css">
    <link rel="stylesheet" href="../CSS/menu-js.css">
    <link rel="stylesheet" href="../CSS/admin.css">
    <link rel="stylesheet" href="../CSS/formulario.css">
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

    <div class="nav">
        <h1><a href="../Web.php">GameCrypt</a></h1>
        <div class="nav-right">
            <span style="color:#04BD7D; font-size:14px;">
                <i class="fa-solid fa-user-shield"></i> <?php echo $_SESSION['usuario']; ?>
            </span>
            <form method="POST" action="logout.php" style="display:inline;">
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
                </button>
            </form>
        </div>
    </div>

    <div class="admin-wrapper">
        <h2 class="admin-titulo">Editar Usuario</h2>

        <!-- El formulario envía los datos a adminEditarGuardar.php por POST -->
        <div class="form-completo-wrapper">
            <form method="POST" action="adminEditarGuardar.php">

                <!-- Campo oculto con el id del usuario a editar -->
                <!-- El usuario no lo ve pero se envía a adminEditarGuardar.php -->
                <input type="hidden" name="id" value="<?php echo $usuario[0]; ?>">

                <div class="form-grupo">
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="<?php echo $usuario[1]; ?>">
                </div>

                <div class="form-grupo">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $usuario[2]; ?>">
                </div>

                <div class="form-grupo">
                    <label>Teléfono</label>
                    <input type="tel" name="telefono" value="<?php echo $usuario[4]; ?>">
                </div>

                <div class="form-grupo">
                    <label>Nivel</label>
                    <select name="nivel">
                        <option value="casual"    <?php echo $usuario[7] === 'casual'      ? 'selected' : ''; ?>>Casual</option>
                        <option value="regular"   <?php echo $usuario[7] === 'regular'     ? 'selected' : ''; ?>>Regular</option>
                        <option value="hardcore"  <?php echo $usuario[7] === 'hardcore'    ? 'selected' : ''; ?>>Hardcore</option>
                        <option value="competitivo" <?php echo $usuario[7] === 'competitivo' ? 'selected' : ''; ?>>Competitivo</option>
                        <option value="speedrunner" <?php echo $usuario[7] === 'speedrunner' ? 'selected' : ''; ?>>Speedrunner</option>
                    </select>
                </div>

                <div class="form-grupo">
                    <label>Rol</label>
                    <select name="rol">
                        <option value="usuario" <?php echo $usuario[9] === 'usuario' ? 'selected' : ''; ?>>Usuario</option>
                        <option value="admin"   <?php echo $usuario[9] === 'admin'   ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn-enviar">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar cambios
                </button>

                <a href="adminListar.php" style="
                    <a href="adminListar.php">
    <button type="button" style="
        width:100%; 
        background:#515966; 
        color:white; 
        border:none; 
        border-radius:10px;
        padding:14px; 
        font-size:16px; 
        cursor:pointer; 
        font-weight:bold;
        margin-top:10px;
        transition: background 0.3s;">
        <i class="fa-solid fa-arrow-left"></i> Cancelar y volver
    </button>
</a>
                </a>

            </form>
        </div>
    </div>

    <script src="../JS/main.js"></script>
</body>
</html>