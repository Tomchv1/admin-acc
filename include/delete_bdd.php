<?php
include("cnx.php");

$code = $_POST['code'];

	if($code == "07441"){
		$cnx->exec("SET FOREIGN_KEY_CHECKS = 0");
		$cnx->exec("TRUNCATE acc.horaire");
		$cnx->exec("TRUNCATE acc.activites_adherent");
		$cnx->exec("TRUNCATE acc.responsable_adherent");
		$cnx->exec("TRUNCATE acc.jeu_adherent");
		$cnx->exec("TRUNCATE acc.adherent");
		$cnx->exec("TRUNCATE acc.adhesion");
		$cnx->exec("TRUNCATE acc.responsable");
		$cnx->exec("TRUNCATE acc.famille");
		$cnx->exec("TRUNCATE acc.activites");
		$cnx->exec("TRUNCATE acc.annee");
		$cnx->exec("SET FOREIGN_KEY_CHECKS = 1");
		header('Location: ../index.php');
	}

	else{
		header('Location : ../securite.php');
	}

?>