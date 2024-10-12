<?php
    
session_start();

    include 'conexion_be.php';

    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $clave =  hash('sha512',$clave);

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuario WHERE Correo='$correo' and Clave='$clave'");

    if(mysqli_num_rows($validar_login) > 0){
        $_SESSION['usuario'] = $correo;
        header("location:../Bienvenida.php");    
        exit;
    }
    else{
        echo '
            <script>
                alert("Usuario NO Encontrado");
                window.location ="../index.php"
            </script>
        ';
        exit;
    }
?>