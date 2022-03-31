
<?php
//include connection file
include_once("connectdb.php");
include_once('lib/fpdf.php');
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    
    $this->SetFont('msungstdlight','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'Employee List',1,0,'C');
    // Line break
    $this->Ln(20);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
include("connectdb.php");
$sql = "SELECT Empid,EmpName,JobTitle,DeptId,Address,Phone,ZipCode,MonthSalary,AnnualLeave,City FROM employee";

$result =$connect->query($sql);

$display_heading = array('EmpId'=>'ID','EmpName'=>'name','JobTitle'=>'jobtitle','City'=>'City','DeptId'=>'deptid','Address'=>'address','Phone'=>'phone','ZipCode'=>'zipcode','MonthSalary'=>'Salary','AnnualLeave'=>'Leave');
$sql2 = "SHOW columns FROM employee";

$header =$connect->query($sql2);


$pdf = new PDF('P','mm','A4',true,'UTF-8',false);
//header
$pdf->AddPage();

//foter page
$pdf->AliasNbPages();



foreach($header as $heading) {
$pdf->Cell(19,20,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(19,20,$column,1);
}
$pdf->Output();
?>

