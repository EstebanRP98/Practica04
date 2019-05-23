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
    <title>Gestión de usuarios</title>
    <link href="../../../css/estilo.css" rel="stylesheet">
</head>
<body class="fondoAdmin">
    <header>
        <h1>Admin control de usuarios</h1>
    </header>
    <nav class="menuAdmin">
                <ul >
                    <li><a href="mensaje.php">Mensajes</a></li>
                    <li><a href="index.php">Usuarios</a></li>
                </ul>
    </nav>

    <table style="width:100%">
    <tr>
    <th>Cedula</th>
    <th>Nombres</th>
    <th>Apellidos</th>
    <th>Dirección</th>
    <th>Telefono</th>
    <th>Correo</th>
    <th>Fecha Nacimiento</th>
    <th>Modificar Registro</th>
    <th>Cambiar password</th>
    <th>Eliminar Registro</th>
    </tr>

    <?php
    include '../../../config/conexionBD.php';
    $sql = "SELECT * FROM t_usuario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo " <td>" . $row["usu_cedula"] . "</td>";
    echo " <td>" . $row['usu_nombres'] ."</td>";
    echo " <td>" . $row['usu_apellidos'] . "</td>";
    echo " <td>" . $row['usu_direccion'] . "</td>";
    echo " <td>" . $row['usu_telefono'] . "</td>";
    echo " <td>" . $row['usu_correo'] . "</td>";
    echo " <td>" . $row['usu_fecha_nacimiento'] . "</td>"; 
    echo "<td>" ."<a href=modificar_registro.php?codigo=".$row['usu_codigo'].">Modificar Registro</a>"."</td>";
    echo "<td>" ."<a href=modificar_password.php?codigop=".$row['usu_codigo'].">Modificar Contraseña</a>"."</td>";
    echo "<td>" ."<a href=../../controladores/eliminar_registro.php?codigod=".$row['usu_codigo'].">Eliminar Registro</a>"."</td>";
    echo "</tr>";
    }
    } else {
    echo "<tr>";
    echo " <td colspan='7'> No existen usuarios registradas en el sistema </td>";
    echo "</tr>";
    }
    $conn->close();
    ?>
    </table>
          <input class="botonCerrarSesion" type="button" id="CerrarSesion" name="Cerrar" value="Cerrar Sesion" onclick="location.href='../../../public/vista/login.html'" />
    </body>
    <footer>
        
    </footer>

</html>
