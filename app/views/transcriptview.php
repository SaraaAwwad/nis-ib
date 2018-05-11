<?php
namespace PHPMVC\Views;
require_once("C:\\xampp\\htdocs\\nis-ib\public\\fpdf\\fpdf.php");

//A4 width: 219 mm
//default margin: 10 mm each side 
//writable horizontal: 189 mm
class transcriptView{

    public function pdf(){

        //portrait/landscape, size, page
        $pdf = new FPDF('P', 'mm', 'A4');

        $pdf->AddPage();
        
        $pdf->SetFont('Arial', 'B', 14);
        
        //cell(width in mm, height, text content, border (0 or 1), endline(0 continue or 1 new line), align(l,c,r optional))
        
        $pdf->Cell(130 ,5, '', 1, 0);
        $pdf->Cell(59 ,5, '', 1, 1); //end of line
        
        $pdf->Output('I');
    }

}


?>
