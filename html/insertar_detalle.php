<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_entrenamiento = $_POST['id_entrenamiento'];
    $id_ejercicio = $_POST['id_ejercicio'];
    $series = $_POST['series'];
    $repeticiones = $_POST['repeticiones'];
    $peso = $_POST['peso'];

    $sql = "INSERT INTO detalle_entrenamiento (id_entrenamiento, id_ejercicio, series, repeticiones, peso_usado) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("iiiid", $id_entrenamiento, $id_ejercicio, $series, $repeticiones, $peso);

    if ($stmt->execute()) {
        header("Location: listar_detalle.php?id_entrenamiento=$id_entrenamiento");
        exit;
    } else {
        echo "Error al agregar detalle: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no válido.";
}
