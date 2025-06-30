<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fecha = $_POST['fecha'];
    $observaciones = $_POST['observaciones'];
    $action = $_POST['action'] ?? '';

    $sql = "INSERT INTO entrenamientos (fecha, observaciones) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $fecha, $observaciones);

    if ($stmt->execute()) {
        // Redirigir según botón
        if ($action === 'guardar_volver') {
            header("Location: listar_entrenamientos.php");
            exit;
        } elseif ($action === 'guardar_nuevo') {
            header("Location: crear_entrenamiento.php");
            exit;
        } else {
            // Por defecto, lista
            header("Location: listar_entrenamientos.php");
            exit;
        }
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no válido.";
}
?>
