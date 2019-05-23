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
    <title>Gestión de Mensajes</title>
    <link href="../../../css/estilo.css" rel="stylesheet">
</head>
<body class="fondoAdmin">
    <header>
        <h1>Admin control de mensajes</h1>
    </header>
    <nav class="menuAdmin">
                <ul >
                    <li><a href="mensaje.php">Mensajes</a></li>
                    <li><a href="index.php">Usuarios</a></li>
                </ul>
    </nav>

    <table style="width:100%">
    <tr>
    <th>Fecha</th>
    <th>Remitente</th>
    <th>Destinatario</th>
    <th>Asunto</th>
    <th>Eliminar Mensaje</th>
    </tr>

    <?php
    include '../../../config/conexionBD.php';
    $sql = "SELECT * FROM t_correos";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc() ) {
        echo "<tr>";
        echo " <td>" . $row["cor_fecha_mensaje"] . "</td>";
        echo " <td>" . CorreoNombre($row['cor_id_remitente']) ."</td>";
        echo " <td>" . CorreoNombre($row['cor_id_destinatario']) . "</td>";
        echo " <td>" . $row['cor_asunto'] . "</td>";
        echo "<td>" ."<a href=../../controladores/eliminar_mensaje.php?codigod=".$row['cor_id'].">Eliminar Mensaje</a>"."</td>";
        echo "</tr>";
        }
    } else {
    echo "<tr>";
    echo " <td colspan='7'> No existen mensajes registradas en el sistema </td>";
    echo "</tr>";
    }

    function CorreoNombre($codigoCorreo){
        include '../../../config/conexionBD.php';
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
          <input class="botonCerrarSesion" type="button" id="CerrarSesion" name="Cerrar" value="Cerrar Sesion" onclick="location.href='../../../public/vista/login.html'" />
    </body>
    <footer>
        
    </footer>

</html>