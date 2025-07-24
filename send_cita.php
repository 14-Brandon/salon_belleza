<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    die("Error: Usuario no autenticado.");
}

include("conexion.php");

$usuario_id = $_SESSION['usuario_id'];

$checkUser = $conexion->prepare("SELECT id FROM usuarios WHERE id = ?");
$checkUser->bind_param("i", $usuario_id);
$checkUser->execute();
$result = $checkUser->get_result();

if ($result->num_rows === 0) {
    die("Error: El usuario no existe en la base de datos.");
}
$checkUser->close();

if (!isset($_POST['name'], $_POST['service'], $_POST['phone'], $_POST['date'])) {
    die("Error: Datos incompletos.");
}

$nombre = trim($_POST['name']);
$servicio_nombre = trim($_POST['service']);
$telefono = trim($_POST['phone']);
$fecha = trim($_POST['date']);

if (empty($nombre) || empty($servicio_nombre) || empty($telefono) || empty($fecha)) {
    die("Error: Todos los campos son obligatorios.");
}

// Obtener el ID del servicio según el nombre
$sqlServicio = "SELECT id_servicio FROM servicios WHERE nombre = ?";
$stmtServicio = $conexion->prepare($sqlServicio);
$stmtServicio->bind_param("s", $servicio_nombre);
$stmtServicio->execute();
$resultServicio = $stmtServicio->get_result();

if ($resultServicio->num_rows === 0) {
    die("Error: El servicio seleccionado no es válido.");
}

$row = $resultServicio->fetch_assoc();
$id_servicio = $row['id_servicio'];

$stmtServicio->close();

// Insertar la cita en la base de datos
$sql = "INSERT INTO citas (usuario_id, nombre, id_servicio, telefono, fecha) 
        VALUES (?, ?, ?, ?, ?)";

if ($stmt = $conexion->prepare($sql)) {
    $stmt->bind_param("isiss", $usuario_id, $nombre, $id_servicio, $telefono, $fecha);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('Cita agendada con éxito.');
                window.location.href='index.php'; // Redirige al inicio
              </script>";
    } else {
        echo "Error al agendar cita: " . $stmt->error;
    }

    $stmt->close();
} else {
    die("Error en la preparación de la consulta: " . $conexion->error);
}

$conexion->close();
?>
