<?php
include("conexion.php");

// Verificar si la conexión está establecida
if (!$conexion) {
    die("Error: No se pudo conectar a la base de datos.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm-password'])) {
        echo "<script>alert('Por favor, completa todos los campos requeridos.'); window.location.href='register.php';</script>";
        exit();
    }

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);

    // Verificar si las contraseñas coinciden
    if ($password !== $confirm_password) {
        echo "<script>alert('Las contraseñas no coinciden'); window.location.href='register.php';</script>";
        exit();
    }

    // Verificar si el correo ya está registrado
    $query_check = "SELECT id FROM usuarios WHERE email = ?";
    $stmt_check = mysqli_prepare($conexion, $query_check);
    mysqli_stmt_bind_param($stmt_check, "s", $email);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        echo "<script>alert('Este correo ya está registrado.'); window.location.href='register.php';</script>";
        exit();
    }
    mysqli_stmt_close($stmt_check);

    // Insertar en la base de datos SIN encriptación
    $query = "INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Registro exitoso'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error en el registro: " . mysqli_stmt_error($stmt) . "'); window.location.href='register.php';</script>";
    }

    mysqli_stmt_close($stmt);
}
?>
