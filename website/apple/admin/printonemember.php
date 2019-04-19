<?php
require('../fpdf/fpdf.php');
require ('../_db.php');
require ('../_cfg.php');
require ('../_func.php');
session_name('store-back');
session_start();
mysqli_query($cnn,'SET NAMES TIS620');
	$sql = "SELECT * FROM tbl_member WHERE mem_status=1 AND mem_id=".$_GET['id'];
$result = mysqli_query($cnn,$sql);
$users = mysqli_fetch_all($result,MYSQLI_ASSOC);

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
    $this->Cell(200,10,'Members List',0,1,'C');
    $this->Ln(8);


	$this->SetFont('THSarabunNew Bold','',20);
	$this->SetFillColor(128,128,128);
	$this->SetTextColor(255,255,255);
	$this->Cell(1);
	$this->Cell(10,12,"#",1,0,'C',TRUE);
	$this->Cell(25,12,"Photo",1,0,'C',TRUE);
		$this->Cell(50,12,"Full name",1,0,'C',TRUE);

  $this->Cell(50,12,"E-mail",1,0,'C',TRUE);
  $this->Cell(30,12,"Phone",1,0,'C',TRUE);
  $this->Cell(30,12,"Username",1,1,'C',TRUE);

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
$image_height = 20;
$image_width = 20;
foreach ($users as $user) {

	$pdf->SetFont('THSarabunNew','',18);
  $pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
  $pdf->Cell(1);
	$pdf->Cell(10,30,$i,1,0,'C',TRUE);

	// get current X and Y
   $start_x = $pdf->GetX();
   $start_y = $pdf->GetY();

   // place image and move cursor to proper place. "+ 5" added for buffer
   $pdf->Image('../assets/img/mem/'.$user['mem_photo'], $pdf->GetX()+3, $pdf->GetY()+3, $image_height, $image_width) ;
   $pdf->SetXY($start_x+$image_width, $start_y);
     $pdf->Cell(-20);

	  $pdf->Cell(25,30,'',1);

	$pdf->Cell(50,30,$user['mem_fullname'],1,0,'C',TRUE);
  $pdf->Cell(50,30,$user['mem_email'],1,0,'C',TRUE);
  $pdf->Cell(30,30,$user['mem_phone'],1,0,'C',TRUE);

  $pdf->Cell(30,30,$user['mem_username'],1,1,'C',TRUE);
$i++;
}


$pdf->Output();
?>
