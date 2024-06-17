<?php
session_start();

$servername = "mysql"; 
$username = "user_name";
$password = "user_password";
$database = "tiendadb";


if (isset($_SESSION["email"])) {
    header("Location: login_exitoso.php");
    exit();
}

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? null;
    $email = $_POST["email"] ?? null;
    $password = $_POST["password"] ?? null;
    $action = $_POST["action"] ?? null;

    if (empty($username) || empty($email) || empty($password)) {
        $error_message = "Por favor, complete todos los campos.";
    } else {
        if ($action == "Registrarse") {
            $sql = "SELECT * FROM usuarios WHERE email = ? OR username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $error_message = "Este correo electrónico o nombre de usuario ya está registrado.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql_insert = "INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param("sss", $username, $email, $hashed_password);

                if ($stmt_insert->execute()) {
                    header("Location: registro_exitoso.php");
                    exit();
                } else {
                    $error_message = "Error al registrar el usuario.";
                }
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="header.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="submit"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"],
        button {
            background-color: #ff5733;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover,
        button:hover {
            background-color: #e74c3c;
        }
        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
        <div class="header-container">
            <div class="logo-container">
                <h1 class="logo">Auto<span class="logo-accent">Express</span></h1>
            </div>
            <!-- <div class="search-container">
                <form action="buscar_producto.php" method="POST">
                    <input type="text" name="nombre_producto" placeholder="Buscar productos...">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>     -->
            
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
        <h2>Registro de Usuario</h2>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        <form action="" method="post">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" placeholder="Ingrese su nombre de usuario" required>
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>
            <input type="submit" name="action" value="Registrarse">
        </form>
        
        <br>
        <a href="index.html" class="mt-3 d-block text-center">Volver a la página principal</a>
        </br>
    </div>
</body>
</html>
