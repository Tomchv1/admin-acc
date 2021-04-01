<?php
require_once("cnx.php");

$idResp = $_POST['idResp'];
$ville = $_POST['ville'];
$cotisation = $_POST['cotisation'];

  	$annee = addslashes($_POST['annee']);

	$QueryIdAnnee = $cnx->query("SELECT * FROM annee WHERE libelle LIKE '$annee'");
	$rIdAnnee = $QueryIdAnnee->fetch();
	$idAnnee = $rIdAnnee['id'];

require('../fpdf/fpdf.php');


$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->setFillColor(206,206,206);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,5, utf8_decode("ASSOCIATION CULTURELLE DE COURSEULLES"),0,'L');
$pdf->SetFont('Arial','',9.5);
$pdf->MultiCell(0,5, utf8_decode("2 Rue Arthur Leduc"),0,'L');
$pdf->MultiCell(0,5, utf8_decode("14470 COURSEULLES-SUR-MER"),0,'L');
$pdf->MultiCell(0,5, utf8_decode("Portable : +33 6 42 23 79 35"),0,'L');
$pdf->MultiCell(0,5, utf8_decode("accourseulles@gmail.com"),0,'L');
$pdf->MultiCell(0,5, utf8_decode("N° SIRET : 41539875900019"),0,'L');
$pdf->MultiCell(0,5, utf8_decode("Agrément Jeunesse Education Populaire N° 14 18 345 EP"),0,'L');

$pdf->MultiCell(0,-15, utf8_decode(""),0,'L');


$reqResp = $cnx->query("SELECT * FROM responsable WHERE id = '$idResp' ");
$resp = $reqResp->fetch();
	


		
$pdf->SetFont('Arial','',9.5);
$pdf->MultiCell(0,5, utf8_decode($resp['nom']. " " .$resp['prenom']),0,'R');
$pdf->MultiCell(0,5, utf8_decode($resp['adresse']),0,'R');
$pdf->MultiCell(0,5, utf8_decode($resp['ville']. " " .$resp['cp']),0,'R');
$pdf->MultiCell(0,15, utf8_decode(""),0,'R');
		


$facture = date('y-m');
$pdf->MultiCell(0,5, utf8_decode(""),0,'L');
$pdf->SetFont('Arial','B',13);
$pdf->MultiCell(0,5, utf8_decode("FACTURE N°".$facture."-".$idResp),0,'L');

$pdf->MultiCell(0,5, utf8_decode(""),0,'R');


setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
$date = strftime("%d/%m/%Y");

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5, utf8_decode("Le ".$date),0,'L');
$pdf->MultiCell(0,5, utf8_decode(""),0,'R');


$reqAdh = $cnx->query("SELECT adherent.id FROM adhesion, adherent, responsable_adherent, responsable WHERE adhesion.id = adherent.adhesion_id AND adherent.id = responsable_adherent.adherent_id AND responsable_adherent.responsable_id = responsable.id AND responsable_adherent.responsable_id = '$idResp' AND adhesion.annee_id = '$idAnnee'");
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,5, utf8_decode("Référence"),0,'L',1,TRUE);
$pdf->Cell(90,5, utf8_decode("Désignation"),0,'L',1,TRUE);
$pdf->Cell(20,5, utf8_decode("Quantité"),0,'L',1,TRUE);
$pdf->Cell(20,5, utf8_decode("PU Vente"),0,'L',1,TRUE);
$pdf->Cell(30,5, utf8_decode("Montant HT"),0,'L',1,TRUE);
$pdf->MultiCell(0,5, utf8_decode(""),0,'R');
$pdf->SetFont('Arial','',10);

$pdf->setFillColor(244,244,244);
$pdf->Cell(30,5, utf8_decode("ADH"),0,'L',1,TRUE);
$pdf->Cell(90,5, utf8_decode("Adhésion ".$annee),0,'L',1,TRUE);
$pdf->Cell(20,5, utf8_decode("1,00"),0,'L',1,TRUE);
$pdf->Cell(20,5, utf8_decode(number_format($cotisation, 2, ',', ' ')."e"),0,'L',1,TRUE);
$pdf->Cell(20,5, utf8_decode(number_format($cotisation, 2, ',', ' ')."e"),0,'L',1,TRUE);
$pdf->MultiCell(0,5, utf8_decode(""),0,'L',TRUE);


$Total = $cotisation;

while($Adh = $reqAdh->fetch())
{
	$idAdh = $Adh['id'];
	$ReqAct = $cnx->query("SELECT activites.id, activites.libelle, activites.tarif_cours, activites.tarif_hors_cours FROM activites, activites_adherent WHERE activites.id = activites_adherent.activites_id AND activites_adherent.adherent_id = '$idAdh'");
	while($Act = $ReqAct->fetch())
	{
		$libelle = mb_strtoupper($Act['libelle']);
		$libelle = substr($libelle,0,3);

		if($ville == "Oui"){
			$pdf->Cell(30,5, utf8_decode($libelle."".$Act['id']."-CO"),0,'L',1,TRUE);
		}
		else if($ville == "Non"){
			$pdf->Cell(30,5, utf8_decode($libelle."".$Act['id']."-HCO"),0,'L',1,TRUE);
		}

		$pdf->Cell(90,5, utf8_decode("Activité : ".$Act['libelle']),0,'L',1,TRUE);
		$pdf->Cell(20,5, utf8_decode("1,00"),0,'L',1,TRUE);

		if($ville == "Oui"){
			$pdf->Cell(20,5, utf8_decode(number_format($Act['tarif_cours'], 2, ',', ' ')."e"),0,'L',1,TRUE);
			$pdf->Cell(20,5, utf8_decode(number_format($Act['tarif_cours'], 2, ',', ' ')."e"),0,'L',1,TRUE);
			$pdf->MultiCell(0,5, utf8_decode(""),0,'L',TRUE);
				$Total = $Act['tarif_cours'] + $Total;
		}
		else if($ville == "Non"){
			$pdf->Cell(20,5, utf8_decode(number_format($Act['tarif_hors_cours'], 2, ',', ' ')."e"),0,'L',1,TRUE);
			$pdf->Cell(20,5, utf8_decode(number_format($Act['tarif_hors_cours'], 2, ',', ' ')."e"),0,'L',1,TRUE);
			$pdf->MultiCell(0,5, utf8_decode(""),0,'L',TRUE);
				$Total = $Act['tarif_hors_cours'] + $Total;
		}
	}
}


$pdf->setFillColor(206,206,206);
	if($ville == "Oui")
	{
		$pdf->MultiCell(0,25, utf8_decode(""),0,'R');
		$pdf->Cell(120,5, utf8_decode(""),0,'R');
		$pdf->Cell(40,5, utf8_decode("Total HT"),0,'R',1,TRUE);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(30,5, utf8_decode(number_format($Total, 2, ',', ' ')."e"),0,'R',1,TRUE);

		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(0,5, utf8_decode(""),0,'R');
		$pdf->Cell(120,5, utf8_decode(""),0,'R');
		$pdf->Cell(40,5, utf8_decode("TVA (0%)"),0,'R',1,TRUE);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(30,5, utf8_decode("0,00e"),0,'R',1,TRUE);

		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(0,5, utf8_decode(""),0,'R');
		$pdf->Cell(120,5, utf8_decode(""),0,'R');
		$pdf->Cell(40,5, utf8_decode("Total TTC"),0,'R',1,TRUE);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(30,5, utf8_decode(number_format($Total, 2, ',', ' ')."e"),0,'R',1,TRUE);
		$pdf->SetFont('Arial','I',7);
		$pdf->MultiCell(0,8, utf8_decode(""),0,'R');
		$pdf->MultiCell(0,5, utf8_decode("TVA non applicable, art. 239B du CGI                             "),0,'R');
	}

	else if($ville == "Non")
	{
		$pdf->MultiCell(0,25, utf8_decode(""),0,'R');
		$pdf->Cell(120,5, utf8_decode(""),0,'R');
		$pdf->Cell(40,5, utf8_decode("Total HT"),0,'R',1,TRUE);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(30,5, utf8_decode(number_format($Total, 2, ',', ' ')."e"),0,'R',1,TRUE);

		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(0,5, utf8_decode(""),0,'R');
		$pdf->Cell(120,5, utf8_decode(""),0,'R');
		$pdf->Cell(40,5, utf8_decode("TVA (0%)"),0,'R',1,TRUE);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(30,5, utf8_decode("0,00e"),0,'R',1,TRUE);

		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(0,5, utf8_decode(""),0,'R');
		$pdf->Cell(120,5, utf8_decode(""),0,'R');
		$pdf->Cell(40,5, utf8_decode("Total TTC"),0,'R',1,TRUE);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(30,5, utf8_decode(number_format($Total, 2, ',', ' ')."e"),0,'R',1,TRUE);
		$pdf->SetFont('Arial','I',7);
		$pdf->MultiCell(0,8, utf8_decode(""),0,'R');
		$pdf->MultiCell(0,5, utf8_decode("TVA non applicable, art. 239B du CGI                             "),0,'R');
	}


$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,5, utf8_decode("Conditions de paiement : "),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5, utf8_decode(""),0,'R');

$reqAdherent = $cnx->query("SELECT adherent.id FROM adhesion, adherent, responsable_adherent, responsable WHERE adhesion.id = adherent.adhesion_id AND adherent.id = responsable_adherent.adherent_id AND responsable_adherent.responsable_id = responsable.id AND responsable_adherent.responsable_id = '$idResp' AND adhesion.annee_id = '$idAnnee'");


	while($adherent = $reqAdherent->fetch())
	{
		$idAdherent = $adherent['id'];
		$reqPaiement = $cnx->query("SELECT adhesion.* FROM adhesion, adherent WHERE adherent.adhesion_id = adhesion.id AND adherent.id = '$idAdherent' AND annee_id = '$idAnnee'");
		$paiement = $reqPaiement->fetch();
	
		if($paiement['montant_cb'] > 0){
			$pdf->MultiCell(0,5, utf8_decode($paiement['montant_cb']." euros payé (carte bancaire)"),0,'L');
		}

		if($paiement['montant_sepa'] > 0){
			$pdf->MultiCell(0,5, utf8_decode($paiement['montant_sepa']." euros payé (SEPA)"),0,'L');
		}

		if($paiement['montant_ancv'] > 0){
			$pdf->MultiCell(0,5, utf8_decode($paiement['montant_ancv']." euros payé (ANCV)"),0,'L');
		}

		if($paiement['montant_can'] > 0){
			$pdf->MultiCell(0,5, utf8_decode($paiement['montant_can']." euros payé (carte Atout Normandie)"),0,'L');
		}

		if($paiement['montant_cheque'] > 0){	
			$pdf->MultiCell(0,5, utf8_decode($paiement['montant_cheque']." euros payé (chèques)"),0,'L');
		}

		if($paiement['montant_espece'] > 0){
			$pdf->MultiCell(0,5, utf8_decode($paiement['montant_espece']." euros payé (espéces)"),0,'L');
		}
	}


$pdf->Output("Facture-".$annee."-".$resp['nom']."_".$resp['prenom'].".pdf",'I')
?>