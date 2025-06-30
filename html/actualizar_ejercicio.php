<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $grupo_muscular = $_POST['grupo_muscular'];

    $sql = "UPDATE ejercicios SET nombre = ?, grupo_muscular = ? WHERE id_ejercicio = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $grupo_muscular, $id);

    if ($stmt->execute()) {
        header("Location: listar_ejercicios.php");
        exit;
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no válido.";
}
