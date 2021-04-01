<?php
try{
	$cnx = new PDO('mysql:host=localhost;dbname=acc;charset=utf8', 'root', '');
	}

catch (PDOException $erreur){
	echo $erreur->getMessage();
	}

?>