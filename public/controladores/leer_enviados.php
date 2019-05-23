<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../../css/estiloUser.css" rel="stylesheet">
    <link href="../../css/estiloUserNew.css" rel="stylesheet">
    <title>Mi Cuenta</title>
</head>
<body class="fondoCrear">
   <form class="marcoLeer" method="get">
        <?php
            include '../../config/conexionBD.php';
            $codigol = $_GET['codigol'];
            $id_rem = $_GET['id_rem'];
            $sql="SELECT * 
                  FROM t_correos
                  WHERE cor_id = $codigol and cor_id_remitente = $id_rem";
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
       <label for="destinatario">Remitente</label>
       <input type="text" id="destinatario" name="destinatario" value="<?php echo CorreoNombre($row['cor_id_destinatario']); ?>">
       <br>
       <label for="asunto">Asunto</label>
       <input id="textoAsunto"  type="text" id="asunto" name="asunto" value="<?php echo $row['cor_asunto']; ?>">
       <br>
       <label for="mensaje">Mensaje</label>
       <textarea id="textoMensaje" cols="30" rows="10" id="mensaje" name="mensaje"><?php echo $row['cor_mensaje']; ?></textarea>
       <br>
       <input id="boton" type="button" value="Volver" onClick="history.back()">
   </form>
</body>
</html>   