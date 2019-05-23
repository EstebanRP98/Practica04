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
    <link href="../../css/estiloUser.css" rel="stylesheet">
    <link href="../../css/estiloUserNew.css" rel="stylesheet">
    <title>Mi Cuenta</title>
</head>
<body class="fondoCrear">
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
   <form  class="marcoCuenta" method="get" action="../controladores/cuentaControl.php" enctype="multipart/form-data">
        <?php
            include '../../config/conexionBD.php';
            $codigo = $_GET['id'];
            $sql="SELECT * 
                  FROM t_usuario
                  WHERE usu_codigo = $codigo";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
       ?>       
       <label hidden="hidden" for="codigo"></label>
       <input class="cuentaLabel" type="text" name="codigo" hidden="hidden" value="<?php echo $row['usu_codigo']; ?>">
       <div class="textbox" id="textboxImg">
            <?php
            echo "<img class='foto' src='data:image/jpeg, base64,".base64_encode($row['usu_image'])."'>";
            ?>
         <input type='file' name='imagenUpdate' id='imagen' size='20'>
        </div>
       <label class="cuentaName" for="cedula">Cedula</label>
       <input class="cuentaLabel" type="text" id="cedula" name="cedula" value="<?php echo $row['usu_cedula']; ?>" required>
       <br>
       <label class="cuentaName" for="nombres">Nombres</label>
       <input class="cuentaLabel" type="text" id="nombres" name="nombres" value="<?php echo $row['usu_nombres']; ?>" required>
       <br>
       <label class="cuentaName" for="apellidos">Apellidos</label>
       <input class="cuentaLabel" type="text" id="apellidos" name="apellidos" value="<?php echo $row['usu_apellidos']; ?>" required>
       <br>
       <label class="cuentaName" for="direccion">Dirección</label>
       <input class="cuentaLabel" type="text" id="direccion" name="direccion" value="<?php echo $row['usu_direccion']; ?>" required>
       <br>
       <label class="cuentaName" for="telefono">Telefono</label>
       <input class="cuentaLabel" type="tel" id="telefono" name="telefono" value="<?php echo $row['usu_telefono']; ?>" required>
       <br>
       <label class="cuentaName" for="correo">Correo</label>
       <input class="cuentaLabel" type="email" id="correo" name="correo" value="<?php echo $row['usu_correo']; ?>" required>
       <br>
       <label class="cuentaName" for="fechaNacimiento">Fecha de Nacimiento</label>
       <input class="cuentaLabel" type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $row['usu_fecha_nacimiento']; ?>" required>
       <br>
       <input id="botonAceptar" type="submit" id="crear" name="crear" value="Aceptar">
       <input id="botonRegresar" type="button" value="Volver" onClick="history.back()">
   </form>
</body>
</html>   