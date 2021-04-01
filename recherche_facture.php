<!DOCTYPE html>
<html>
<head>
	<title>Facture</title>
  <?php require_once("include/menu.php");
    include("include/cnx.php");
    $QueryResp = $cnx->query("SELECT * FROM responsable ORDER BY responsable.nom");
  ?>
	<meta charset="utf-8"> 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	
</head>
<body><br><br>
<h4><u>Responsables</u></h4><br>
<div class="container">
<table class="table table-striped table-light">
  <thead align="center">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Ville</th>
      <th></th>
    </tr>
  </thead>
  <tbody align="center">
    <tr>
<?php
		while($Resp = $QueryResp->fetch())
		{
?>
	  <th scope="row"><?php echo $Resp['id'] ?></th></td>
      <td align="center"><?php echo $Resp['nom'] ?></td>
      <td align="center"><?php echo $Resp['prenom'] ?></td>
      <td align="center"><?php echo $Resp['ville']." - ".$Resp['cp'] ?></td>
      <td><?php echo "<a class='btn btn-outline-primary' href='demande_ville.php?code=".$Resp['id']."' >Facture</a>"?></td>
    </tr>
<?php } ?>

	
</table>

</center>
</body>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>