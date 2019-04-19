<?php
require('../fpdf/fpdf.php');
require ('../_db.php');
require ('../_cfg.php');
require ('../_func.php');
session_name('store-back');
session_start();

mysqli_query($cnn,'SET NAMES TIS620');
$id = $_GET['id'];
	  $sql = "SELECT * FROM tbl_order  WHERE or_id='$id' LIMIT 1";
      $result = mysqli_query($cnn,$sql);
      $order = mysqli_fetch_all($result,MYSQLI_ASSOC);
      if($order[0]['or_status'] == 1 || $order[0]['or_status'] == 2) {
        header('location:404.php');
        exit;
}

class PDF extends FPDF
{


// Page header
function Header()
{

  global $order;
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
    $this->Cell(200,10,'Receipt',0,1,'C');
    $this->Ln(8);
	$this->Cell(1);
	    $this->SetFont('THSarabunNew Bold','',36);

		$this->Cell(190,12,"Order ID : " . $order[0]['or_id'],0,1,'R');
	    $this->SetFont('THSarabunNew Bold','',18);

	$this->Cell(10,12,"Customer Name : " . $order[0]['or_receivename'],0,1,'L');
	$this->Multicell(180,12,"Customer Address : " . $order[0]['or_receiveaddress'],0,'L');
    $this->Ln(8);

	$this->SetFont('THSarabunNew Bold','',20);
	$this->SetFillColor(0,0,0);
	$this->SetTextColor(255,255,255);
	$this->Cell(1);
	$this->Cell(15,12,"#",1,0,'C',TRUE);
	$this->Cell(90,12,"Item",1,0,'C',TRUE);
		$this->Cell(25,12,"Price",1,0,'C',TRUE);

  $this->Cell(25,12,"Quantity",1,0,'C',TRUE);
  $this->Cell(25,12,"Net",1,1,'C',TRUE);

}

// Page footer
function Footer()
{
	  global $user;

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
$total = 0;
$net = 0;
$sql = "SELECT * FROM tbl_order_detail LEFT JOIN tbl_product ON tbl_order_detail.detail_product = tbl_product.pro_id
                LEFT JOIN tbl_order ON tbl_order_detail.detail_order=tbl_order.or_id
                LEFT JOIN tbl_member ON tbl_order.or_member=tbl_member.mem_id
                WHERE detail_order='$id'";
                $result = mysqli_query($cnn,$sql);
                $details = mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach ($details as $detail) {
        $total=  $detail['detail_amount'] * $detail['pro_price'];

	$pdf->SetFont('THSarabunNew','',18);
  $pdf->SetFillColor(255,255,255);

	$pdf->SetTextColor(0,0,0);
  $pdf->Cell(1);
	$pdf->Cell(15,12,$i,1,0,'C',TRUE);



	$pdf->Cell(90,12,$detail['pro_name'],1,0,'L',TRUE);
  $pdf->Cell(25,12,$detail['pro_price'].' ',1,0,'C',TRUE);
  $pdf->Cell(25,12,$detail['detail_amount'],1,0,'C',TRUE);
   $pdf->Cell(25,12,$detail['detail_amount'],1,1,'C',TRUE);
$net = $net + $total;
$i++;
}
  $pdf->Cell(1);


	    $pdf->SetFont('THSarabunNew Bold','',20);

   $pdf->Cell(180,12,'Total : ' . $total . ' ',1,1,'R',TRUE);
   $pdf->Image('../assets/img/paid.png', 15, 125, 180) ;


$pdf->Output();
?>
