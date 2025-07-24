<?php
$host = "localhost";
$user = "root"; 
$password = ""; 
$database = "formulario";


$conexion = mysqli_connect($host, $user, $password, $database);

// Verificar conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Establecer el conjunto de caracteres a UTF-8
mysqli_set_charset($conexion, "utf8");

?>
