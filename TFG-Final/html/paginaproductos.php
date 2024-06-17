<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Productos</title>

    
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2, h3 {
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }
        .producto {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .producto img {
            margin-left: 20px;
            max-width: 150px;
            border-radius: 8px;
        }
        .producto p {
            margin: 5px 0;
        }
        .producto form {
            margin-left: auto;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        .producto form label, .producto form input, .producto form button {
            margin-top: 5px;
        }
        .notificacion {
            color: green;
            margin-bottom: 20px;
        }
        .carrito {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
        }
        .carrito-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .carrito-item p {
            margin: 0;
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
    </style>
</head>
<body>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Header - AutoExpress</title>
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
</body>
</html>



    <div class="container">
        <h2>Página de Productos</h2>
        <br>
        <?php
        if (isset($_SESSION['mensaje'])) {
            echo "<div class='notificacion'>" . htmlspecialchars($_SESSION['mensaje']) . "</div>";
            unset($_SESSION['mensaje']);
        }
        if (isset($_SESSION['productos'])) {
            $productos = $_SESSION['productos'];

            if (!empty($productos)) {
                echo "<h3>Resultados de la búsqueda:</h3>";
                foreach ($productos as $producto) {
                    echo "<div class='producto'>";
                    echo "<div>";
                    echo "<p><strong>Nombre:</strong> " . htmlspecialchars($producto['nombre']) . "</p>";
                    echo "<p><strong>Precio:</strong> $" . htmlspecialchars($producto['precio']) . "</p>";
                    echo "<p><strong>Descripción:</strong> " . htmlspecialchars($producto['descripcion']) . "</p>";
                    echo "<p><strong>Stock:</strong> " . htmlspecialchars($producto['stock']) . "</p>";
                    echo "</div>";
                    if (!empty($producto['imagen_url'])) {
                        echo "<img src='" . htmlspecialchars($producto['imagen_url']) . "' alt='" . htmlspecialchars($producto['nombre']) . "'>";
                    }
                    echo "<form action='agregar_al_carrito.php' method='post'>";
                    echo "<input type='hidden' name='id_producto' value='" . htmlspecialchars($producto['id_producto']) . "'>";
                    echo "<input type='hidden' name='nombre' value='" . htmlspecialchars($producto['nombre']) . "'>";
                    echo "<input type='hidden' name='precio' value='" . htmlspecialchars($producto['precio']) . "'>";
                    echo "<label for='cantidad'>Cantidad:</label>";
                    echo "<input type='number' name='cantidad' id='cantidad' min='1' max='" . htmlspecialchars($producto['stock']) . "' value='1' required>";
                    echo "<button type='submit'>Comprar</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>No se encontraron productos.</p>";
            }
        } else {
            echo "<p>No se ha encontrado ningún producto.</p>";
        }
        ?>

        <div class="carrito">
            <h3>Carrito de la compra</h3>
            <br>
            <?php
            if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                $total = 0;
                foreach ($_SESSION['carrito'] as $key => $item) {
                    echo "<div class='carrito-item'>";
                    echo "<div>";
                    echo "<p>" . htmlspecialchars($item['nombre']) . " (Cantidad: " . htmlspecialchars($item['cantidad']) . ")</p>";
                    // Alineación del precio debajo del nombre del producto
                    echo "<div class='precio'>$" . htmlspecialchars($item['total']) . "</div>";
                    echo "</div>";
                    // Formulario para eliminar el producto
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='key' value='$key'>";
                    echo "<button type='submit' name='action' value='delete'>Eliminar</button>";
                    echo "</form>";
                    echo "</div>";
                    $total += $item['total'];
                }
                echo "<br>";
                echo "<hr>";
                echo "<br>";
                echo "<p><strong>Total del carrito: $" . htmlspecialchars($total) . "</strong></p>";
                echo "<br>";
                echo "<a href='ver_carrito.php'>Ver carrito</a>";
            } else {
                echo "<p>El carrito está vacío.</p>";
            }
            ?>
        </div>
        <br>
        

        <button onclick="location.href='index.html'">Volver a la página principal</button>
        
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete') {
        if (isset($_POST['key']) && isset($_SESSION['carrito'][$_POST['key']])) {
            unset($_SESSION['carrito'][$_POST['key']]);
            // Recargar la página para reflejar los cambios
            echo "<script>window.location.reload();</script>";
        }
    }
    ?>
    <br>

    
</body>
</html>










