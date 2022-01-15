<?php
require('Views/Consultas/fpdf/fpdf.php');
date_default_timezone_set('America/El_Salvador');
class PDF extends FPDF
{

function Header()
{

    $this->Image('Views/Consultas/img/logo.png',25,10,33);

    $this->SetFont('times', 'B', 13);
    // Movernos a la derecha
    $this->Cell(80);

  $this->SetTextColor(30,30,32);
  $this->Text(75, 15, utf8_decode('FERRETERIA GRANADEÑO'));
  
  $this->Text(77, 21, utf8_decode('6ª av. Jiquilisco,Usulután'));
    $this->Text(88,27, utf8_decode('Tel: 7245-8620'));

    $this->Image('Views/Consultas/img/logoosis.png',160,5,33);
    $this->SetFont('courier', 'B', 10);
    $this->Text(165,42,date('d/m/Y'));
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic vacio es normal xd
    $this->SetFont('times','',12);

    $this->Cell(0,10, utf8_decode('Derechos Reservados © 2021 - UES FMP'),0,0,'C');
    $this->Cell(0,10,utf8_decode('Página').$this->PageNo(),0,0,'R');

}



// ------------------------------------------------------------
var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data,$setX)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h,$setX);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h,'DF');
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h,$setX)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger){
        $this->AddPage($this->CurOrientation);
         $this->SetX($setX);
                $this->SetFillColor(93, 155, 155);
                $this->SetDrawColor(44, 62, 80);
                $this->Cell(80, 10, 'Producto', 1, 0, 'C', 1);
                $this->Cell(80, 10, 'Cantidad', 1, 1, 'C', 1);
                $this->SetFillColor(255,255,255);
                $this->SetDrawColor(0, 0, 0);
         }


             if($setX==100){
            $this->SetX(100);
             }else{
                $this->SetX($setX);
             }

}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
// ----------------------------------------------------------------

}


$a = new ConsultasModel();
if($_POST["parametro"]==0){
    $array=$a->clientesmenoscompras(); 
}else{
    $array=$a->clientemenorcomprasfiltrada($_POST["parametro"]);
}
// Creación del objeto de la clase heredada

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(44);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);



$pdf->SetFont('Arial','B',12);

$pdf->Ln();

/*-------TITULOS Y ENCABEZADOS -----------*/
$pdf->Ln(30);
$pdf->SetFont('', 'B', 12);

$pdf->Text(50, 45,'LOS 10 CLIENTES CON MENOR INDICE DE COMPRAS ');

$pdf->Ln(16);
/* ---Titulo de Tabla --- */

$pdf->SetX(30);
$pdf->SetFillColor(93, 155, 155);
$pdf->SetDrawColor(44, 62, 80);

$pdf->Cell(80, 10, 'Nombre', 1, 0, 'C', 1);
$pdf->Cell(80, 10, 'Monto Total Vendido', 1, 1, 'C', 1);

/* --- Datos de la tabla --- */
//prueba con 32
$pdf->SetWidths(array(80,80));
$pdf->SetFont('', '', 12);
for ($i = 0; $i <count($array) ; $i++) {
if($i%2==0){
//240,240,240
$pdf->SetFillColor(255,255,255);
$pdf->SetDrawColor(0, 0, 0);

}else{
$pdf->SetFillColor(197, 226, 246);
// $pdf->SetDrawColor(44, 62, 80);
$pdf->SetDrawColor(0, 0, 0);
}

$pdf->Row(array(utf8_decode($array[$i]['nombre']).utf8_decode($array[$i]['apellido']),$array[$i]['monto']),30);                      
}




$pdf->Ln(5);
/* --- GRAFICO --- */



//ESTAS LINEAS SON PARA IMPRIMIR LA IMAGEN
$html = $_POST["algo"];
$aqui=$pdf->Gety();
//if($aqui>=257){

if($aqui>=165){

$pdf->AddPage();
//$pdf->AddPage('LANDSCAPE', 'A4');
if($html!=1){
  $dataURI = $html;

$img = explode(',',$dataURI,2)[1];
$pic = 'data://text/plain;base64,'. $img;
$pdf->image($pic, -20,50,250,0,'png');  
}

}else{
if($html!=1){
$dataURI = $html;
$pdf->setX(50);
$img = explode(',',$dataURI,2)[1];
$pic = 'data://text/plain;base64,'. $img;
$pdf->image($pic, -15,$aqui,250,0,'png'); 
}
}



//----------------------------------------
// "I" -> se entrega al navegador y se activa el plugin para mostrarlo
// "D" -> se fuerza la descarga del archivo
// */
// $modo="I";
// $pdf->Output($nombre_archivo,$modo)

$pdf->Output("Reporte Ferreteria.pdf","I");
?>