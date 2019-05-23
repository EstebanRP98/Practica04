<?php
    session_start();
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged']==FALSE){
        header("Location: /SistemaDeGestion/public/vista/login.html");
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar</title>
    <style type="text/css" rel="stylesheet">
         .error{
             color: red;
         }
     </style>
</head>
<body>
    <?php
    
        //incluir conexion a la base de datos

        include '../../config/conexionBD.php';
        
        $codigo = isset($_GET["codigo"]) ? trim($_GET["codigo"]): null;
        $contrasena = isset($_GET["contrasena"]) ? trim($_GET["contrasena"]): null;
        date_default_timezone_set("America/Guayaquil");
        $fecha = date("Y-m-d H:i:s",time());
    
        $sql ="UPDATE t_usuario 
                SET usu_password = MD5('$contrasena'), usu_fecha_modificacion = '$fecha'
        WHERE usu_codigo = '$codigo'";
    
        if($conn->query($sql) === TRUE) {
            Header('Location: ../vista/Admin/index.php?codigo='.$codigo);
        } else {
             echo "<p> error al actualizar data contactar con el administrador </p>";
        }
    
        $conn->close();
    ?>
</body>
</html>