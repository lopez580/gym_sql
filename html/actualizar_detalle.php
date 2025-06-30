<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_detalle = $_POST['id_detalle'];
    $id_entrenamiento = $_POST['id_entrenamiento'];
    $id_ejercicio = $_POST['id_ejercicio'];
    $series = $_POST['series'];
    $repeticiones = $_POST['repeticiones'];
    $peso = $_POST['peso'];

    $sql = "UPDATE detalle_entrenamiento 
            SET id_ejercicio=?, series=?, repeticiones=?, peso_usado=? 
            WHERE id_detalle=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("iiidi", $id_ejercicio, $series, $repeticiones, $peso, $id_detalle);


    if ($stmt->execute()) {
        header("Location: listar_detalle.php?id_entrenamiento=$id_entrenamiento");
        exit;
    } else {
        echo "Error al actualizar detalle: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no válido.";
}
