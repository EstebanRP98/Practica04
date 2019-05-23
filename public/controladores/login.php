<?php
 session_start();
 include '../../config/conexionBD.php';
 $usuario = isset($_POST["correo"]) ? trim($_POST["correo"]) : null;
 $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;


 $sql = "SELECT * FROM t_usuario WHERE usu_correo = '$usuario' and usu_password = MD5('$contrasena')";

 $result = $conn->query($sql);
 $row = $result-> fetch_assoc();

$sql1 = "SELECT usu_codigo as id FROM t_usuario WHERE usu_correo = '$usuario' and usu_password = MD5('$contrasena')";
$result1 = $conn->query($sql1);
$row1 = $result1-> fetch_assoc();



 if ($result->num_rows > 0) {
            $_SESSION['isLogged'] = TRUE;
            include '../../config/conexionBD.php';
        
            
            $sqlc = "SELECT * 
                    FROM T_USUARIO
                    where usu_correo = '$usuario' and usu_password = MD5('$contrasena')";
            $resultc = $conn->query($sqlc);
            $rowc = $resultc->fetch_assoc();
            if($rowc["rol_usu_id"] == 2){
            header("Location: ../../admin/vista/admin/index.php"); 
            }
            else{
            header("Location: ../vista/index.php?codigo=". $row1['id']);
            }
 } else {
 header("Location: ../vista/login.html");
 }

 $conn->close();
?>
