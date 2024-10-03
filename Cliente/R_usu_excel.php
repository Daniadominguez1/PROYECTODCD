<?php
include("../Servidor/conexion.php");

///nombre del archivo y charset
header('Content-Type:text/csv; charset=latin1');
header('Content-Disposition:attachment;filename="ReporteUsu.csv"');
//Salida del archivo
$salida=fopen('php://output','w');
//encabezados
fputcsv($salida, array('ID','Nombre',utf8_decode('Apellido Paterno'),'Apellido Materno','Correo','Telefono'));
//consulta para mostrar en el reporte
$reporteCsv=mysqli_query($conexion, 'SELECT * FROM usuarios');
if(!$reporteCsv){

    die("Error en la consulta:" .$mysqli->error);
}
while($filaR=$reporteCsv->fetch_assoc()){
fputcsv($salida,array(
$filaR['idusu'],
$filaR['NomUsu'],
$filaR['ApaUsu'],
$filaR['AmaUsu'],
$filaR['Correo'],
$filaR['Telefono']
));
}
fclose($salida);
?>
