<?php

    include 'conexion_be.php';

    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $clave = hash('sha512', $clave);
    $salida = fopen('C:/xampp\htdocs\Dalliat_Login\ReportesCsv.csv', 'a');

    $reporteCsv=$conexion->query("Select * FROM usuario");

    while($filaR=$reporteCsv->fetch_assoc())
    fputcsv($salida,array($filaR['NombreCompleto'],$filaR['Correo'],$filaR['Usuario'],$filaR['Clave']));

    


    $query = "INSERT INTO usuario(NombreCompleto, Correo,Usuario,Clave)
                VALUES('$nombre_completo', '$correo', '$usuario','$clave')";


    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuario WHERE correo= '$correo' ");


        //Verificar que no se repita el correo
    if(mysqli_num_rows($verificar_correo) > 0){

        echo '
            <script>
                alert("Este correo ya esta registrado");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }


    //vERIFICAR QUE EL USUARIO NO SE REPITA

    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuario WHERE Usuario= '$usuario' ");


    if(mysqli_num_rows($verificar_usuario) > 0){

        echo '
            <script>
                alert("Este usuario ya esta registrado");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }


    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        header('content-Type:text/csv; charset-latin1');
        header('Content-Disposition: attachment; filename="' . $nombre_completo . '.csv"');
        fputcsv($salida,array('nombre_completo','correo','usuario','clave'));


        echo '
            <script>
                alert("Usuario almacenado exitosamente");
                window.location = "../index.php"
            </script>'
            ;
    }
    else{
        echo '
            <script>
                alert("Intente Nuevamente");
                window.location = "../index.php"
            </script>
        ';
    }

    mysqli_close($conexion);
?>

