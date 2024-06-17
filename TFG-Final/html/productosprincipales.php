<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos Nuestros Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="header.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .product-item {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        .product-item img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .product-item h5 {
            font-size: 1.1em;
            margin-bottom: 10px;
            min-height: 3em; /* Ajusta según el tamaño del texto */
        }
        .product-item p {
            margin: 0;
            min-height: 2em; /* Ajusta según el tamaño del texto */
        }
        .product-item .price {
            font-weight: bold;
            margin: 10px 0;
        }
        .btn-add {
            background-color: #ff5733;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-top: auto; /* Empuja el botón hacia abajo */
        }
        .btn-add:hover {
            background-color: #e74c3c;
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
        <h2>Todos Nuestros Productos</h2>
        <div class="product-grid">
            <?php
            // Conexión a la base de datos
            $servername = "mysql";
            $username = "user_name";
            $password = "user_password";
            $database = "tiendadb";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Obtener los productos de la base de datos
            $sql = "SELECT * FROM productos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='product-item'>";
                    echo "<img src='" . htmlspecialchars($row['imagen_url']) . "' alt='" . htmlspecialchars($row['nombre']) . "'>";
                    echo "<h5>" . htmlspecialchars($row['nombre']) . "</h5>";
                    echo "<p>" . htmlspecialchars($row['descripcion']) . "</p>";
                    echo "<p class='price'>" . htmlspecialchars($row['precio']) . "€</p>";
                    echo "<a href='paginaproductos.php' class='btn-add'>Añadir</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No se encontraron productos.</p>";
            }

            $conn->close();
            ?>
            
        </div>
    </div>
</body>
</html>
