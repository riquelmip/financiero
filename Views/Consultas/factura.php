<?php
include "fpdf/fpdf.php";

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();



$pdf->SetFont('Arial','B',20);    
$textypos = 5;
$pdf->setY(12);
$pdf->setX(10);

$pdf->Image('Views/Consultas/img/logo.png',25,10,33);

$pdf->SetFont('times', 'B', 13);
// Movernos a la derecha
$pdf->Cell(80);


$pdf->Text(75, 15, utf8_decode(NOMBRE_EMPESA));

$pdf->Text(77, 21, utf8_decode('6ª av. Jiquilisco,Usulután'));
$pdf->Text(88,27, utf8_decode('Tel: 7245-8620'));
$pdf->Text(71,33, utf8_decode(EMAIL_REMITENTE));

$pdf->Image('Views/Consultas/img/logoosis.png',160,5,33);


$pdf->SetFont('Arial','B',10);   
$pdf->Text(150,48, utf8_decode('FACTURA N°:'));
$pdf->SetFont('Arial','',10);  
$pdf->Text(176,48, utf8_decode($data['idventa']));



// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->Text(10,48, utf8_decode('Fecha:'));
$pdf->SetFont('Arial','',10);    
$pdf->Text(25,48, utf8_decode($data['fecha']));




// Agregamos los datos de la factura
$pdf->SetFont('Arial','B',10);    
$pdf->Text(10,54, utf8_decode('Cliente:'));
$pdf->SetFont('Arial','',10);    
$pdf->Text(25,54, utf8_decode($data['cliente']));


/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
/////////////////////////////
//// Array de Cabecera
$header = array("Cod.", "Descripción", "Tipo","Cant.","Precio","Total");
//// Arrar de Productos
$products = array(
    array("0010", "Producto 1",2,120,0),
    array("0024", "Producto 2",5,80,0),
    array("0001", "Producto 3",1,40,0),
    array("0001", "Producto 3",5,80,0),
    array("0001", "Producto 3",4,30,0),
    array("0001", "Producto 3",7,80,0),
);
    // Column widths
    $w = array(20, 75, 20, 20, 25, 25);
    // Header
    for($i=0;$i<count($header);$i++){
        $pdf->SetFont('Arial','B',10);   
        $pdf->Cell($w[$i],7,utf8_decode($header[$i]),1,0,'C');
    }
        
    $pdf->Ln();
    // Data
    $total = 0;
    $pdf->SetFont('Arial','',10);  
    for ($i=0; $i < count($data['productos']); $i++) {
        $pdf->Cell($w[0],6,utf8_decode($data['productos'][$i]['codigobarra']),1);
        $pdf->Cell($w[1],6,utf8_decode($data['productos'][$i]['producto']),1);
        if ($data['productos'][$i]['formapago'] == 1) {
        $forma = "Contado";
            }else{
                $forma = "Crédito";
            }
        $pdf->Cell($w[2],6,utf8_decode($forma),1);
        $pdf->Cell($w[3],6,$data['productos'][$i]['cantidad'],'1',0,'R');
        $pdf->Cell($w[4],6,SMONEY.number_format(round($data['productos'][$i]['precio'],2), 2, ',', ' '),'1',0,'R');
        $pdf->Cell($w[5],6,SMONEY.number_format(round(intval($data['productos'][$i]['cantidad'])*floatval($data['productos'][$i]['precio']),2), 2, ',', ' '),'1',0,'R');

        $pdf->Ln();
      

    }
/////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
$yposdinamic = 60 + (count($data['productos'])*10);

$pdf->setY($yposdinamic);
$pdf->setX(235);
    $pdf->Ln();
/////////////////////////////
$header = array("", "");
$data2 = array(
    array("Subtotal",SMONEY.number_format(floatval($data['subtotal']), 2, ',', ' ')),
    array("Impuesto", SMONEY.number_format(floatval($data['iva']), 2, ',', ' ')),
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



$pdf->output("Factura.pdf","I");
?>