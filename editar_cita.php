<?php
session_start();
include("conexion.php");

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener lista de servicios desde la base de datos
$servicios_disponibles = [];
$query_servicios = "SELECT id_servicio, nombre FROM servicios";
$result_servicios = mysqli_query($conexion, $query_servicios);

while ($fila = mysqli_fetch_assoc($result_servicios)) {
    $servicios_disponibles[$fila['id_servicio']] = $fila['nombre'];
}

// Obtener la cita actual para editar
$cita = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $cita_id = $_GET['id'];
    $query = "SELECT fecha, id_servicio FROM citas WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $cita_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $cita = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);
}

// Si no se encontró la cita, redirigir
if (!$cita) {
    header("Location: mis_citas.php");
    exit();
}

// Procesar la actualización de la cita
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cita_id'], $_POST['fecha'], $_POST['id_servicio']) && is_numeric($_POST['id_servicio'])) {
        $cita_id = $_POST['cita_id'];
        $fecha = $_POST['fecha'];
        $id_servicio = $_POST['id_servicio'];

        $query = "UPDATE citas SET fecha = ?, id_servicio = ? WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "sii", $fecha, $id_servicio, $cita_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Cita actualizada correctamente.'); window.location.href='mis_citas.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error al actualizar la cita.');</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Datos inválidos.');</script>";
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
    <link rel="stylesheet" href="eme.css">
</head>
<body>

<div class="edit-form-container">
    <h2>Editar Cita</h2>

    <form method="POST">
        <input type="hidden" name="cita_id" value="<?php echo htmlspecialchars($cita_id); ?>">
        
        <div class="input-group">
            <label>Fecha:</label>
            <input type="date" name="fecha" value="<?php echo htmlspecialchars($cita['fecha']); ?>" required>
        </div>

        <div class="input-group">
            <label>Servicio:</label>
            <select name="id_servicio" required>
                <?php foreach ($servicios_disponibles as $id => $nombre) { ?>
                    <option value="<?php echo $id; ?>" <?php echo ($cita['id_servicio'] == $id) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($nombre); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn">Actualizar</button>
            <a href="mis_citas.php" class="btn btn-cancel">Cancelar</a>
        </div>
    </form>
</div>

</body>
</html>
