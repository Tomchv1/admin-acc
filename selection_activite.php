<!DOCTYPE html>
<html>
<head>
	<title>Activités</title>
  <?php require_once("include/menu.php");
    include("include/cnx.php");
    $requete = $cnx->query("SELECT * FROM activites ORDER BY libelle");
  ?>
	<meta charset="utf-8"> 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	
</head>
<body><br><br>

<div class="container">
<p>Pour afficher tous les adhérents, ainsi que leus informations de leurs responsables légaux, veuillez sélectionner l'activité en question.</p>
<form method="post" action="recherche_activite.php">
<select class="form-select" id="activite" name="activite">
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
<button type="submit" class="btn btn-primary">Rechercher</button>
</form>


</center>
</body>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>