<?php
session_start();

// Asumiendo que el nombre de usuario y el correo electrónico se almacenan en la sesión
if (!isset($_SESSION["email"])) {
    header("Location: index.html?mensaje=" . urlencode("Debes iniciar sesión primero."));
    exit();
}

$email = $_SESSION["email"];

// Conectar a la base de datos para obtener el nombre de usuario
$servername = "mysql"; 
$username = "user_name";
$password = "user_password";
$database = "tiendadb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT username FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Bienvenido!</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="header.css">
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

<header>
        <div class="header-container">
            <div class="logo-container">
                <h1 class="logo">Auto<span class="logo-accent">Express</span></h1>
            </div>
            <div class="search-container">
                <form action="buscar_producto.php" method="POST">
                    <input type="text" name="nombre_producto" placeholder="Buscar productos...">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>    
            
            <nav>
                <ul>
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="productosprincipales.php">Productos</a></li>
                    <li><a href="login.php" class="sesion">Iniciar sesión</a></li>
                    <li><a href="registro.php" class="sesion">Registrarse</a></li>
                    <li><a href="ver_carrito.php" class="sesion">Ver carrito</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="container">
        <h2>¡Bienvenido!</h2>
        <p>Ha iniciado sesión correctamente. ¡Bienvenido de nuevo, <strong><?php echo htmlspecialchars($user['username']); ?></strong>!</p>
        <img src="https://cdn.icon-icons.com/icons2/3390/PNG/512/small_tick_icon_213338.png" alt="Éxito" class="img-small">
        <p>Su Correo electrónico: <strong><?php echo htmlspecialchars($email); ?></strong></p>
        
        <form action="logout.php" method="post" style="margin-top: 20px;">
            <button type="submit" class="btn btn-secondary">Cerrar sesión </button>
        </form>
        
        
        <form action="confirmar_eliminacion.php" method="post" style="margin-top: 20px;">
            <button type="submit" class="btn btn-secondary">Eliminar cuenta</button>
        </form>
        </br>
        <a href="index.html" class="btn btn-secondary">Volver al inicio</a>
    </div>

    
</body>
</html>
