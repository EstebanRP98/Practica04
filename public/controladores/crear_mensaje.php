<!DOCTYPE html>
 <html>
 <head>
  <meta charset="UTF-8">
  <title>Crear Mensaje</title>
  <style type="text/css" rel="stylesheet">
  .error{
  color: red;
  }
  </style>
 </head>
 <body>
  <?php
  //incluir conexión a la base de datos
  include '../../config/conexionBD.php';

  date_default_timezone_set("America/Guayaquil");
  $fecha = date("Y-m-d H:i:s",time());

  $asunto = isset($_POST["asunto"]) ? trim($_POST["asunto"]) : null;
  $mensaje = isset($_POST["mensaje"]) ? mb_strtoupper(trim($_POST["mensaje"])) : null;
  $remitente = isset($_POST["remitente"]) ? mb_strtoupper(trim($_POST["remitente"])) : null;
  $destinatario = isset($_POST["destinatario"]) ? mb_strtolower(trim($_POST["destinatario"])) : null;
  $des=CorreoID($destinatario);
  $sql = "INSERT INTO t_correos VALUES (0,'$fecha','$asunto', '$mensaje',NULL,'NULL', 'N','$des','$remitente');";


  if ($conn->query($sql) === TRUE) {
  echo "<p>Se ha enviado el mensaje!!!</p>";
  Header('Location: ../vista/index.php?codigo='.$remitente);
  } else {
  if($conn->errno == 1062){
  echo "<p class='error'> </p>";
  }else{
  echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
  }
  }

    function CorreoNombre($codigoCorreo){
    include '../../config/conexionBD.php';
    $sql1="Select usu_correo FROM t_usuario WHERE usu_codigo='$codigoCorreo'";
    $result1 = $conn->query($sql1);
    if($result1->num_rows > 0){
        while($row = $result1->fetch_assoc()){  
            $direccionCorreo=$row["usu_correo"];
        }
    }
    return $direccionCorreo;
    }
    function CorreoID($Correo){
        include '../../config/conexionBD.php';
        $sql1="Select usu_codigo FROM t_usuario WHERE usu_correo='$Correo'";
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0){
            while($row = $result1->fetch_assoc()){  
                $dir=$row["usu_codigo"];
            }
        }
    return $dir;
    }
 
  //cerrar la base de datos
  $conn->close();
  
  ?>
 </body>
 </html>
