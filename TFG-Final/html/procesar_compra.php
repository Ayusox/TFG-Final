<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_cliente = $_POST["nombre_cliente"];
    $direccion_envio = $_POST["direccion_envio"];
    $correo_cliente = $_POST["correo_cliente"];
    $telefono_cliente = $_POST["telefono_cliente"];
    $metodo_pago = $_POST["metodo_pago"];
    $cantidad_productos = $_POST["cantidad_productos"];

    // Validación de datos
    if (!filter_var($correo_cliente, FILTER_VALIDATE_EMAIL)) {
        echo "Correo electrónico inválido.";
        exit();
    }

    // Insertar el pedido en la base de datos
    $sql = "INSERT INTO pedidos (nombre_cliente, direccion_envio, correo_cliente, telefono_cliente, metodo_pago, cantidad_productos)
            VALUES ('$nombre_cliente', '$direccion_envio', '$correo_cliente', '$telefono_cliente', '$metodo_pago', '$cantidad_productos')";

    if ($conn->query($sql) === TRUE) {
        echo "Su compra se ha realizado con éxito.";
    } else {
        echo "Error al registrar el pedido: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
