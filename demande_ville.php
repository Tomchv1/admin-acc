<!DOCTYPE html>
<html>
<head>
	<title>Comptabilité</title>
  <?php require_once("include/menu.php");
    include("include/cnx.php");

    if(isset($_GET['code']))
	{
		$idResp = $_GET['code'];
	}
	else
	{
		$idResp = "";
	}

	$QueryResp = $cnx->query("SELECT * FROM responsable WHERE id = '$idResp'");
	$Resp = $QueryResp->fetch();
	$requete = $cnx->query("SELECT * FROM annee ORDER BY id DESC");
  ?>
	<meta charset="utf-8"> 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	
</head>
<body><br><br>
<div class="container">

<p><strong><?php echo $Resp['nom']." ".$Resp['prenom']; ?></strong> réside à Courseulles-sur-mer ?</p>

<form method="post" action="include/facture.php">
<select class="form-select" id="ville" name="ville">
	<option selected>Oui</option>
	<option>Non</option>
</select>
<cite>Selon notre base de données, la ville définie est : <strong><?php echo $Resp['ville']." - ".$Resp['cp']; ?></strong></cite><br><br>
<br>
<select class="form-select" id="annee" name="annee">
		<?php
		while($resultat = $requete->fetch())
		{
		?>
		  <option><?php echo $resultat['libelle']?></option>
		<?php
		}
		?>
</select>
<br>
<label>Montant de la cotisation</label><input type="float" name="cotisation" id="cotisation" class="form-control" value="0.00">
<br><br>
<button type="submit" class="btn btn-primary">Imprimer la facture</button>
<input type="hidden" name="idResp" value="<?php echo $idResp; ?>"/>
</form>






</center>
</body>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>