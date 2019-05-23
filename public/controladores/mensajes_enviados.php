<?php
    session_start();
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged']==FALSE){
        header("Location: /SistemaDeGestion/public/vista/login.html");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Principal</title>
    <link href="../../css/estiloUser.css" rel="stylesheet">
    <link href="../../css/estilo.css" rel="stylesheet">

</head>
<body class="fondoAdmin">
    <?php
            include '../../config/conexionBD.php';
        
            $codigoc = $_GET['id'];
            $sqlc = "SELECT * 
                    FROM T_USUARIO
                    where usu_codigo = $codigoc";
            $resultc = $conn->query($sqlc);
            $rowc = $resultc->fetch_assoc();
            if($rowc["rol_usu_id"] == 2){
            header("Location: ../../admin/vista/admin/index.php"); 
            }
    ?>
    <header>
        <h1>Mensajes enviados</h1>
    </header>
    <?php 
        $codi= $_GET['id']; 
    ?>
    <nav class="menu">
                <ul>
                    <?php
                    echo "<li>"."<a href=../vista/index.php?codigo=".$codi.">Inicio</a></li>";
                    echo "<li>"."<a href=../vista/enviar_mensaje.php?id=".$codi.">Nuevo Mensaje</a></li>";
                    echo "<li>"."<a href=../controladores/mensajes_enviados.php?id=".$codi.">Mensajes enviados</a></li>";
                    echo "<li>"."<a href=../vista/cuenta.php?id=".$codi.">Mi cuenta</a></li>";
                    ?>
                </ul> 
    </nav>
    <div id="informacion">
    <table style="width:100%">
    <tr>
    <th>Fecha</th>
    <th>Destinatario</th>
    <th>Asunto</th>
    <th>leer</th>
    </tr>
    
    <?php 
        include '../../config/conexionBD.php'; 
        $cod= $_GET['id']; 
        $sql="SELECT *
            FROM t_correos
            WHERE cor_id_remitente = $cod";
        $result = $conn->query($sql);
    if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo " <td>" . $row["cor_fecha_mensaje"] . "</td>";
        echo " <td>" . CorreoNombre($row['cor_id_destinatario']) ."</td>";
        echo " <td>" . $row['cor_asunto'] . "</td>";
        echo " <td>" ."<a href=../controladores/leer_enviados.php?codigol=".$row['cor_id'].'&id_rem='.$row['cor_id_remitente'].">Leer Mensaje</a>"."</td>";
        echo "</tr>";
    }
    } else {
        echo "<tr>";
        echo " <td colspan='7'> No existen usuarios registradas en el sistema </td>";
        echo "</tr>";
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

    $conn->close();
    ?>
    </table>
    </div>
          <input class="botonCerrarSesion" type="button" id="CerrarSesion" name="Cerrar" value="Cerrar Sesion" onclick="location.href='../vista/login.html'" />
    </body>
    <footer>
        
    </footer>

</html>