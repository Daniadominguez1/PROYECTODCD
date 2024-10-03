<?php
include("../Servidor/conexion.php");

// Nombre del archivo y charset
header('Content-Type:text/csv; charset=latin1');
header('Content-Disposition:attachment;filename="ReporteProductos.csv"');

// Salida del archivo
$salida = fopen('php://output', 'w');

// Encabezados de la tabla
fputcsv($salida, array('ID', 'Nombre', utf8_decode('Descripción'), 'Cantidad', 'Precio', 'Color', utf8_decode('Tamaño'), 'Foto'));

// Consulta para mostrar los productos en el reporte
$reporteCsv = mysqli_query($conexion, 'SELECT * FROM productos');
if (!$reporteCsv) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Recorrer cada fila de resultado y escribirla en el CSV
while ($filaR = mysqli_fetch_assoc($reporteCsv)) {
    fputcsv($salida, array(
        $filaR['idprod'],       // ID del producto
        $filaR['nombre'],       // Nombre del producto
        utf8_decode($filaR['descripcion']), // Descripción
        $filaR['cantidad'],     // Cantidad
        $filaR['precio'],       // Precio
        utf8_decode($filaR['color']),       // Color
        utf8_decode($filaR['tamanio']),     // Tamaño
        $filaR['foto']          // Ruta de la foto
    ));
}

// Cerrar el archivo CSV
fclose($salida);
?>
