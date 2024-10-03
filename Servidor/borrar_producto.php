<?php
include_once("conexion.php");

if (!empty($_GET['id'])) {
    $clave = intval($_GET['id']); 
    $consulta = mysqli_query($conexion, "DELETE FROM productos WHERE idprod = $clave");

    if ($consulta) {
       
        header("Location: ../Cliente/productos.php?delete=success");
    } else {
     
        header("Location: ../Cliente/productos.php?delete=error");
    }
    
    mysqli_close($conexion);
    exit();
}
?>
