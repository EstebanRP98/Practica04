<?php
    session_start();
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged']==FALSE){
        header("Location: /SistemaDeGestion/public/vista/login.html");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modificar Registro</title>
    <link rel="stylesheet" href="../../../css/estiloUser.css">
    <link rel="stylesheet" href="../../../css/estiloNew.css">
</head>
<body class="fondoCrear">
   <form class="marcoReg" method="get" action="../../controladores/modificar_registro.php">
        <?php
            include '../../../config/conexionBD.php';
            $codigo = $_GET['codigo'];
            $sql="SELECT * 
                  FROM t_usuario
                  WHERE usu_codigo = $codigo";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
       ?>       
       <label hidden="hidden" for="codigo"></label>
       <input type="text" name="codigo" hidden="hidden" value="<?php echo $row['usu_codigo']; ?>">
       <label for="cedula">Cedula</label>
       <input type="text" id="cedula" name="cedula" value="<?php echo $row['usu_cedula']; ?>" required>
       <br>
       <label for="nombres">Nombres</label>
       <input type="text" id="nombres" name="nombres" value="<?php echo $row['usu_nombres']; ?>" required>
       <br>
       <label for="apellidos">Apellidos</label>
       <input type="text" id="apellidos" name="apellidos" value="<?php echo $row['usu_apellidos']; ?>" required>
       <br>
       <label for="direccion">Dirección</label>
       <input type="text" id="direccion" name="direccion" value="<?php echo $row['usu_direccion']; ?>" required>
       <br>
       <label for="telefono">Telefono</label>
       <input type="tel" id="telefono" name="telefono" value="<?php echo $row['usu_telefono']; ?>" required>
       <br>
       <label for="correo">Correo</label>
       <input type="email" id="correo" name="correo" value="<?php echo $row['usu_correo']; ?>" required>
       <br>
       <label for="fechaNacimiento">Fecha de Nacimiento</label>
       <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $row['usu_fecha_nacimiento']; ?>" required>
       <br>
       <input type="submit" id="crear" name="crear" value="Aceptar">
       <input type="button" value="Volver" onClick="history.back()">
   </form>
</body>
</html>   