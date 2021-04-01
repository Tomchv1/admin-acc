<?php
require_once("cnx.php");

 if(isset($_GET['code'])){
    $idAdh = $_GET['code'];
  }
  else{
    $idAdh = "";
  }


require('../fpdf/fpdf.php');


$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',13);
$pdf->MultiCell(0,5, utf8_decode("FICHE D'INSCRIPTION ACC ÉLÉCTRONIQUE"),0,'C');
$pdf->MultiCell(0,5, utf8_decode(""),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,3, utf8_decode('Dossier traité par : _____________________'),0,'L');
//$pdf->MultiCell(0,3, utf8_decode('Date : ____/____/________'),0,'R');
date_default_timezone_set('Europe/Paris');
$date = date('d-m-y');
$pdf->MultiCell(0,5, utf8_decode('Date : '.$date),0,'R');


$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,3, utf8_decode('RESPONSABLE FAMILLE'),0,'L');
$pdf->MultiCell(0,5, utf8_decode(""),0,'L');


$reqIdResp = $cnx->query("SELECT responsable_id FROM responsable_adherent WHERE adherent_id = '$idAdh'");

$i = 1;
while($rIdResp = $reqIdResp->fetch())
	{
		$idResp = $rIdResp['responsable_id'];
		$reqResp = $cnx->query("SELECT * FROM responsable WHERE id = '$idResp'");
		$resp = $reqResp->fetch();
		$pdf->SetFont('Arial','',10);

		if($i == 1 OR $i == 3){
			$pdf->MultiCell(0,5, utf8_decode("Nom : ".$resp['nom']),0,'L');
			$pdf->MultiCell(0,5, utf8_decode("Prénom : ".$resp['prenom']),0,'L');
			$pdf->MultiCell(0,5, utf8_decode("Téléphone : ".$resp['telephone']),0,'L');
			$pdf->MultiCell(0,5, utf8_decode("Portable : ".$resp['portable']),0,'L');
			$pdf->MultiCell(0,5, utf8_decode("Mail : ".$resp['mail']),0,'L');
			$pdf->MultiCell(0,5, utf8_decode("Adresse : ".$resp['adresse']." - ".$resp['ville']." ".$resp['cp']),0,'L');
			$pdf->MultiCell(0,5, utf8_decode(""),0,'L');
		}

		else if($i == 2 OR $i == 4){
			$pdf->MultiCell(0,-35, utf8_decode(""),0,'R');
			$pdf->MultiCell(0,5, utf8_decode("Nom : ".$resp['nom']),0,'R');
			$pdf->MultiCell(0,5, utf8_decode("Prénom : ".$resp['prenom']),0,'R');
			$pdf->MultiCell(0,5, utf8_decode("Téléphone : ".$resp['telephone']),0,'R');
			$pdf->MultiCell(0,5, utf8_decode("Portable : ".$resp['portable']),0,'R');
			$pdf->MultiCell(0,5, utf8_decode("Mail : ".$resp['mail']),0,'R');
			$pdf->MultiCell(0,5, utf8_decode("Adresse : ".$resp['adresse']." - ".$resp['ville']." ".$resp['cp']),0,'R');
			$pdf->MultiCell(0,5, utf8_decode(""),0,'R');
		}
		$i = $i+1;
	}

$pdf->MultiCell(0,5, utf8_decode(""),0,'L');
$pdf->SetFont('Arial','B',13);
$pdf->MultiCell(0,5, utf8_decode("INSCRIPTION DE"),0,'L');
$pdf->MultiCell(0,5, utf8_decode(""),0,'L');
$pdf->SetFont('Arial','',10);

$reqAdh = $cnx->query("SELECT * FROM adherent WHERE id = '$idAdh'");
$adh = $reqAdh->fetch();

$reqIdAct = $cnx->query("SELECT activites_id FROM activites_adherent WHERE adherent_id = '$idAdh'");

while($rIdAct = $reqIdAct->fetch())
	{
		$idAct = $rIdAct['activites_id'];
		$reqAct = $cnx->query("SELECT * FROM activites WHERE id = '$idAct'");
		$act = $reqAct->fetch();
		$pdf->MultiCell(0,5, utf8_decode($adh['nom']." ".$adh['prenom']." né(e) le ".$adh['date_naissance']." pour l'activité ". $act['libelle']),0,'L');
	}

$pdf->MultiCell(0,5, utf8_decode("_____________________________________________________________________________________________"),0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,5, utf8_decode("Certificat médical (validité 3 ans à compter de la rentrée de septembre) (pour arts du cirque, danses sauf éveil)."),0,'C');

$pdf->SetFont('Arial','',5);
$pdf->MultiCell(0,2, utf8_decode("Cet établissement dispose d'un système informatique destiné à faciliter la gestion des inscriptions et à en assurer leur facturation. Les informations qui vous sont demandées feront l'objet, sauf opposition justifiée de votre part, d'un enregistrement informatique. Article 26, 27, 34 et 36 de la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés."),0,'C');

$pdf->MultiCell(0,5, utf8_decode(""),0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,5, utf8_decode("Assurance individuelle de l'adhérent :        o    OUI             o     NON"),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5, utf8_decode("-> Dans la négativité, compte tenu de la nature des activités pratiquées, nous attirons votre attention sur l'intérêt à souscrire un contrat d'assurance garantissant les risques personnels de l'adhérent ; ces risques étant exclus des garanties de notre contrat d'assurance en responsabilité civile permettant d'indemniser les tiers victimes d'un dommage corporel ou matériel et résultant d'une faute qui engage la responsabilité de notre association et de son personnel.

-> Je reconnais avoir pris connaissance du règlement intérieur affiché au siège de l'association.

-> J'accepte que les photographies me représentant ou représentant mes enfants, réalisées par l'ACC au cours des spectacles puissent être utilisées sur toute sorte d'imprimés et sur le site internet de l'ACC pour une période définie."),0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,5, utf8_decode("En cas d'accord, cocher cette case : O"),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,10, utf8_decode(""),0,'L');
$pdf->MultiCell(0,5, utf8_decode("Signature : __________________________________"),0,'L');
$pdf->SetFont('Arial','B',20);
$pdf->MultiCell(0,10, utf8_decode("_______________________________________________"),0,'C');

$pdf->SetFont('Arial','B',13);
$pdf->MultiCell(0,5, utf8_decode("PAIEMENT - CADRE RÉSERVÉ À L'ACC"),0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,3, utf8_decode('Adhésion : '),0,'L');

$idAdhesion = $adh['adhesion_id'];
$reqAdhesion = $cnx->query("SELECT * FROM adhesion WHERE id = '$idAdhesion'");
$adhesion = $reqAdhesion->fetch();

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5, utf8_decode("Banque : ".$adhesion['banque']),0,'L');
$pdf->MultiCell(0,-5, utf8_decode("Montant total : ".$adhesion['montant_total']." euros"),0,'R');


$pdf->MultiCell(0,5, utf8_decode(""),0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,5, utf8_decode(""),0,'L');
$pdf->MultiCell(0,5, utf8_decode('Méthode(s) de paiement : '),0,'L');
$pdf->SetFont('Arial','',10);

	if($adhesion['montant_cb'] > 0){
		$pdf->MultiCell(0,5, utf8_decode("Montant carte bancaire : ".$adhesion['montant_cb']." euros"),0,'L');
	}

	if($adhesion['montant_sepa'] > 0){
		$pdf->MultiCell(0,5, utf8_decode("Montant prélévement SEPA : ".$adhesion['montant_sepa']." euros"),0,'L');
	}

	if($adhesion['montant_ancv'] > 0){
		$pdf->MultiCell(0,5, utf8_decode("Montant ANCV : ".$adhesion['montant_ancv']." euros"),0,'L');
	}

	if($adhesion['montant_can'] > 0){
		$pdf->MultiCell(0,5, utf8_decode("Montant Carte Atout Normandie : ".$adhesion['montant_can']." euros"),0,'L');
	}

	if($adhesion['montant_cheque'] > 0){	
		$pdf->MultiCell(0,5, utf8_decode("Montant chèque : ".$adhesion['montant_cheque']." euros"),0,'L');
	}

	if($adhesion['montant_espece'] > 0){
		$pdf->MultiCell(0,5, utf8_decode("Montant espèces : ".$adhesion['montant_espece']." euros"),0,'L');
	}

$pdf->MultiCell(0,5, utf8_decode("Commentaire : ".$adhesion['commentaire']),0,'L');

$date = date('d-m-y');
$heure = date('h:i:s');
$pdf->SetFont('Arial','',7);
$pdf->MultiCell(0,5, utf8_decode("Cette fiche d'inscription à été éditée automatiquement le " .$date. " à " .$heure),0,'R');



$pdf->Output("Fiche_inscription-".$date."-".$adh['nom']."_".$adh['prenom'].".pdf",'I')
?>