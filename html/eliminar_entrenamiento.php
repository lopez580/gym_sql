<?php
require 'db.php';

if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$id = $_GET['id'];

$sql = "DELETE FROM entrenamientos WHERE id_entrenamiento = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: listar_entrenamientos.php");
    exit;
} else {
    echo "Error al eliminar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
