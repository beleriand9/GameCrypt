<?php
// adminListar.php — muestra todos los usuarios registrados
// Solo accesible para el rol 'admin'
session_start();
include 'conexion.php';

// Comprobamos que hay sesión activa y que el usuario es admin
// Si no, redirigimos a Web.php sin dar acceso
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../Web.php");
    exit();
}

// Obtenemos todos los usuarios de la BD (SELECT = R de CRUD)
$resultado = mysqli_query($conexion, "SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - GameCrypt</title>
    <link rel="stylesheet" href="../CSS/Web.css">
    <link rel="stylesheet" href="../CSS/navegador.css">
    <link rel="stylesheet" href="../CSS/menu-js.css">
    <link rel="stylesheet" href="../CSS/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

<!-- Ventana emergente de confirmación de borrado personalizado -->
<div id="modal-confirmar" style="
    display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.7); z-index:99999;
    justify-content:center; align-items:center;">
    <div style="
        background:#2C2F35; border-radius:20px; padding:40px 50px;
        text-align:center; max-width:400px; width:90%;
        box-shadow:0 10px 40px rgba(0,0,0,0.7);
        border: 2px solid #ff4444;">
        <p style="font-family:'VT323',monospace; font-size:48px; color:#ffa500; margin-bottom:10px;">
            GameCrypt
        </p>
        <i class="fa-solid fa-triangle-exclamation" style="font-size:50px; color:#ff4444; margin-bottom:20px; display:block;"></i>
        <p style="color:white; font-size:18px; margin-bottom:30px;">
            ¿Seguro que quieres borrar este usuario?
        </p>
        <div style="display:flex; gap:15px; justify-content:center;">
            <button id="btn-confirmar-si" style="
                background:#ff4444; color:white; border:none; border-radius:10px;
                padding:12px 30px; font-size:16px; cursor:pointer; font-weight:bold;">
                Sí, borrar
            </button>
            <button id="btn-confirmar-no" style="
                background:#515966; color:white; border:none; border-radius:10px;
                padding:12px 30px; font-size:16px; cursor:pointer; font-weight:bold;">
                Cancelar
            </button>
        </div>
    </div>
</div>

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
        <h2 class="admin-titulo">Panel de Administrador</h2>

        <!-- Mensaje de confirmación si viene de borrar o editar -->
        <?php if (isset($_SESSION['admin_msg'])): ?>
            <p style="color:#04BD7D; text-align:center; margin-bottom:15px;">
                <?php echo $_SESSION['admin_msg']; unset($_SESSION['admin_msg']); ?>
            </p>
        <?php endif; ?>

        <table class="admin-tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Nivel</th>
                    <th>Rol</th>
                    <th>Fecha registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
        <?php while ($usuario = $resultado->fetch_row()): ?>
<tr>
    <td><?php echo $usuario[0]; ?></td>  <!-- id -->
    <td><?php echo $usuario[1]; ?></td>  <!-- nombre -->
    <td><?php echo $usuario[2]; ?></td>  <!-- email -->
    <td><?php echo $usuario[4]; ?></td>  <!-- telefono -->
    <td><?php echo $usuario[7]; ?></td>  <!-- nivel -->
    <td>
        <?php if ($usuario[9] === 'admin'): ?>
            <span class="badge-admin">admin</span>
        <?php else: ?>
            <span class="badge-usuario">usuario</span>
        <?php endif; ?>
    </td>
    <td><?php echo $usuario[10]; ?></td>  <!-- fecha_registro -->
    <td>
        <!-- Botón editar -->
        <form method="POST" action="adminEditar.php" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo $usuario[0]; ?>">
            <button type="submit" class="btn-editar">Editar</button>
        </form>
       
<!-- Botón borrar con clase form-borrar para que JS lo encuentre-->
        <form method="POST" action="adminEliminar.php" style="display:inline;" class="form-borrar">
        <input type="hidden" name="id" value="<?php echo $usuario[0]; ?>">
        <button type="submit" class="btn-borrar">Borrar</button>
    </form>
</td>
        
</tr>
<?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="../JS/main.js"></script>

    <!-- Ventana emergente de confirmación de borrado personalizado -->
<script>
        
        // Variable que guarda el formulario que el usuario quiere enviar
        // Empieza como null porque todavía no hay ningún formulario pendiente
        let formularioPendiente = null;

        //Selecciona TODOS los formularios con clase form-borrar 
        // hay uno por cada fila de usuario en la tabla. 
        // El forEach recorre todos y aplica el mismo evento a cada uno.

        document.querySelectorAll('.form-borrar').forEach(function(form) {
           
        //Cuando el usuario pulsa "Borrar", interceptamos el envío con preventDefault()
        // el formulario no se envía todavía.
        form.addEventListener('submit', function(e) {
                e.preventDefault(); 

                //Guardamos el formulario que se intentó enviar en formularioPendiente. 
                // Necesitamos recordarlo porque hay varios formularios en la tabla y tenemos que saber cuál enviar
                //  si el usuario confirma.
                formularioPendiente = form;

                //Mostramos el modal de confirmación cambiando su display a flex.
                document.getElementById('modal-confirmar').style.display = 'flex';
            });
        });

        //Si el usuario pulsa "Sí, borrar", enviamos el formulario que teníamos guardado en formularioPendiente. El if comprueba que existe por seguridad.
        document.getElementById('btn-confirmar-si').addEventListener('click', function() {
            if (formularioPendiente) {
                formularioPendiente.submit();
            }
        });
            //Si el usuario pulsa "Cancelar", ocultamos el modal y limpiamos formularioPendiente poniéndolo a null. Como si no hubiera pasado nada.
        document.getElementById('btn-confirmar-no').addEventListener('click', function() {
            document.getElementById('modal-confirmar').style.display = 'none';
            formularioPendiente = null;
        });
    </script>

</body>
</html>