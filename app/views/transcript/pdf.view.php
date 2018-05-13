<?php 
use PHPMVC\Lib\FPDF;
use PHPMVC\Lib\PDF_Rotate;

$pdf = new PDF_Rotate('P', 'mm', 'A4');

$pdf->AddPage();
$pdf->SetFont('Arial','B',50);
$pdf->SetTextColor(245, 203, 167);

$pdf->Rotate(45,35,190);
$pdf->Text(35,190,'N e f e r t a r i   S c h o o l');
$pdf->Rotate(0);

$pdf->SetTextColor(0,0,0);

if(!empty($transcript)){
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(20, 10, 'Name: ', 0, 0);
    $pdf->Cell(60,10, $transcript[0][0]->student->fname .' '. $transcript[0][0]->student->lname , 0,1); 

    $pdf->SetFont('Arial', 'B', 12);

    foreach($transcript as $transSem){
        $pdf->Cell(100,10, $transSem[0]->semester->season_name .' - '. $transSem[0]->semester->year , 0,1);
        $pdf->Cell(63 ,10, 'Course', 1, 0);
        $pdf->Cell(63 ,10, 'Grade', 1, 0); 
        $pdf->Cell(63 ,10, 'Outof', 1, 1); 
        
        $pdf->setFillColor(230,230,230);
        //$pdf->SetAlpha(0.5); 
        $pdf->SetFont('Arial', '', 12);
        
        $grade = 0;
        $total = 0;

        foreach($transSem as $t){
            $grade += $t->NumericGrade;
            $total += $t->OutOfGrade;

            $pdf->Cell(63 ,10, $t->course->course_code, 1, 0, 'C',1);
            $pdf->Cell(63 ,10, $t->NumericGrade, 1, 0, 'C',1); 
            $pdf->Cell(63 ,10, $t->OutOfGrade, 1, 1, 'C', 1); 
        }
        $percentage = ($grade/$total)*100;
        $percentage = "Percentage: ". $percentage . "%";
        $pdf->Cell(189,10, $percentage, 1, 1, 'C', 1);
    }
}

$pdf->Output();
?>