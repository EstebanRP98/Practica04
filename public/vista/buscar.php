<?php
    session_start();
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
        header("Location: login.html");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Busqueda</title>
    <style type="text/css">
        .holi{
            background: red;
        }
    </style>
</head>
<body>
  <table>
        <tr id="cabecera">
             <th>Fecha del Mensaje</th>
             <th>Remitente</th>
             <th>Asunto</th>
             <th>Mensaje</th>
        </tr>
       <?php
            include '../../config/conexionBD.php';
            
            $correo = $_GET['correo'];
            $id = $_GET['id'];
            $sql="SELECT *
            FROM t_correos,t_usuario
            WHERE cor_id_destinatario = $id AND
                usu_correo like '%$correo%'  AND cor_id_remitente = usu_codigo";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                         while($row = $result->fetch_assoc()){
                             echo "<tr>";
                                echo " <td>" . $row['cor_fecha_mensaje'] . "</td>";
                                echo " <td>" . $row['usu_correo'] ."</td>";
                                echo " <td>" . $row['cor_asunto'] . "</td>";
                                echo "<td>" ."<a href=../controladores/leer_mensaje.php?codigol=".$row['cor_id'].'&id_rem='.$row['cor_id_remitente'].'&id_usu='.$id.">Leer Mensaje</a>"."</td>";
                             echo "</tr>";
                         }  
                }else{
                     echo "<tr>";
                        echo "<td colspan='5'>No existe ningun usuario registrado en el sistema</td>";
                    echo "</tr>";
                }       
            
        ?>
    </table>
</body>
</html>