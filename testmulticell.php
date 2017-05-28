<?php
	require('../fpdf.php');

	$texte1 = "Article1\nArticle2\nArticle3\nArticle4";
	$texte2 = "Article5\nArticle6\nArticle7\nArticle8";
	$texte3 = "Article9\nArticle10\nArticle11\nArticle12";
	 
	$pdf=new FPDF();
	$pdf->SetFont('Arial','',60);
	$pdf->AddPage();
	$ligne_depart = $pdf->GetY();
	$pdf->MultiCell(60, 60, $texte1);
	$pdf->SetXY(65,$ligne_depart);
	$pdf->MultiCell(60, 60, $texte2);
	$pdf->SetXY(130,$ligne_depart);
	$pdf->MultiCell(60, 60, $texte3);
	$pdf->Ln();
	$pdf->Output();
?>