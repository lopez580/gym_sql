<?php
require 'db.php';

if (!isset($_GET['id']) || !isset($_GET['id_entrenamiento'])) {
    die("Parámetros no especificados.");
}

$id_detalle = $_GET['id'];
$id_entrenamiento = $_GET['id_entrenamiento'];

$sql = "DELETE FROM detalle_entrenamiento WHERE id_detalle = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_detalle);

if ($stmt->execute()) {
    header("Location: listar_detalle.php?id_entrenamiento=$id_entrenamiento");
    exit;
} else {
    echo "Error al eliminar detalle: " . $stmt->error;
}

$stmt->close();
$conn->close();
