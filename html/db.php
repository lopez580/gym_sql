<?php
$host = "mysql";          // Nombre del servicio MySQL en docker-compose
$user = "user";           // Usuario que definiste en .env
$pass = "user123";        // Contraseña
$db   = "gimnasio";       // Nombre de la base de datos

$conn = new mysqli($host, $user, $pass, $db);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Opcional: mostrar mensaje de conexión exitosa
// echo "Conexión exitosa";
?>
