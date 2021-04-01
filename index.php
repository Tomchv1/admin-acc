<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
  <?php require_once("include/menu.php");
    include("include/cnx.php");
  ?>
	<meta charset="utf-8"> 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	
</head>
<body><br><br>

<div class="container">
<a href="http://localhost/acc/public/accueil">Accéder à Gest'ACC</a><br><br>

<div class="card-group">
  <div class="card">
    <img src="https://img.icons8.com/ios-filled/500/000000/conference-call.png" class="card-img-top">
    <div class="card-body">
      <a href="selection_activite.php"><h5 class="card-title">Imprimer liste adhérent par activités</h5></a>
      <p class="card-text">Visualiser les adhérents selon leurs activités, avec les coordonnées de leurs responsables légaux.</p>
    </div>
  </div>
  <div class="card">
    <img src="https://img.icons8.com/ios-filled/500/000000/google-forms.png" class="card-img-top">
    <div class="card-body">
       <a href="selection_adherent.php"><h5 class="card-title">Imprimer formulaire inscription internet</h5></a>
      <p class="card-text">Impression au format PDF du formulaire d'inscription d'un adhérent.</p>
    </div>
  </div>
  <div class="card">
    <img src="https://img.icons8.com/ios-filled/500/000000/combo-chart--v1.png" class="card-img-top">
    <div class="card-body">
      <a href="selection_annee_statistique.php"><h5 class="card-title">Consulter les statistiques</h5></a>
      <p class="card-text">Visualiser les statistiques de votre association.</p>
    </div>
  </div>
  <div class="card">
    <img src="https://img.icons8.com/ios/500/000000/exchange-euro.png" class="card-img-top">
    <div class="card-body">
      <a href="selection_annee_comptabilite.php"><h5 class="card-title">Consulter la comptabilité</h5></a>
      <p class="card-text">Visualiser les montants à réglé et les montants réglés.</p>
    </div>
  </div>
  <div class="card">
    <img src="https://img.icons8.com/ios-filled/500/000000/combi-ticket.png" class="card-img-top">
    <div class="card-body">
      <a href="recherche_facture.php"><h5 class="card-title">Imprimer une facture</h5></a>
      <p class="card-text">Imprimer les factures d'adhésion de vos adhérents.</p>
    </div>
  </div>
</div>
</div>
</center>
</body>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>