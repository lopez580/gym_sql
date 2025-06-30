<?php
require 'db.php';

if (!isset($_GET['id']) || !isset($_GET['id_entrenamiento'])) {
    die("Parámetros no especificados.");
}

$id_detalle = $_GET['id'];
$id_entrenamiento = $_GET['id_entrenamiento'];

// Obtener detalle actual
$sql = "SELECT * FROM detalle_entrenamiento WHERE id_detalle = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_detalle);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Detalle no encontrado.");
}

$detalle = $result->fetch_assoc();

// Obtener ejercicios para select
$ejercicios = $conn->query("SELECT * FROM ejercicios ORDER BY nombre ASC");

$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar detalle de ejercicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f8;
            margin: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }
        form label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #555;
        }
        form select,
        form input[type="number"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        form select:focus,
        form input[type="number"]:focus {
            border-color: #3498db;
            outline: none;
        }
        form input[type="submit"] {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 0;
            width: 100%;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form input[type="submit"]:hover {
            background-color: #2980b9;
        }
        .btn-back {
            display: inline-block;
            margin-top: 15px;
            color: white;
            background-color: #7f8c8d;
            padding: 10px 18px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-back:hover {
            background-color: #616f71;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar detalle de ejercicio</h2>

        <form action="actualizar_detalle.php" method="POST">
            <input type="hidden" name="id_detalle" value="<?= $detalle['id_detalle'] ?>">
            <input type="hidden" name="id_entrenamiento" value="<?= $id_entrenamiento ?>">

            <label for="id_ejercicio">Ejercicio:</label>
            <select name="id_ejercicio" id="id_ejercicio" required>
                <option value="">-- Selecciona un ejercicio --</option>
                <?php while ($fila = $ejercicios->fetch_assoc()): ?>
                    <option value="<?= $fila['id_ejercicio'] ?>" <?= $fila['id_ejercicio'] == $detalle['id_ejercicio'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($fila['nombre']) ?> (<?= htmlspecialchars($fila['grupo_muscular']) ?>)
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="series">Series:</label>
            <input type="number" name="series" id="series" min="1" value="<?= $detalle['series'] ?>" required>

            <label for="repeticiones">Repeticiones:</label>
            <input type="number" name="repeticiones" id="repeticiones" min="1" value="<?= $detalle['repeticiones'] ?>" required>

            <label for="peso">Peso (kg):</label>
            <input type="number" step="0.01" name="peso" id="peso" min="0" value="<?= $detalle['peso_usado'] ?>" required>

            <input type="submit" value="Guardar cambios">
        </form>

        <a href="listar_detalle.php?id_entrenamiento=<?= $id_entrenamiento ?>" class="btn-back">⬅️ Volver al detalle de la sesión</a>
    </div>
</body>
</html>
