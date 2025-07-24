<?php
$host = "localhost";
$user = "root"; // Cambia si es necesario
$password = ""; // Cambia si es necesario
$database = "formulario"; // Asegúrate de que sea el nombre correcto

// Crear conexión
$conexion = mysqli_connect($host, $user, $password, $database);

// Verificar conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Establecer el conjunto de caracteres a UTF-8
mysqli_set_charset($conexion, "utf8");

?>
