<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="register.css"> <!-- Vinculamos el CSS -->
</head>
<body>
    <header>
        <nav class="main-nav">
            <div class="logo">Tienda de Maquillaje</div>
            <ul>
                <li><a href="/belleza/index.php">Inicio</a></li>
                <li><a href="/belleza/login.php">Iniciar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <section class="container login-section">
        <div class="login-wrapper">
            <div class="login-container">
                <h1>Crear Cuenta</h1>
                <p>Completa el formulario para registrarte.</p>

                <!-- FORMULARIO MODIFICADO -->
                <form class="login-form" action="send.php" method="POST">
                    <div class="input-group">
                        <label for="name">Nombre Completo:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="input-group">
                        <label for="confirm-password">Confirmar Contraseña:</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                    <button type="submit" class="btn" name="send">Registrarse</button>
                </form>

                <p class="switch-link">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Tienda de Maquillaje. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
