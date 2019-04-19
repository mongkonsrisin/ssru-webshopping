<?php
require('../fpdf/fpdf.php');
require ('../_db.php');
require ('../_cfg.php');
require ('../_func.php');
session_name('store-back');
session_start();
mysqli_query($cnn,'SET NAMES TIS620');


class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;

function Header()
{
 
    // Logo
    $this->Image('../assets/img/icon-b.png',145,6,15);
	    $this->Ln(10);
    // Arial bold 15
    $this->SetFont('THSarabunNew Bold','',28);
    // Move to the right
    $this->Cell(142);
    // Title
    $this->Cell(1,10,'Apple',0,1,'C');
	   $this->SetFont('THSarabunNew','',18);

	    $this->Cell(142);
	    $this->Cell(1,10,'1 Infinite Loop Cupertino, CA 95014',0,1,'C');

    // Line break
    $this->Ln(4);
	    $this->Cell(270,0,'',1,1,'C');

		$this->SetFont('THSarabunNew Bold','',20);
    $this->Cell(280,10,'Feedback List',0,1,'C');
    $this->Ln(8);

	$this->SetFont('THSarabunNew Bold','',20);
	$this->SetFillColor(128,128,128);
	$this->SetTextColor(255,255,255);
	$this->Cell(1);
	$this->Cell(10,12,"#",1,0,'C',TRUE);
		$this->Cell(25,12,"Full name",1,0,'C',TRUE);
		$this->Cell(50,12,"E-mail",1,0,'C',TRUE);

  $this->Cell(120,12,"Content",1,0,'C',TRUE);
  $this->Cell(30,12,"Date",1,0,'C',TRUE);
  $this->Cell(30,12,"Time",1,1,'C',TRUE);


}
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

function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb+5;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
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
}





$pdf=new PDF_MC_Table();

$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->AddFont('THSarabunNew Bold','','THSarabunNew Bold.php');
$pdf->AddPage('L');

$pdf->AliasNbPages();

$pdf->SetFont('THSarabunNew','',18);

$sql = "SELECT * FROM tbl_feedback WHERE feed_status <> 0";
$result = mysqli_query($cnn,$sql);
$feedbacks = mysqli_fetch_all($result,MYSQLI_ASSOC);
//Table with 20 rows and 4 columns
$pdf->SetWidths(array(10,25,50,120,30,30));

foreach ($feedbacks as $feedback) {

		$pdf->Cell(1);

    $pdf->Row(array('1',$feedback['feed_fullname'],$feedback['feed_email'],$feedback['feed_content'],$feedback['feed_date'],$feedback['feed_time']));
}
$pdf->Output();
?>
