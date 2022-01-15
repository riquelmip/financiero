<?php
include "fpdf/fpdf.php";

$pdf = new FPDF('P','mm',array(80,150)); // Tamaño tickt 80mm x 150 mm (largo aprox)
$pdf->AddPage();
 
// CABECERA
$pdf->SetFont('Helvetica','',12);
//NOMBRE
$pdf->Cell(60,4,utf8_decode(NOMBRE_EMPESA),0,1,'C');
$pdf->SetFont('Helvetica','',8);
//$pdf->Cell(60,4,'C.I.F.: 01234567A',0,1,'C');
//$pdf->Cell(60,4,'C/ Arturo Soria, 1',0,1,'C');

//DIRECCION
$pdf->Cell(60,4,utf8_decode('6ª av. Jiquilisco,Usulután'),0,1,'C');
//TELEFONO
$pdf->Cell(60,4,'7245-8620',0,1,'C');
//EMAIL
$pdf->Cell(60,4,utf8_decode(EMAIL_REMITENTE),0,1,'C');
 
// DATOS FACTURA        
$pdf->Ln(5);
$pdf->Cell(60,4, utf8_decode('Factura N°: '. $data['idventa']),0,1,'');
$pdf->Cell(60,4,utf8_decode('Fecha: '. $data['fecha']),0,1,'');
$pdf->Cell(60,4,'Cliente: '. $data['cliente'],0,1,'');
 
// COLUMNAS
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(20, 10, utf8_decode("Descripción"), 0);
$pdf->Cell(5, 10, 'T',0,0,'R');
$pdf->Cell(5, 10, 'Ud',0,0,'R');
$pdf->Cell(15, 10, 'Precio',0,0,'R');
$pdf->Cell(15, 10, 'Total',0,0,'R');
$pdf->Ln(8);
$pdf->Cell(60,0,'','T');
$pdf->Ln(3);
 
// PRODUCTOS
$pdf->SetFont('Helvetica', '', 7);

for ($i=0; $i < count($data['productos']); $i++) { 
    $pdf->MultiCell(20,4,utf8_decode($data['productos'][$i]['producto']),0,'L'); 
    if ($data['productos'][$i]['formapago'] == 1) {
        $forma = "Con";
    }else{
        $forma = "Cre";
    }
    $pdf->Cell(25, -5, $forma,0,0,'R');
    $pdf->Cell(5, -5, $data['productos'][$i]['cantidad'],0,0,'R');
    $pdf->Cell(15, -5, SMONEY.number_format(round($data['productos'][$i]['precio'],2), 2, ',', ' '),0,0,'R');
    $pdf->Cell(15, -5, SMONEY.number_format(round(intval($data['productos'][$i]['cantidad'])*floatval($data['productos'][$i]['precio']),2), 2, ',', ' '),0,0,'R');
    $pdf->Ln(1);
}


 
// SUMATORIO DE LOS PRODUCTOS Y EL IVA
$pdf->Ln(2);
$pdf->Cell(60,0,'','T');
$pdf->Ln(2);    
$pdf->Cell(25, 10, 'SUBTOTAL', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, SMONEY.number_format(floatval($data['subtotal']), 2, ',', ' '),0,0,'R');
$pdf->Ln(3);    
$pdf->Cell(25, 10, utf8_decode("I.V.A. 13%"), 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, SMONEY.number_format(floatval($data['iva']), 2, ',', ' '),0,0,'R');
$pdf->Ln(3);    
$pdf->Cell(25, 10, 'TOTAL', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, SMONEY.number_format(floatval($data['monto']), 2, ',', ' '),0,0,'R');
 
// PIE DE PAGINA
$pdf->Ln(10);
$pdf->Cell(60,0,utf8_decode("¡Gracias por su compra!"),0,1,'C');
$pdf->Ln(2);

 
$pdf->Output("ticket.pdf","I");
?>