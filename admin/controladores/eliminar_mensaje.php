<?php
    session_start();
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged']==FALSE){
        header("Location: /SistemaDeGestion/public/vista/login.html");
    }

?>
<?php


    include '../../config/conexionBD.php';
    
    $codigo = $_GET['codigod'];
    
    echo $codigo;

    $sql = "DELETE FROM t_correos
            WHERE cor_id = $codigo";
        
    if($conn->query($sql) === TRUE) {
             header("Location: ../vista/Admin/index.php");
        } else {

        }

    $conn->close();
?>