<?php
//incluir la libreria de fpdf
require("lib/fpdf/fpdf186/fpdf.php");
class PDF extends fpdf{
    //Cabecera de la página
    function  Header()
    {
        //logotipo
        $this->Image("img/ll.png", 18,8,33);
        //tipo de letra
        $this->SetFont("Arial","B",15);
        //movemos a la derecha
        $this->Cell(110);
        //titulo
        $this->Cell(60,10, "REPORTE DE USUARIOS EXISTENTES",0,0,'C');
        //Salto de línea
        $this->Ln(30);
        $this->SetFillColor(190, 215, 254 );//Color a la selda
        $this->SetTextColor(0, 48, 121 );
        //tipo de letra
        $this->SetFont("Arial","B",12);
        //encabezado de la tabla
        $this->Cell(30,10, 'Nombre',0,0,'C',true);
        $this->Cell(40,10, 'Paterno',0,0,'C',true);
        $this->Cell(40,10, 'Materno',0,0,'C',true);
        $this->Cell(90,10, 'Correo',0,0,'C',true);
        $this->Cell(50,10, utf8_decode('Teléfono'),0,0,'C',true);
        $this->Ln(10);
        
        
    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','B',8);
        $this->Cell(0,10,utf8_decode('Página').$this->PageNo(),0,0,'C');
    }
}
        //Consulta a la base de datos
        require("../Servidor/conexion.php");
        

        $consulta="SELECT * FROM usuarios";
        $resultado= mysqli_query($conexion, $consulta);
        if(!$resultado){
            die('Error en la consulta:'.mysqli_error($conexion));
        }
        $pdf=new PDF('L');
        //Referencia a la clase
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',10);
        while($row=mysqli_fetch_assoc($resultado)){
            $pdf->Cell(30,10,utf8_decode($row['NomUsu']),0,0,'C');
            $pdf->Cell(40,10,utf8_decode($row['ApaUsu']),0,0,'C');
            $pdf->Cell(40,10,utf8_decode($row['AmaUsu']),0,0,'C');
            $pdf->Cell(90,10,$row['Correo'],0,0,'C');
            $pdf->Cell(50,10,utf8_decode($row['Telefono']),0,0,'C');

            $pdf->Ln();

        
    }
    $pdf->Output(); //Permite la salida de datos
?>