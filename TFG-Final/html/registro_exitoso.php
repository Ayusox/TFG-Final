<?php
session_start();

// Asegurarse de que el usuario haya iniciado sesión
if (!isset($_SESSION["email"])) {
    header("Location: index.html?mensaje=" . urlencode("Debes registrarte primero."));
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #ff5733;
            border-color: #ff5733;
        }
        .btn-primary:hover {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }
        .img-small {
            max-width: 100px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>


    <div class="container">
        <img src="https://cdn.icon-icons.com/icons2/3390/PNG/512/small_tick_icon_213338.png" alt="Éxito" class="img-small">
        <h2>¡Registro Exitoso!</h2>
        <p>Se ha registrado correctamente en AutoExpress</p>
        <p>¡Bienvenido!</p>
        <a href="index.html" class="btn btn-primary">Volver al inicio</a>
    </div>
</body>
</html>




