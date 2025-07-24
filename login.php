<?php
session_start();
include("conexion.php");

if (!$conexion) {
    echo "<script>alert('Error: No se pudo conectar a la base de datos.');</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // **IMPORTANTE: Cambia "usuarios" por la tabla correcta si es necesario**
    $query = "SELECT id, nombre, contraseña FROM usuarios WHERE email = ?";
    $stmt = mysqli_prepare($conexion, $query);

    if (!$stmt) {
        echo "<script>alert('Error en la consulta: " . mysqli_error($conexion) . "');</script>";
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($resultado);

    // Verifica si el usuario existe y si la contraseña coincide (SIN ENCRIPTAR)
    if ($usuario && isset($usuario['contraseña']) && $password === $usuario['contraseña']) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        header("Location: mis_citas.php");
        exit();
    } else {
        echo "<script>alert('Correo o contraseña incorrectos'); window.location.href='login.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css"> 
</head>
<body>
    <header>
        <div class="top-banner">Accede a tu cuenta o regístrate</div>
        <nav class="main-nav">
            <div class="logo">Tienda de Maquillaje</div>
            <ul>
                <li><a href="/belleza/index.php">Inicio</a></li>
                <li><a href="/belleza/agendar.php">Agendar Cita</a></li>
                <li><a href="#">Iniciar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <section class="login-section">
        <div class="login-container">
            <h1>Iniciar Sesión</h1>
            <form class="login-form" method="POST">
                <div class="input-group">
                    <label for="email"><i class="fas fa-envelope"></i> Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password"><i class="fas fa-lock"></i> Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="options">
                    <label><input type="checkbox"> Recuérdame</label>
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>
                <button type="submit" class="btn">Iniciar Sesión</button>
                <p class="register-link">¿No tienes cuenta? <a href="/belleza/register.php">Regístrate aquí</a></p>
            </form>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Tienda de Maquillaje. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
