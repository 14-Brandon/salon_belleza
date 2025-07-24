<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Asegurar que la tabla servicios tenga datos válidos
$query = "SELECT c.id, c.fecha, s.nombre AS servicio 
          FROM citas c
          JOIN servicios s ON c.id_servicio = s.id_servicio
          WHERE c.usuario_id = ?";

$stmt = $conexion->prepare($query);

if (!$stmt) {
    die("Error en la consulta: " . $conexion->error);
}

$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

if (!$resultado) {
    die("Error al obtener las citas: " . $conexion->error);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Citas</title>
    <link rel="stylesheet" href="eme.css">
</head>
<body>

<h2>Mis Citas</h2>

<?php if ($resultado->num_rows > 0): ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Servicio</th>
            <th>Acciones</th>
        </tr>

        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['fecha']; ?></td>
                <td><?php echo $row['servicio']; ?></td>
                <td>
                    <a href="editar_cita.php?id=<?php echo $row['id']; ?>">Editar</a> |
                    <a href="eliminar_cita.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta cita?');">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No tienes citas registradas.</p>
<?php endif; ?>

</body>
</html>

<?php
$stmt->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Citas</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function abrirModal(id, fecha, servicio) {
            document.getElementById("cita_id").value = id;
            document.getElementById("fecha").value = fecha;
            document.getElementById("servicio").value = servicio;
            document.getElementById("modal").style.display = "block";
        }

        function cerrarModal() {
            document.getElementById("modal").style.display = "none";
        }
    </script>
    <style>
        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            text-align: center;
        }

        .close {
            float: right;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>



<?php if (mysqli_num_rows($resultado) > 0) { ?>
    <table border="1">

        <?php while ($cita = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($cita['fecha']); ?></td>
                <td><?php echo htmlspecialchars($cita['servicio']); ?></td>
                <td>
                    <button onclick="abrirModal(<?php echo $cita['id']; ?>, '<?php echo $cita['fecha']; ?>', '<?php echo $cita['servicio']; ?>')">Editar</button>
                    <a href="eliminar_cita.php?id=<?php echo $cita['id']; ?>" onclick="return confirm('¿Eliminar esta cita?');">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p>No tienes citas agendadas.</p>
<?php } ?>

<!-- Modal para editar citas -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <h2>Editar Cita</h2>
        <form method="POST" action="editar_cita.php">
            <input type="hidden" name="cita_id" id="cita_id">
            
            <label>Fecha:</label>
            <input type="date" name="fecha" id="fecha" required><br>

            <label>Servicio:</label>
            <input type="text" name="servicio" id="servicio" required><br>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</div>

</body>
</html>
