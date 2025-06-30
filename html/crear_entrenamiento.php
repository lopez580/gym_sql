<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Nueva sesión de entrenamiento</title>
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
        form input[type="date"],
        form textarea {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            resize: vertical;
            transition: border-color 0.3s ease;
        }
        form input[type="date"]:focus,
        form textarea:focus {
            border-color: #3498db;
            outline: none;
        }
        .btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 0;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 48%;
            margin-right: 4%;
        }
        .btn:last-child {
            margin-right: 0;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registrar nueva sesión</h2>
        <form action="insertar_entrenamiento.php" method="POST">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" required>

            <label for="observaciones">Observaciones:</label>
            <textarea name="observaciones" id="observaciones" rows="4"></textarea>

            <div class="btn-container">
                <button type="submit" name="action" value="guardar_volver" class="btn">Guardar y volver a sesiones</button>
                <button type="submit" name="action" value="guardar_nuevo" class="btn">Guardar y añadir otra</button>
            </div>
        </form>
    </div>
</body>
</html>
