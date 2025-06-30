<?php
require 'db.php';

if (!isset($_GET['id_entrenamiento'])) {
    die("ID de entrenamiento no especificado.");
}

$id_entrenamiento = $_GET['id_entrenamiento'];

// Obtener info de la sesión
$res_sesion = $conn->query("SELECT * FROM entrenamientos WHERE id_entrenamiento = $id_entrenamiento");
if ($res_sesion->num_rows === 0) {
    die("Sesión no encontrada.");
}
$sesion = $res_sesion->fetch_assoc();

// Obtener detalles con info de ejercicios
$sql = "SELECT d.id_detalle, e.nombre, e.grupo_muscular, d.series, d.repeticiones, d.peso_usado
        FROM detalle_entrenamiento d
        JOIN ejercicios e ON d.id_ejercicio = e.id_ejercicio
        WHERE d.id_entrenamiento = $id_entrenamiento";

$resultado = $conn->query($sql);

if (!$resultado) {
    die("Error en la consulta SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalle de la sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f8;
            margin: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        p.observaciones {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
            white-space: pre-wrap;
        }
        .btn {
            display: inline-block;
            padding: 10px 18px;
            margin: 5px 5px 20px 0;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            transition: background-color 0.3s ease;
            color: white;
        }
        .btn-primary {
            background-color: #3498db;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
        .btn-back {
            background-color: #7f8c8d;
        }
        .btn-back:hover {
            background-color: #616f71;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:hover {
            background-color: #f1f9ff;
        }
        .action-links a {
            margin: 0 5px;
            text-decoration: none;
            color: #fff;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .edit-link {
            background-color: #f39c12;
        }
        .edit-link:hover {
            background-color: #d35400;
        }
        .delete-link {
            background-color: #e74c3c;
        }
        .delete-link:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ejercicios de la sesión del <?= htmlspecialchars($sesion['fecha']) ?></h2>
        <p class="observaciones">Observaciones: <?= nl2br(htmlspecialchars($sesion['observaciones'])) ?></p>

        <a href="crear_detalle.php?id_entrenamiento=<?= $id_entrenamiento ?>" class="btn btn-primary">➕ Agregar ejercicio</a>
        <a href="listar_entrenamientos.php" class="btn btn-back">⬅️ Volver a sesiones</a>

        <table>
            <thead>
                <tr>
                    <th>ID Detalle</th>
                    <th>Ejercicio</th>
                    <th>Grupo Muscular</th>
                    <th>Series</th>
                    <th>Repeticiones</th>
                    <th>Peso (kg)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado->num_rows > 0): ?>
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= $fila['id_detalle'] ?></td>
                            <td><?= htmlspecialchars($fila['nombre']) ?></td>
                            <td><?= htmlspecialchars($fila['grupo_muscular']) ?></td>
                            <td><?= $fila['series'] ?></td>
                            <td><?= $fila['repeticiones'] ?></td>
                            <td><?= $fila['peso_usado'] ?></td>
                            <td class="action-links">
                                <a href="editar_detalle.php?id=<?= $fila['id_detalle'] ?>&id_entrenamiento=<?= $id_entrenamiento ?>" class="edit-link">✏️ Editar</a>
                                <a href="eliminar_detalle.php?id=<?= $fila['id_detalle'] ?>&id_entrenamiento=<?= $id_entrenamiento ?>" class="delete-link" onclick="return confirm('¿Eliminar este ejercicio de la sesión?')">🗑️ Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="padding: 20px; color: #777;">No hay ejercicios agregados aún.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
