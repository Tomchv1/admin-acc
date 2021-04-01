<!DOCTYPE html>
<html>
<head>
	<title>Statistique</title>
  <?php require_once("include/menu.php");
  	include("include/cnx.php");
	$annee = addslashes($_POST['annee']);

	$QueryIdAnnee = $cnx->query("SELECT * FROM annee WHERE libelle LIKE '$annee'");
	$rIdAnnee = $QueryIdAnnee->fetch();
	$idAnnee = $rIdAnnee['id'];

	$QuerySumGenreFeminin = $cnx->query("SELECT COUNT(genre) as Féminin FROM adherent, adhesion WHERE adherent.adhesion_id = adhesion.id AND annee_id = '$idAnnee' AND genre LIKE 'Féminin'");
	$rGenreFeminin = $QuerySumGenreFeminin->fetch();
	$genreFeminin = $rGenreFeminin['Féminin'];

	$QuerySumGenreMasculin = $cnx->query("SELECT COUNT(genre) as Masculin FROM adherent, adhesion WHERE adherent.adhesion_id = adhesion.id AND annee_id = '$idAnnee' AND genre LIKE 'Masculin'");
	$rGenreMasculin = $QuerySumGenreMasculin->fetch();
	$genreMasculin = $rGenreMasculin['Masculin'];

	$QuerySumGenreAutre = $cnx->query("SELECT COUNT(genre) as Autre FROM adherent, adhesion WHERE adherent.adhesion_id = adhesion.id AND annee_id = '$idAnnee' AND genre LIKE 'Autre'");
	$rGenreAutre = $QuerySumGenreAutre->fetch();
	$genreAutre = $rGenreAutre['Autre'];

	$QuerySumGenre = $cnx->query("SELECT COUNT(genre) as genre FROM adherent, adhesion WHERE adherent.adhesion_id = adhesion.id AND annee_id = '$idAnnee'");
	$rGenre = $QuerySumGenre->fetch();
	$genre = $rGenre['genre'];

	$avgFeminin = $genreFeminin / $genre;
	$avgFeminin = $avgFeminin * 100;

	$avgMasculin = $genreMasculin / $genre;
	$avgMasculin = $avgMasculin * 100;

	$avgAutre = $genreAutre / $genre;
	$avgAutre = $avgAutre * 100;


	$QueryNbAdherentAnnee = $cnx->query("SELECT annee.libelle, COUNT(adhesion.annee_id) as nbAdh FROM adhesion, annee WHERE annee.id = adhesion.annee_id GROUP BY annee_id");

	$QueryNbAdherentTotal = $cnx->query("SELECT COUNT(adhesion.annee_id) as nbAdhTotal FROM adhesion, annee WHERE annee.id = adhesion.annee_id");
	$rNbAdherentTotal = $QueryNbAdherentTotal->fetch();
	$nbAdhTotal = $rNbAdherentTotal['nbAdhTotal'];

	$QueryVille = $cnx->query("SELECT DISTINCT(ville) FROM responsable, responsable_adherent, adherent, adhesion WHERE responsable.id = responsable_adherent.responsable_id AND responsable_adherent.adherent_id = adherent.id AND adherent.adhesion_id = adhesion.id AND adhesion.annee_id = '$idAnnee' ORDER BY ville");

	$QueryVilleTotal = $cnx->query("SELECT COUNT(DISTINCT responsable_adherent.adherent_id) as nbVilleTotal FROM adherent, responsable_adherent, responsable, adhesion WHERE adherent.id = responsable_adherent.adherent_id AND responsable_adherent.responsable_id = responsable.id AND adherent.adhesion_id = adhesion.id AND adhesion.annee_id = '$idAnnee'");
		$rVilleTotal = $QueryVilleTotal->fetch();
		$villeTotal = $rVilleTotal['nbVilleTotal'];

	$QueryVilleTotal2 = $cnx->query("SELECT COUNT(responsable_adherent.adherent_id) as nbVilleTotal FROM adherent, responsable_adherent, responsable, adhesion WHERE adherent.id = responsable_adherent.adherent_id AND responsable_adherent.responsable_id = responsable.id AND adherent.adhesion_id = adhesion.id AND adhesion.annee_id = '$idAnnee'");
		$rVilleTotal2 = $QueryVilleTotal2->fetch();
		$villeTotal2 = $rVilleTotal2['nbVilleTotal'];


?>
	<meta charset="utf-8"> 
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css">
</head>
<body><br>
<div class="container">
<h5>Statistiques pour l'année <?php echo $annee; ?></h5><br><br>
<a href="javascript:window.print()" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M37.84,6.88v44.72h-20.64c-5.6587,0 -10.32,4.6613 -10.32,10.32v61.92c0,5.6587 4.6613,10.32 10.32,10.32h20.64v30.96h96.32v-30.96h20.64c5.6587,0 10.32,-4.6613 10.32,-10.32v-61.92c0,-5.6587 -4.6613,-10.32 -10.32,-10.32h-20.64v-44.72zM44.72,13.76h82.56v37.84h-82.56zM17.2,58.48h23.50219c0.37149,0.0614 0.75054,0.0614 1.12203,0h88.31797c0.37149,0.0614 0.75054,0.0614 1.12203,0h23.53578c1.9437,0 3.44,1.4963 3.44,3.44v61.92c0,1.9437 -1.4963,3.44 -3.44,3.44h-20.64v-30.96h-3.44h-92.88v30.96h-20.64c-1.9437,0 -3.44,-1.4963 -3.44,-3.44v-61.92c0,-1.9437 1.4963,-3.44 3.44,-3.44zM141.04,68.8c-3.79972,0 -6.88,3.08028 -6.88,6.88c0,3.79972 3.08028,6.88 6.88,6.88c3.79972,0 6.88,-3.08028 6.88,-6.88c0,-3.79972 -3.08028,-6.88 -6.88,-6.88zM44.72,103.2h82.56v26.94219c-0.0614,0.37149 -0.0614,0.75054 0,1.12203v26.97578h-82.56v-26.94219c0.0614,-0.37149 0.0614,-0.75054 0,-1.12203zM58.48,113.52c-1.24059,-0.01754 -2.39452,0.63425 -3.01993,1.7058c-0.62541,1.07155 -0.62541,2.39684 0,3.46839c0.62541,1.07155 1.77935,1.72335 3.01993,1.7058h55.04c1.24059,0.01754 2.39452,-0.63425 3.01993,-1.7058c0.62541,-1.07155 0.62541,-2.39684 0,-3.46839c-0.62541,-1.07155 -1.77935,-1.72335 -3.01993,-1.7058zM58.48,127.28c-1.24059,-0.01754 -2.39452,0.63425 -3.01993,1.7058c-0.62541,1.07155 -0.62541,2.39684 0,3.46839c0.62541,1.07155 1.77935,1.72335 3.01993,1.7058h41.28c1.24059,0.01754 2.39452,-0.63425 3.01993,-1.7058c0.62541,-1.07155 0.62541,-2.39684 0,-3.46839c-0.62541,-1.07155 -1.77935,-1.72335 -3.01993,-1.7058zM58.48,141.04c-1.24059,-0.01754 -2.39452,0.63425 -3.01993,1.7058c-0.62541,1.07155 -0.62541,2.39684 0,3.46839c0.62541,1.07155 1.77935,1.72335 3.01993,1.7058h55.04c1.24059,0.01754 2.39452,-0.63425 3.01993,-1.7058c0.62541,-1.07155 0.62541,-2.39684 0,-3.46839c-0.62541,-1.07155 -1.77935,-1.72335 -3.01993,-1.7058z"></path></g></g></svg></a><br><br>

<h6>Répartition des <?php echo $genre ?> adhérents par genre</h6>

<?php
	echo ("<p align='left'>".$genreFeminin." adhérent(s) féminin(s)</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgFeminin ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgFeminin, 1)."%");
		?>
	</div>
</div><br>


<?php
	echo ("<p align='left'>".$genreMasculin." adhérent(s) masculin(s)</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgMasculin ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgMasculin, 1)."%");
		?>
	</div>
</div><br>


<?php
	echo ("<p align='left'>".$genreAutre." adhérent(s) autre</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgAutre ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgAutre, 1)."%");
		?>
	</div>
</div><br><br><br>


<h6>Répartition des <?php echo $nbAdhTotal; ?> adhérents par années</h6>
<?php
	while ($nbAdh = $QueryNbAdherentAnnee->fetch()) {

	$avgAdh = $nbAdh['nbAdh'] / $nbAdhTotal;
	$avgAdh = $avgAdh * 100;

	echo ("<p align='left'>".$nbAdh['nbAdh']." adhérent(s) pour l'année ".$nbAdh['libelle']."</p>");
	?>
	<div class="progress">
		<div class="progress-bar" role="progressbar" style="width: <?php echo $avgAdh ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
			<?php
				echo (round($avgAdh, 1)."%");
			?>
		</div>
	</div><br>
<?php
	}
?>

<br><br><br>
<h6>Répartition des adhérents par tranche d'âge</h6><br>
<?php
	$anneeEnCours = date('Y');

	$ZeroCinq = 0;
	$SixDix = 0;
	$OnzeQuinze = 0;
	$SeizeVingt = 0;
	$VingtunTrente = 0;
	$TrenteunQuarante = 0;
	$QuaranteunCinquante = 0;
	$CinquanteunSoixante = 0;
	$SoixanteunSoixantedix = 0;
	$SoixanteOnzeSoixantedixneuf = 0;
	$QuatrevingPlus = 0;

	$QueryDateNaissance = $cnx->query("SELECT date_naissance FROM adherent, adhesion WHERE adherent.adhesion_id = adhesion.id AND annee_id = '$idAnnee'");

	while ($rDateNaissance = $QueryDateNaissance->fetch()) {
		$dateNaissance = $rDateNaissance['date_naissance'];
		$anneeNaissance = substr($dateNaissance,-4,4);
		$age = $anneeEnCours - $anneeNaissance;

		if($age >= 0 && $age <= 5){
			$ZeroCinq = $ZeroCinq + 1;
		}

		else if($age >= 6 && $age <= 10){
			$SixDix = $SixDix + 1;
		}

		else if($age >= 11 && $age <= 15){
			$OnzeQuinze = $OnzeQuinze + 1;
		}

		else if($age >= 16 && $age <= 20){
			$SeizeVingt = $SeizeVingt + 1;
		}

		else if($age >= 21 && $age <= 30){
			$VingtunTrente = $VingtunTrente + 1;
		}

		else if($age >= 31 && $age <= 40){
			$TrenteunQuarante = $TrenteunQuarante + 1;
		}

		else if($age >= 41 && $age <= 50){
			$QuaranteunCinquante = $QuaranteunCinquante + 1;
		}

		else if($age >= 51 && $age <= 60){
			$CinquanteunSoixante = $CinquanteunSoixante + 1;
		}

		else if($age >= 61 && $age <= 70){
			$SoixanteunSoixantedix = $SoixanteunSoixantedix + 1;
		}

		else if($age >= 71 && $age <= 79){
			$SoixanteOnzeSoixantedixneuf = $SoixanteOnzeSoixantedixneuf + 1;
		}
		else if($age >= 80){
			$QuatrevingPlus = $QuatrevingPlus + 1;
		}
}

	$QueryNbAdh = $cnx->query("SELECT COUNT(adherent.id) as nombreAdherent FROM adherent, adhesion WHERE adherent.adhesion_id = adhesion.id AND annee_id = '$idAnnee' ");
	$rNbAdh = $QueryNbAdh->fetch();
	$nombreAdherent = $rNbAdh['nombreAdherent'];
	$avgZeroCinq = ($ZeroCinq/$nombreAdherent)*100;
	$avgSixDix = ($SixDix/$nombreAdherent)*100;
	$avgOnzeQuinze = ($OnzeQuinze/$nombreAdherent)*100;
	$avgSeizeVingt = ($SeizeVingt/$nombreAdherent)*100;
	$avgVingtunTrente = ($VingtunTrente/$nombreAdherent)*100;
	$avgTrenteunQuarante = ($TrenteunQuarante/$nombreAdherent)*100;
	$avgQuaranteunCinquante = ($QuaranteunCinquante/$nombreAdherent)*100;
	$avgCinquanteunSoixante = ($CinquanteunSoixante/$nombreAdherent)*100;
	$avgSoixanteunSoixantedix = ($SoixanteunSoixantedix/$nombreAdherent)*100;
	$avgSoixanteOnzeSoixantedixneuf = ($SoixanteOnzeSoixantedixneuf/$nombreAdherent)*100;
	$avgQuatrevingPlus = ($QuatrevingPlus/$nombreAdherent)*100;


	echo ("<p align='left'>".$ZeroCinq." adhérent(s) entre 0 et 5 ans</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgZeroCinq ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgZeroCinq, 1)."%");
		?>
	</div>
</div><br><br><br>


<?php
	echo ("<p align='left'>".$SixDix." adhérent(s) entre 6 et 10 ans</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgSixDix ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgSixDix, 1)."%");
		?>
	</div>
</div><br><br><br>


<?php
	echo ("<p align='left'>".$OnzeQuinze." adhérent(s) entre 11 et 15 ans</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgOnzeQuinze ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgOnzeQuinze, 1)."%");
		?>
	</div>
</div><br><br><br>

<?php
	echo ("<p align='left'>".$SeizeVingt." adhérent(s) entre 16 et 20 ans</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgSeizeVingt ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgSeizeVingt, 1)."%");
		?>
	</div>
</div><br><br><br>


<?php
	echo ("<p align='left'>".$VingtunTrente." adhérent(s) entre 21 et 30 ans</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgVingtunTrente ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgVingtunTrente, 1)."%");
		?>
	</div>
</div><br><br><br>


<?php
	echo ("<p align='left'>".$TrenteunQuarante." adhérent(s) entre 31 et 40 ans</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgTrenteunQuarante ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgTrenteunQuarante, 1)."%");
		?>
	</div>
</div><br><br><br>


<?php
	echo ("<p align='left'>".$QuaranteunCinquante." adhérent(s) entre 41 et 50 ans</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgQuaranteunCinquante ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgQuaranteunCinquante, 1)."%");
		?>
	</div>
</div><br><br><br>


<?php
	echo ("<p align='left'>".$CinquanteunSoixante." adhérent(s) entre 51 et 60 ans</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgCinquanteunSoixante ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgCinquanteunSoixante, 1)."%");
		?>
	</div>
</div><br><br><br>


<?php
	echo ("<p align='left'>".$SoixanteunSoixantedix." adhérent(s) entre 61 et 70 ans</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgSoixanteunSoixantedix ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgSoixanteunSoixantedix, 1)."%");
		?>
	</div>
</div><br><br><br>


<?php
	echo ("<p align='left'>".$SoixanteOnzeSoixantedixneuf." adhérent(s) entre 71 et 79 ans</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgSoixanteOnzeSoixantedixneuf ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgSoixanteOnzeSoixantedixneuf, 1)."%");
		?>
	</div>
</div><br><br><br>


<?php
	echo ("<p align='left'>".$QuatrevingPlus." adhérent(s) 80 ans et plus</p>");
?>
<div class="progress">
	<div class="progress-bar" role="progressbar" style="width: <?php echo $avgQuatrevingPlus ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<?php
			echo (round($avgQuatrevingPlus, 1)."%");
		?>
	</div>
</div><br><br><br>


<br><br><br>
<h6>Répartition des adhérents par villes</h6><br>
<figcaption class="blockquote-footer">
<cite>Les statistiques de cette section peuvent être erronées, car un adhérent peut avoir des responsables ne résidant pas dans la même ville, une marge d'erreur d'environ <strong>5%</strong> est probable.</cite>
</figcaption>
<?php
	while ($rVille = $QueryVille->fetch()) {
	$ville = $rVille['ville'];

		$QueryNbParVille = $cnx->query("SELECT COUNT(DISTINCT responsable_adherent.adherent_id) as nbAdhVille FROM adherent, responsable_adherent, responsable, adhesion WHERE adherent.id = responsable_adherent.adherent_id AND responsable_adherent.responsable_id = responsable.id AND adherent.adhesion_id = adhesion.id AND adhesion.annee_id = '$idAnnee' AND responsable.ville LIKE '$ville'");
		$rNbParVille = $QueryNbParVille->fetch();

		$avgParVille = $rNbParVille['nbAdhVille'] / $villeTotal;
		$avgParVille = ($avgParVille * 100);



	echo ("<p align='left'>".$rNbParVille['nbAdhVille']." adhérent(s) de ".$ville."</p>");
	?>
	<div class="progress">
		<div class="progress-bar" role="progressbar" style="width: <?php echo $avgParVille ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
			<?php
				echo (round($avgParVille, 1)."%");
			?>
		</div>
	</div><br>
<?php
	}
?>

</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
</html>

	






