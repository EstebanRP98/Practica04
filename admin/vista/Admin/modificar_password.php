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
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="../../../css/estiloUser.css">
    <link rel="stylesheet" href="../../../css/estiloNew.css">
</head>
<body class="fondoCrear">
<form class="marcoReg" method="get" action="../../controladores/update_contrasena.php">
        <?php
            include '../../../config/conexionBD.php';

            $codigo = $_GET['codigop'];
       
            $sql="SELECT * 
                  FROM t_usuario
                  WHERE usu_codigo = $codigo";
       
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
       ?>       
       
       <label hidden="hidden" for="codigo"></label>
       <input type="text" name="codigo" hidden="hidden" value="<?php echo $row['usu_codigo']; ?>">
       <label for="contrasena">Escriba Nueva Contraseña</label>
       <input type="password" id="contrasena" name="contrasena" value="" required>
       
       <br>
       
       <input type="submit" id="crear" name="crear" value="Aceptar">
       <input type="button" value="Volver" onClick="history.back()">
   </form>
    
    

</body>
</html>