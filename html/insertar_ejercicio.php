<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $grupo_muscular = $_POST['grupo_muscular'];

    $sql = "INSERT INTO ejercicios (nombre, grupo_muscular) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nombre, $grupo_muscular);

    if ($stmt->execute()) {
        header("Location: listar_ejercicios.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no válido.";
}
