<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
  <?php require_once("include/menu.php");
    include("include/cnx.php");
  ?>
	<meta charset="utf-8"> 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body><br><br>

<div class="container">
<?php
$code = $_POST['code'];
if($code == "07441"){
	echo "<h4><u>Gestion des données</u></h4><br>";

?>
<div class="alert alert-danger" role="alert">
  <strong>La suppresion de toutes les données est définitive et irrévérsible. Avant toutes suppression, effectuer une sauvegarde de secours via ce <a href="https://world-358.fr.planethoster.net:2083/cpsess1169518483/3rdparty/phpMyAdmin/db_sql.php" target="blanck">lien</a></strong><br><br>
	<form method="post" action="include/delete_bdd.php">
		<input type="password" name="code" id="code" placeholder="Saisir le code de sécurité" class="form-control"><br>
		<button type="submit" class="btn btn-danger">Supprimer toutes les données</button>
	</form>
</div>

<div class="alert alert-warning" role="alert">
    <h5><strong><u>Sauvegardez régulièrement, stocker en toute sécurité.</u></strong></h5><br> Pour exporter les données de votre application, rendez-vous <a href="https://world-358.fr.planethoster.net:2083/cpsess1169518483/3rdparty/phpMyAdmin/db_sql.php">ici</a>. Identifiez-vous avec les identifiants de cPanel, puis après la connexion, appuyer sur le bouton exporter. Vous pouvez retrouver tous les conseils dans le guide d'utilisation fourni lors de la livraison de l'application. Il est recommandé de faire une sauvegarde au format <strong>CSV</strong> et <strong>SQL</strong>. Stocker ces documents dans un <u>espace sécurisé</u> avec un <u>accès restreint</u>.<br><br>
</div>
<?php
}
else{
	echo "<h3><u>ERREUR</u><br><br>Vous n'êtes pas habilité à accéder à cette page.</h3>";
}




?>


</div>
</body>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</html>