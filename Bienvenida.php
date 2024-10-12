<?php

    session_start();

    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
                alert("Inicia sesion");
                window.location = "index.php";
            </script>
        ';
        session_destroy();
        die;
    }





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Dalliat</title>
    <a href="php/cerrar_sesion.php">Cerrar sesion</a>
</head>
<body>
    <h1>Dalliat</h1>
</body>
</html>