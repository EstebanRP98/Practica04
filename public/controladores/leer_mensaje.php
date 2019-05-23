
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mi Cuenta</title>
    <link href="../../css/estiloUser.css" rel="stylesheet">
    <link href="../../css/estiloUserNew.css" rel="stylesheet">
    
</head>
<body class="fondoCrear">
   <form class="marcoLeer" method="get">
        <?php
            include '../../config/conexionBD.php';
            $codigol = $_GET['codigol'];
            $id_rem = $_GET['id_rem'];
            $id_usu = $_GET['id_usu'];
            $sql="SELECT * 
                  FROM t_correos
                  WHERE cor_id = $codigol and cor_id_remitente = $id_rem and cor_id_destinatario = $id_usu";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

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
        ?>       
       <label hidden="hidden" for="codigo"></label>
       <input type="text" name="codigo" hidden="hidden" value="<?php echo $row['cor_id']; ?>">
       <label for="remitente">Remitente</label>
       <input type="text" id="remitente" name="remitente" value="<?php echo CorreoNombre($row['cor_id_remitente']); ?>">
       <br>
       <label for="asunto">Asunto</label>
       <input id="textoAsunto"  type="text" id="asunto" name="asunto" value="<?php echo $row['cor_asunto']; ?>">
       <br>
       <label for="mensaje">Mensaje</label>
       <textarea  id="textoMensaje" name="mensaje" cols="30" rows="10" ><?php echo $row['cor_mensaje']; ?></textarea>
       <br>
       <input id="boton" type="button" value="Volver" onClick="history.back()">
   </form>
</body>
</html>   