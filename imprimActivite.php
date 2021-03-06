<?php
    session_start();
    require_once("session.php");
    if (!$prenom) die();
	include("liOptions.php");
	include ("gract.inc");
	include ("adherents.inc");
	include("animateurs.inc"); 
	$codact = $_POST['activite'];
	$grou = $_POST['groupe']; 
	$gra = new Gract;
	$gra->codactivite=$codact;
	$gra->groupe = $grou;
	$gra->getid($tact);
	$gra->getgract($tact);
	$resp = new Adherent;
	$resp->id = $gra->idresponsable;
	$resp->getadh($tadh);
	$an = new Animateur;
	$an->id = $gra->idanimateur;
	$an->getani($tani);
	if ($gra->codactivite<10) $req = "%0".strval($gra->codactivite)."-".strval($grou)."%";
	else $req = "%".strval($gra->codactivite)."-".strval($grou)."%";
	$sql = "SELECT * FROM $tadh WHERE activites LIKE '$req' ORDER BY nom";
	$ad = new Adherents;
	$ad->cherche($sql,$tact);

require('../fpdf.php');
	$pdf = new FPDF();
	$pdf->AddPage('P','A4');
	$pdf->SetFont('Times','I',10);
	$pdf->Cell(110,6,utf8_decode('Club des retraités de la MGEN section de Paris'),0,0,'L');
	$pdf->Cell(100,6,utf8_decode('Fiche imprimée le '.strftime("%d %B %Y")),0,1,'C');
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(35,8,"2016-2017",1,1,'C');
	$pdf->Ln(2);
	$n=strlen($gra->activite);$w=$n*5;$d=90-$w/2;
	$pdf->SetFont('Arial','B',18);
	$pdf->Cell($d,8,"",0,0);		
	$pdf->Cell($w,10,utf8_decode(strtoupper($gra->activite)),1,0,'C');
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(30,10,utf8_decode("Groupe ".$grou),0,1,'R');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(140,5,"",0,0);
	$pdf->Cell(60,5,utf8_decode("Jour : ".$gra->jour),0,1,'L');
	$pdf->Cell(140,5,"",0,0);
	$pdf->Cell(60,5,utf8_decode("Heure : ".$gra->debut." - ".$gra->fin),0,1,'L');
	$pdf->Cell(140,5,"",0,0);
	$pdf->Cell(60,5,utf8_decode("Salle : ".$gra->lieu),0,1,'L');
	$pdf->SetFont('Arial','',14);
	$pdf->Cell(30,8,utf8_decode("Professeur : "),0,0,'L');
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(100,8,utf8_decode($an->prenom." ".$an->nom),0,1,'L');
	$pdf->SetFont('Arial','',14);
	$pdf->Cell(60,10,utf8_decode("Responsable du groupe : "),0,0,'L');
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(100,10,$resp->prenomnom,0,1,'L');
	$pdf->SetLineWidth(0.5);
	$pdf->Line(30,70,170,70);
	$pdf->Ln(6);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(60,6,utf8_decode("Participation financière :"),0,0,'L');
	$pdf->Cell(30,6,utf8_decode("MUTUALISTE   "),0,0,'L');
	$pdf->Cell(20,6,utf8_decode($gra->tarifA." euros"),0,1,'L');
	$pdf->Cell(60,6,"",0,0,'L');
	$pdf->Cell(30,6,utf8_decode("INVITE       "),0,0,'L');
	$pdf->Cell(20,6,utf8_decode($gra->tarifC." euros"),0,1,'L');
	$pdf->Ln(6);
	$pdf->SetFont('Arial','',6);
	$pdf->Cell(10,8,"",'TLB',0,'C');
	$pdf->Cell(25,8,utf8_decode("N° Club"),'TB',0,'C');
	$pdf->Cell(10,8,"",'TB',0,'C');
	$pdf->Cell(70,8,utf8_decode("NOM   Prénom"),'TB',0,'C');
	$pdf->Cell(35,8,utf8_decode("Téléphone"),'TB',0,'C');
	$pdf->Cell(20,8,utf8_decode("Somme"),'TB',0,'C');
	$pdf->Cell(10,8,"",'TRB',1,'C');
	$pdf->SetFont('Arial','',11);
	$h=6;
	$pdf->SetLineWidth(0.2);
	for ($i=0;$i<$ad->n;$i++) {
		$pdf->SetFont('Arial','',6);	
		$pdf->Cell(10,$h,strval($i+1),1,0,'C');
		$pdf->SetFont('Arial','',9);	
		$pdf->Cell(25,$h,utf8_decode($ad->adh[$i]->numMGEN),1,0,'C');
		$pdf->Cell(10,$h,utf8_decode($ad->adh[$i]->qualite),1,0,'C');
		$nomprenom = $ad->adh[$i]->nom." ".$ad->adh[$i]->prenom;
		$noanim = (!(($ad->adh[$i]->nom == $an->nom)&&($ad->adh[$i]->prenom == $an->prenom)));
		$pdf->Cell(70,$h,utf8_decode($nomprenom),1,0,'L');
		$pdf->Cell(35,$h,utf8_decode($ad->adh[$i]->telephone),1,0,'L');
		if ((strstr($ad->adh[$i]->activites,$reqP))&&($noanim)) {
			if ($ad->adh[$i]->qualite == "M") $pdf->Cell(20,$h,utf8_decode($gra->tarifA),1,0,'C');
			else $pdf->Cell(20,$h,utf8_decode($gra->tarifC),1,0,'C');
		 } else $pdf->Cell(20,$h,utf8_decode(""),1,0,'C');
		$pdf->Cell(10,$h,utf8_decode(""),1,1,'C');
	}


	$pdf->Output();

?>	
