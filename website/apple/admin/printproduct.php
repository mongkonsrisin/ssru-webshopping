<?php
require('../fpdf/fpdf.php');
require ('../_db.php');
require ('../_cfg.php');
require ('../_func.php');
session_name('store-back');
session_start();
mysqli_query($cnn,'SET NAMES TIS620');
	$sql = "SELECT * FROM tbl_product LEFT JOIN tbl_category ON tbl_product.pro_category=tbl_category.cat_id WHERE pro_status=1";
$result = mysqli_query($cnn,$sql);
$products = mysqli_fetch_all($result,MYSQLI_ASSOC);

class PDF extends FPDF
{


// Page header
function Header()
{
  global $id;
  global $details;
    // Logo
    $this->Image('../assets/img/icon-b.png',100,6,15);
	    $this->Ln(10);
    // Arial bold 15
    $this->SetFont('THSarabunNew Bold','',28);
    // Move to the right
    $this->Cell(97);
    // Title
    $this->Cell(1,10,'Apple',0,1,'C');
	    $this->SetFont('THSarabunNew','',18);

	    $this->Cell(97);
	    $this->Cell(1,10,'1 Infinite Loop Cupertino, CA 95014',0,1,'C');

    // Line break
    $this->Ln(4);
	    $this->Cell(190,0,'',1,1,'C');

		$this->SetFont('THSarabunNew Bold','',20);
    $this->Cell(200,10,'Products List',0,1,'C');
    $this->Ln(8);


	$this->SetFont('THSarabunNew Bold','',20);
	$this->SetFillColor(128,128,128);
	$this->SetTextColor(255,255,255);
	$this->Cell(1);
	$this->Cell(10,12,"#",1,0,'C',TRUE);
	$this->Cell(60,12,"Photo",1,0,'C',TRUE);
		$this->Cell(50,12,"Name",1,0,'C',TRUE);

  $this->Cell(30,12,"Price",1,0,'C',TRUE);
  $this->Cell(15,12,"Q",1,0,'C',TRUE);
  $this->Cell(25,12,"Cat",1,1,'C',TRUE);

}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-12);
    // Arial italic 8
    $this->SetFont('THSarabunNew','',12);
    // Page number
    $this->Cell(0,10,'Print by Admin',0,0,'L');
	$date = date("d M Y");
	    $this->Cell(0,10,$date,0,0,'R');

}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->AddFont('THSarabunNew Bold','','THSarabunNew Bold.php');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('THSarabunNew','',20);
$i = 1;
$image_height = 40;
$image_width = 40;
foreach ($products as $product) {

	$pdf->SetFont('THSarabunNew','',18);
  $pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
  $pdf->Cell(1);
	$pdf->Cell(10,50,$i,1,0,'C',TRUE);

	// get current X and Y
   $start_x = $pdf->GetX();
   $start_y = $pdf->GetY();

   // place image and move cursor to proper place. "+ 5" added for buffer
   $pdf->Image('../assets/img/pro/'.$product['pro_image'], $pdf->GetX()+10, $pdf->GetY()+5, $image_height, $image_width) ;
   $pdf->SetXY($start_x+$image_width, $start_y);
     $pdf->Cell(-40);

	  $pdf->Cell(60,50,'',1);

	$pdf->Cell(50,50,$product['pro_name'],1,0,'C',TRUE);
  $pdf->Cell(30,50,$product['pro_price'].' ß',1,0,'C',TRUE);
  $pdf->Cell(15,50,$product['pro_quantity'],1,0,'C',TRUE);
 
  $pdf->Cell(25,50,$product['cat_name'],1,1,'C',TRUE);
$i++;
}


$pdf->Output();
?>
