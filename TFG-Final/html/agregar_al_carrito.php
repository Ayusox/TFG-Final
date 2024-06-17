<?php
session_start();



// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    header("Location: debes_registrarte.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $producto = [
        'id_producto' => $id_producto,
        'nombre' => $nombre,
        'precio' => $precio,
        'cantidad' => $cantidad,
        'total' => $precio * $cantidad
    ];

    // Inicializar el carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Añadir el producto al carrito
    $_SESSION['carrito'][$id_producto] = $producto;

    // Redirigir de vuelta a la página de productos con un mensaje de éxito
    $_SESSION['mensaje'] = "Producto añadido al carrito: $nombre (Cantidad: $cantidad, Total: $" . $producto['total'] . ")";
    header("Location: paginaproductos.php");
    exit();
}
?>


