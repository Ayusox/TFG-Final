<?php

session_start();

$email = $_SESSION["email"];
$confirmed = isset($_POST['confirm']) ? $_POST['confirm'] : '';
$message = '';
$message_type = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($confirmed === "yes") {
        // Conexión a la base de datos
        $servername = "mysql"; 
        $username = "user_name";
        $password_db = "user_password";
        $database = "tiendadb";

        $conn = new mysqli($servername, $username, $password_db, $database);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Verificar las credenciales del usuario
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
                // Eliminar la cuenta de usuario
                $sql_delete = "DELETE FROM usuarios WHERE email = ?";
                $stmt_delete = $conn->prepare($sql_delete);
                $stmt_delete->bind_param("s", $email);
                $stmt_delete->execute();

                $message = "Cuenta eliminada correctamente.";
                $message_type = "success";
                
                $conn->close();

                header("Location: logout.php");
                exit; // Ensure that subsequent code is not executed after redirection
            
        } else {
            $message = "No se pudo borrar la cuenta. Contacte con Mario.";
            $message_type = "error";
        }

        $conn->close();

    } elseif ($confirmed === "no") {
        header("Location: login_exitoso.php");
    } else {
        $message = "Esta accion no se puede deshacer!";
        $message_type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Eliminación</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
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
            margin-bottom: 30px;
        }
        .btn-danger {
            background-color: #ff5733;
            border-color: #ff5733;
        }
        .btn-danger:hover {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .message {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>¿Estás seguro de que deseas borrar esta cuenta de usuario permanentemente?</h2>
        <?php if ($message): ?>
        <div class="message <?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <input type="hidden" name="password" value="<?php echo htmlspecialchars($password); ?>">
            <button type="submit" name="confirm" value="yes" class="btn btn-danger">Sí</button>
            <button type="submit" name="confirm" value="no" class="btn btn-secondary">No</button>
        </form>
        <br>
        <a href="index.html" class="mt-3 d-block text-center">Volver a la página principal</a>
        </br>
    </div>
</body>
</html>

