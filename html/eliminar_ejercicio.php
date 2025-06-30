<?php
require 'db.php';

if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$id = $_GET['id'];

$sql = "DELETE FROM ejercicios WHERE id_ejercicio = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: listar_ejercicios.php");
    exit;
} else {
    echo "Error al eliminar: " . $stmt->error;
}

$stmt->close();
$conn->close();
