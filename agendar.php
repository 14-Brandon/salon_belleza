<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Servicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="servicios.css"> <!-- Vinculamos el CSS -->
</head>
<body>
    <header>
        <div class="top-banner">Reserva tu cita con nosotros fácilmente</div>
        <nav class="main-nav">
            <div class="logo">Tienda de Maquillaje</div>
            <ul>
                <li><a href="/belleza/index.php">Inicio</a></li>
                <li><a href="/belleza/agendar.php">Agendar Cita</a></li>
                <li><a href="/belleza/login.php">Iniciar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <section class="container appointment-section">
        <div class="appointment-wrapper">
            <div class="image-container">
                <img src="images/servicios.png" alt="Maquillaje profesional">
            </div>
            <div class="appointment-container">
                <h1>Agendar Servicio</h1>
                <p>Completa el siguiente formulario para reservar tu cita.</p>
                <div class="appointment-box">
                <form class="appointment-form" action="send_cita.php" method="POST">
    <div class="input-group">
        <label for="name">Correo:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="input-group">
        <label for="service">Tipo de Servicio:</label>
        <select id="service" name="service" required>
            <option value="">Selecciona un servicio</option>
            <option value="maquillaje">Maquillaje Profesional</option>
            <option value="peinado">Peinado</option>
            <option value="tratamiento">Tratamiento Facial</option>
        </select>
    </div>
    <div class="input-group">
        <label for="phone">Número Telefónico:</label>
        <input type="tel" id="phone" name="phone" required>
    </div>
    <div class="input-group">
        <label for="date">Fecha de la Cita:</label>
        <input type="date" id="date" name="date" required>
    </div>
    <button type="submit" class="btn">Agendar Cita</button>
</form>

                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Tienda de Maquillaje. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
