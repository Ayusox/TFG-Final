<?php
session_start();

if (isset($_SESSION["email"])) {

    unset($_SESSION["email"]);
    unset($_SESSION["username"]);
    unset($_SESSION["usuario_id"]);

}

header("Location: index.html");
exit();
?>
