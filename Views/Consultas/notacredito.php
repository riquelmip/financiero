<?php
include "fpdf/fpdf.php";

$pdf = new FPDF($orientation='L',$unit='mm');
$pdf->AddPage();



$pdf->SetFont('Arial','B',20);    
$textypos = 5;
$pdf->setY(12);
$pdf->setX(10);

$pdf->Image('Views/Consultas/img/logo.png',10,10,33);

$pdf->SetFont('times', 'B', 13);
// Movernos a la derecha
$pdf->Cell(80);


$pdf->Text(44, 15, utf8_decode(NOMBRE_EMPESA));

$pdf->Text(44, 21, utf8_decode('6ª av. Jiquilisco,Usulután'));
$pdf->Text(44,27, utf8_decode('Tel: 7245-8620'));
$pdf->Text(44,33, utf8_decode(EMAIL_REMITENTE));
$pdf->Image('Views/Consultas/img/cuadrito.png',152,8,50,26);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Text(160, 18, utf8_decode('NOTA DE DÉBITO'));
$pdf->SetFont('Arial','B',10);   
$pdf->Text(160,25, utf8_decode('FACTURA N°:'));
$pdf->SetFont('Arial','',10);  
$pdf->Text(184,25, utf8_decode($data['idventa']));



// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->Text(10,48, utf8_decode('Fecha:'));
$pdf->SetFont('Arial','',10);    
$pdf->Text(25,48, utf8_decode($data['fecha']));

$pdf->SetFont('Arial','B',10);    
$pdf->Text(45,48, utf8_decode('Giro:'));
$pdf->SetFont('Arial','',10);
    
$pdf->Text(55,48, utf8_decode('Contado'));


// Agregamos los datos de la factura
$pdf->SetFont('Arial','B',10);    
$pdf->Text(10,54, utf8_decode('Cliente:'));
$pdf->SetFont('Arial','',10);    
$pdf->Text(25,54, utf8_decode($data['cliente']));

$pdf->SetFont('Arial','B',10);    
$pdf->Text(80,54, utf8_decode('Registro N:'));
$pdf->SetFont('Arial','',10);    
$pdf->Text(105,54, utf8_decode($data['idventa']));
/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
/////////////////////////////
//// Array de Cabecera
$header = array("Mes", "Fechapago", "Fechapagó","Cuota.","Capital","Intereses","Mora","Abono Capital","Total Abono","Saldo");
//// Array de Productos

    // Column widths
    $w = array(28, 28, 28, 28, 28, 28, 28, 28, 28, 28);
    // Header
    for($i=0;$i<count($header);$i++){
        $pdf->SetFont('Arial','B',10);   
        $pdf->Cell($w[$i],7,utf8_decode($header[$i]),1,0,'C');
    }
        
    $pdf->Ln();
    // Data
    $total = 0;
    $pdf->SetFont('Arial','',10);  
    for ($i=0; $i < count($data['pagos']); $i++) {
        $pdf->Cell($w[0],6,utf8_decode($data['pagos'][$i]['mes']),1,0,'C');
        $pdf->Cell($w[1],6,utf8_decode($data['pagos'][$i]['fecha']),1,0,'C');
        $pdf->Cell($w[2],6,utf8_decode($data['pagos'][$i]['fechapago']),1,0,'C');
        $pdf->Cell($w[3],6,utf8_decode($data['pagos'][$i]['cuota']),1,0,'C');
        $pdf->Cell($w[4],6,utf8_decode($data['pagos'][$i]['capital']),1,0,'C');
        $pdf->Cell($w[5],6,utf8_decode($data['pagos'][$i]['intereses']),1,0,'C');
        $pdf->Cell($w[6],6,utf8_decode($data['pagos'][$i]['mora']),1,0,'C');
        $pdf->Cell($w[7],6,utf8_decode($data['pagos'][$i]['abonocapital']),1,0,'C');
        $pdf->Cell($w[8],6,utf8_decode($data['pagos'][$i]['totalabono']),1,0,'C');
        $pdf->Cell($w[9],6,utf8_decode($data['pagos'][$i]['saldofinal']),1,0,'C');
        $pdf->Ln();
      

    }
/////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
/*$yposdinamic = 60 + (count($data['productos'])*10);

$pdf->setY($yposdinamic);
$pdf->setX(235);
    $pdf->Ln();
/////////////////////////////
$header = array("", "");
$data2 = array(
    array("Subtotal",SMONEY.number_format(floatval($data['subtotal']), 2, ',', ' ')),
    array("Impuesto", SMONEY.number_format(floatval($data['iva']), 2, ',', ' ')),
    array("Ventas Exentas", '-'),
    array("Ventas No Sujetas", '-'),
    array("Total", SMONEY.number_format(floatval($data['monto']), 2, ',', ' ')),
);
    // Column widths
    $w2 = array(40, 40);
    // Header

    $pdf->Ln();
    // Data
    foreach($data2 as $row)
    {
        $pdf->setX(115);
        $pdf->Cell($w2[0],6,$row[0],1);
        $pdf->Cell($w2[1],6,$row[1],'1',0,'R');

        $pdf->Ln();
    }
/////////////////////////////

/////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
$yposdinamic = 60 + (count($data['productos'])*10);

$pdf->setY($yposdinamic);
$pdf->setX(235);
    $pdf->Ln();
/////////////////////////////
$header = array("", "");
$data2 = array(
    array("Entregado por",$data['nombreusuario']),
    array("DUI",$data['dui']),
    array("Tel.", '7245-8620'),
    array("Recibido por",$data['cliente'] ),
   // array("Total", SMONEY.number_format(floatval($data['monto']), 2, ',', ' ')),
);
    // Column widths
    $w2 = array(40, 40);
    // Header

    $pdf->Ln();
    // Data
    foreach($data2 as $row)
    {
        $pdf->setX(10);
        $pdf->Cell($w2[0],6,$row[0],1);
        $pdf->Cell($w2[1],6,$row[1],'1',0,'R');

        $pdf->Ln();
    }
/////////////////////////////

*/
$pdf->output("Factura.pdf","I");
?>