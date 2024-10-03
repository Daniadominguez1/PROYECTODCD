<?php
include_once("conexion.php");
if (!empty($_GET['id'])) {
    $clave =$_GET['id']; 


    $consulta= mysqli_query($conexion, " DELETE FROM categorias WHERE idcat = $clave ");

    if ($consulta) {
       
        header("Location: ../Cliente/categorias.php?delete=success");
    } else {
     
        header("Location: ../Cliente/categorias.php?delete=error");
    }
    
    mysqli_close($conexion);
    exit();
}
?>
