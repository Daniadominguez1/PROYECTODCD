<?php
include_once("conexion.php");

if (!empty($_GET['id'])) {
    $clave = intval($_GET['id']); 
    $consulta = mysqli_query($conexion, "DELETE FROM usuarios WHERE idusu = $clave");

    if ($consulta) {
       
        header("Location: ../Cliente/usuarios.php");
    } else {
     
        header("Location: ../Cliente/usuarios.php");
    }
    
    mysqli_close($conexion);
    exit();
}
?>
