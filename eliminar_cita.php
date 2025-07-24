<?php
session_start();
include("conexion.php");

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $cita_id = $_GET['id'];

    $query = "DELETE FROM citas WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $cita_id);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Cita eliminada correctamente.'); window.location.href='mis_citas.php';</script>";
    exit();
} else {
    header("Location: mis_citas.php");
    exit();
}
?>
