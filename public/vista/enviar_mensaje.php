<?php
    session_start();
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
        header("Location: ../../../public/vista/login.html"); 
    }
?>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enviar mensaje</title>
    <link rel="stylesheet" href="../../css/estiloUser.css">
    <style type="text/css">
        a{
            text-decoration: none;
            color: white;
            font-family: sans-serif;
            margin: 20px 0;
        }
    </style>
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
    <?php
        include '../../config/conexionBD.php';
        $codigo = $_GET['id'];
    
        $sql = "SELECT * 
                FROM t_usuario
                where usu_codigo = $codigo";
        
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
    <header >
       <div >
           <div >
               <h4 id="titulo">Mensaje Nuevo</h4>    
           </div>
           <nav class="menu">
              <ul>
                    <?php
                    echo "<li>"."<a href=index.php?codigo=".$codigo.">Inicio</a></li>";
                    echo "<li>"."<a href=enviar_mensaje.php?id=".$codigo.">Nuevo Mensaje</a></li>";
                    echo "<li>"."<a href=../controladores/mensajes_enviados.php?id=".$codigo.">Mensajes enviados</a></li>";
                    echo "<li>"."<a href=cuenta.php?id=".$codigo.">Mi cuenta</a></li>";
                    ?>
              </ul> 
           </nav>
       </div>
   </header>
   <form  class="marcoMensaje" action="../controladores/crear_mensaje.php" method="post">
       <h2 >MENSAJE</h2>
        <input type="text" class="textoMensaje" id="remite" name="remitente" value="<?php echo $codigo?>" hidden="hidden">
        <input type="text" id="textoCorreo" name="destinatario" placeholder="Ingrese a que correo desea enviar">
        <input type="text" id="textoAsunto" name="asunto" placeholder="Asunto del Mensaje">
        <textarea id="textoMensaje" name="mensaje"  cols="30" rows="10" placeholder="Escriba aqui su mensaje"></textarea>
        <input id="boton" type="submit" value="ENVIAR" id="boton" >
   </form>
</body>
</html>