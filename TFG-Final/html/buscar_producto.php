<?php
session_start();

// Conexión a la base de datos
$servername = "mysql"; 
$username = "user_name";
$password = "user_password";
$database = "tiendadb";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el nombre del producto enviado desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_producto = $_POST["nombre_producto"];

    // Consulta para buscar productos que coincidan con el nombre
    $sql = "SELECT * FROM productos WHERE nombre LIKE '%$nombre_producto%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si se encuentran productos, pasar sus detalles a la página de productos
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }

        // Almacenar productos en la sesión
        $_SESSION['productos'] = $productos;

        // Redirigir a la página de productos
        header("Location: paginaproductos.php");
        exit();
    }
    // No hay resultados: la salida HTML se maneja más adelante
}

// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos Nuestros Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="header.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: linear-gradient(135deg, #f4f4f4 25%, #ffffff 100%);
            padding: 20px;
        }

        .message-box {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            max-width: 600px;
            margin: 20px;
            transition: transform 0.3s ease;
        }

        .message-box:hover {
            transform: scale(1.05);
        }

        .message-box h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
            position: relative;
        }

        .message-box h1:after {
            content: '';
            width: 50px;
            height: 4px;
            background-color: #ff5733;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -10px;
            border-radius: 2px;
        }

        .message-box p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #666;
        }

        .message-box a {
            text-decoration: none;
            color: #ff5733;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .message-box a:hover {
            color: #cc4626;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
        }

        header .logo-container .logo {
            color: #fff;
        }

        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        header nav ul li {
            margin: 0 15px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        header nav ul li a:hover {
            color: #ff5733;
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
    <div class="message-box">
    <img src="https://cdn.icon-icons.com/icons2/2367/PNG/512/circle_x_close_icon_143475.png" alt="Fail" class="img-small">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $result->num_rows == 0) {
            echo "<h1>Producto no encontrado</h1>";
            echo "<p>Lo sentimos, no pudimos encontrar ningún producto que coincida con tu búsqueda.</p>";
            echo "<p><a href='productosprincipales.php'>Ver todos los productos</a></p>";
        }
        ?>
    </div>
</div>

</body>
</html>




