<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    header("Location: index.html?mensaje=" . urlencode("Debes iniciar sesión para realizar una compra."));
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_cliente = $_POST['nombre_cliente'];
    $apellidos_cliente = $_POST['apellidos_cliente'];
    $direccion_envio = $_POST['direccion_envio'];
    $poblacion_client = $_POST['poblacion_client'];
    $provincia_cliente = $_POST['provincia_cliente'];
    $codigo_postal_cliente = $_POST['codigo_postal_cliente'];
    $metodo_pago = $_POST['metodo_pago'];

    if ($metodo_pago == "Tarjeta de crédito") {
        $met_pago_id = 1;
    } elseif ($metodo_pago == "Tarjeta de débito") {
        $met_pago_id = 2;
    } elseif ($metodo_pago == "PayPal") {
        $met_pago_id = 3;
    };

    $usuario_id = $_SESSION["usuario_id"];

    $cantidad_productos = count($_SESSION['carrito']); // Supongamos que el carrito es un array de productos

    // Validar que todos los campos estén llenos
    if (empty($nombre_cliente) || empty($apellidos_cliente) || empty($direccion_envio) || empty($poblacion_client) || empty($provincia_cliente) || empty($codigo_postal_cliente) || empty($metodo_pago) || $cantidad_productos == 0) {
        $mensaje_error = "Por favor, complete todos los campos y agregue productos al carrito.";
    } else {
        // Conectar a la base de datos
        $servername = "mysql";
        $username = "user_name";
        $password = "user_password";
        $database = "tiendadb";
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Inserting address
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO direcciones (usuario_id, nombre, apellidos, direccion, poblacion, provincia, codigo_postal) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // echo "$usuario_id, $nombre_cliente, $apellidos_cliente, $direccion_envio, $poblacion_client, $provincia_cliente, $codigo_postal_cliente";

        $stmt->bind_param("isssssi", $usuario_id, $nombre_cliente, $apellidos_cliente, $direccion_envio, $poblacion_client, $provincia_cliente, $codigo_postal_cliente);

        // Execute the statement
        if ($stmt->execute()) {
            // Get the transaction_id of the newly inserted row
            $direccion_id = $stmt->insert_id;
            // echo "New record created successfully. Direction ID is: " . $direccion_id;
        } else {
            // echo "Error: " . $stmt->error;
        }
        
        // Sample data to be inserted
        // $usuario_id = 1;
        // $direccion_id = 1;
        // $met_pago_id = 1;

        // Create transaction
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO transacciones (usuario_id, direccion_id, met_pago_id) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $usuario_id, $direccion_id, $met_pago_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Get the transaction_id of the newly inserted row
            $transaction_id = $stmt->insert_id;
            // echo "New record created successfully. Transaction ID is: " . $transaction_id;
        } else {
            // echo "Error: " . $stmt->error;
        }


        // Looping through the items
        foreach ($_SESSION['carrito'] as $key => $item) {
            
            $product_id = $key;
            $quantity = $item['cantidad'];
            $precio = $item['precio'];
            // Create entry
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO pedidos (transaction_id, id_producto, precio, cantidad) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iidi", $transaction_id, $product_id, $precio, $quantity);

            // Execute the statement
            if ($stmt->execute()) {
                // Get the transaction_id of the newly inserted row
                $entry_id = $stmt->insert_id;
                // echo "New record created successfully. Entry ID is: " . $entry_id;
            } else {
                // echo "Error: " . $stmt->error;
            }
        }
        $_SESSION['carrito'] = []; // Vaciar el carrito después de la compra
        // Cerrar la conexión
        header("Location: exito.php");
        $conn->close();
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
            margin-top: 0;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #ff5733;
            border-color: #ff5733;
        }
        .btn-primary:hover {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Información de Compra</h2>
                <?php
                if (isset($mensaje_error)) {
                    echo "<p class='error-message'>" . htmlspecialchars($mensaje_error) . "</p>";
                }
                ?>
                <form action="checkout.php" method="post">
                    <div class="form-group">
                        <label for="nombre_cliente">Nombre:</label>
                        <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required>
                    </div>
                    <div class="form-group">
                        <label for="apellidos_cliente">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos_cliente" name="apellidos_cliente" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion_envio">Dirección de Envío:</label>
                        <input type="text" class="form-control" id="direccion_envio" name="direccion_envio" required>
                    </div>
                    <div class="form-group">
                        <label for="poblacion_client">Población:</label>
                        <input type="text" class="form-control" id="poblacion_client" name="poblacion_client" required>
                    </div>
                    <div class="form-group">
                        <label for="provincia_cliente">Provincia:</label>
                        <input type="text" class="form-control" id="provincia_cliente" name="provincia_cliente" required>
                    </div>
                    <div class="form-group">
                        <label for="codigo_postal_cliente">Codigo postal:</label>
                        <input type="text" class="form-control" id="codigo_postal_cliente" name="codigo_postal_cliente" required>
                    </div>
                    <div class="form-group">
                        <label for="metodo_pago">Método de Pago:</label>
                        <select class="form-control" id="metodo_pago" name="metodo_pago" required>
                            <option value="Tarjeta de crédito">Tarjeta de crédito</option>
                            <option value="Tarjeta de débito">Tarjeta de débito</option>
                            <option value="PayPal">PayPal</option>
                            <!-- <option value="Transferencia bancaria">Transferencia bancaria</option> -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Finalizar Compra</button>
                </form>
                <a href="index.html" class="mt-3 d-block text-center">Volver a la página principal</a><br>
            </div>
        </div>
    </div>
</body>
</html>





