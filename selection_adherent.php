<!DOCTYPE html>
<html>
<head>
	<title>Adhérent</title>
  <?php require_once("include/menu.php");
    include("include/cnx.php");
    $requete = $cnx->query("SELECT * FROM adherent ORDER BY id");
  ?>
	<meta charset="utf-8"> 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	
</head>
<body><br><br>

<div class="container">
<table class="table table-striped table-light">
  <thead align="center">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Date de naissance</th>
      <th></th>
    </tr>
  </thead>
  <tbody align="center">
    <tr>
<?php
	$adherent = $cnx->query("SELECT * FROM adherent ORDER BY id");
		while($infoAdh = $adherent->fetch())
		{
?>
	  <th scope="row"><?php echo $infoAdh['id'] ?></th></td>
      <td align="center"><?php echo $infoAdh['nom'] ?></td>
      <td align="center"><?php echo $infoAdh['prenom'] ?></td>
      <td align="center"><?php echo $infoAdh['date_naissance'] ?></td>
      <td><?php echo "<a class='btn btn-outline-primary' href='include/preinscription.php?code=".$infoAdh['id']."' >Imprimer</a>"?></td>
    </tr>
<?php } ?>

	
</table>

</center>
</body>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>