<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $fecha = $_POST['fecha'];
    $observaciones = $_POST['observaciones'];

    $sql = "UPDATE entrenamientos SET fecha = ?, observaciones = ? WHERE id_entrenamiento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $fecha, $observaciones, $id);

    if ($stmt->execute()) {
        header("Location: listar_entrenamientos.php");
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no válido.";
}
