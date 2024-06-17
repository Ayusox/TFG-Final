<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    header("Location: debes_registrarte.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="header.css">
    <title>Ver Carrito</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }
        .carrito-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .carrito-item-details {
            flex-grow: 1;
        }
        .carrito-item p {
            margin: 0;
        }
        .total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }
        button {
            background-color: #ff5733;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #e74c3c;
        }
        a {
            color: #ff5733;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        a:hover {
            text-decoration: underline;
            color: #e74c3c;
        }
        .empty-cart {
            text-align: center;
            padding: 20px;
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
    <br><br>

    <div class="container">
        <h2>Carrito de la compra</h2>
        <?php
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            $total = 0;
            foreach ($_SESSION['carrito'] as $key => $item) {
                echo "<div class='carrito-item'>";
                echo "<div class='carrito-item-details'>";
                echo "<p><strong>" . htmlspecialchars($item['nombre']) . "</strong></p>";
                echo "<p>Cantidad: " . htmlspecialchars($item['cantidad']) . "</p>";
                echo "<p>Precio Unitario: $" . htmlspecialchars($item['precio']) . "</p>";
                echo "<p>Total: $" . htmlspecialchars($item['total']) . "</p>";
                echo "</div>";
                // Agregar botón para eliminar el producto
                echo "<form method='post'>";
                echo "<input type='hidden' name='key' value='$key'>";
                echo "<button type='submit' name='action' value='delete'>Eliminar</button>";
                echo "</form>";
                echo "</div>";
                $total += $item['total'];
            }
            echo "<div class='total'>";
            echo "<p>Total del carrito:</p>";
           
            echo "<p>$" . htmlspecialchars($total) . "</p>";
            echo "</div>";
            echo "<br>";
            echo "<a href='checkout.php'><button>Comprar</button></a>";
        } else {
            echo "<div class='empty-cart'>";
            echo "<p>El carrito está vacío.</p>";
            echo "</div>";
        }
        ?>
        <button onclick="location.href='index.html'">Volver a la página principal</button>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete') {
        if (isset($_POST['key']) && isset($_SESSION['carrito'][$_POST['key']])) {
            unset($_SESSION['carrito'][$_POST['key']]);
            // Actualizar la página para reflejar los cambios
            echo "<script>window.location.reload();</script>";
        }
    }
    ?>
</body>
</html>






