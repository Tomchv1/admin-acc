<!DOCTYPE html>
<html>
<head>
	<title>Activités</title>
  <?php require_once("include/menu.php");
  	include("include/cnx.php");
	$activite = addslashes($_POST['activite']);

	//$requete = $cnx->query("SELECT * FROM activites, activites_adherent, adherent, responsable_adherent, responsable WHERE activites.id = activites_adherent.activites_id AND activites_adherent.adherent_id = adherent.id AND adherent.id = responsable_adherent.adherent_id AND responsable_adherent.responsable_id = responsable.id AND activites.libelle LIKE '$activite'");

	$QueryIdActivite = $cnx->query("SELECT id FROM activites WHERE libelle LIKE '$activite'");
	$rIdActivite = $QueryIdActivite->fetch();
	$idActivite = $rIdActivite['id'];

	$QueryAdherent = $cnx->query("SELECT * FROM adherent, activites_adherent WHERE adherent.id = activites_adherent.adherent_id AND activites_adherent.activites_id = '$idActivite' ORDER BY nom ASC");
?>
	<meta charset="utf-8"> 
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css">
</head>
<body><br>


<div class="container">
<h5>Adhérents pour l'activité <?php echo $activite; ?></h5>
<a href="javascript:window.print()" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M37.84,6.88v44.72h-20.64c-5.6587,0 -10.32,4.6613 -10.32,10.32v61.92c0,5.6587 4.6613,10.32 10.32,10.32h20.64v30.96h96.32v-30.96h20.64c5.6587,0 10.32,-4.6613 10.32,-10.32v-61.92c0,-5.6587 -4.6613,-10.32 -10.32,-10.32h-20.64v-44.72zM44.72,13.76h82.56v37.84h-82.56zM17.2,58.48h23.50219c0.37149,0.0614 0.75054,0.0614 1.12203,0h88.31797c0.37149,0.0614 0.75054,0.0614 1.12203,0h23.53578c1.9437,0 3.44,1.4963 3.44,3.44v61.92c0,1.9437 -1.4963,3.44 -3.44,3.44h-20.64v-30.96h-3.44h-92.88v30.96h-20.64c-1.9437,0 -3.44,-1.4963 -3.44,-3.44v-61.92c0,-1.9437 1.4963,-3.44 3.44,-3.44zM141.04,68.8c-3.79972,0 -6.88,3.08028 -6.88,6.88c0,3.79972 3.08028,6.88 6.88,6.88c3.79972,0 6.88,-3.08028 6.88,-6.88c0,-3.79972 -3.08028,-6.88 -6.88,-6.88zM44.72,103.2h82.56v26.94219c-0.0614,0.37149 -0.0614,0.75054 0,1.12203v26.97578h-82.56v-26.94219c0.0614,-0.37149 0.0614,-0.75054 0,-1.12203zM58.48,113.52c-1.24059,-0.01754 -2.39452,0.63425 -3.01993,1.7058c-0.62541,1.07155 -0.62541,2.39684 0,3.46839c0.62541,1.07155 1.77935,1.72335 3.01993,1.7058h55.04c1.24059,0.01754 2.39452,-0.63425 3.01993,-1.7058c0.62541,-1.07155 0.62541,-2.39684 0,-3.46839c-0.62541,-1.07155 -1.77935,-1.72335 -3.01993,-1.7058zM58.48,127.28c-1.24059,-0.01754 -2.39452,0.63425 -3.01993,1.7058c-0.62541,1.07155 -0.62541,2.39684 0,3.46839c0.62541,1.07155 1.77935,1.72335 3.01993,1.7058h41.28c1.24059,0.01754 2.39452,-0.63425 3.01993,-1.7058c0.62541,-1.07155 0.62541,-2.39684 0,-3.46839c-0.62541,-1.07155 -1.77935,-1.72335 -3.01993,-1.7058zM58.48,141.04c-1.24059,-0.01754 -2.39452,0.63425 -3.01993,1.7058c-0.62541,1.07155 -0.62541,2.39684 0,3.46839c0.62541,1.07155 1.77935,1.72335 3.01993,1.7058h55.04c1.24059,0.01754 2.39452,-0.63425 3.01993,-1.7058c0.62541,-1.07155 0.62541,-2.39684 0,-3.46839c-0.62541,-1.07155 -1.77935,-1.72335 -3.01993,-1.7058z"></path></g></g></svg></a><br><br>
	
        	<?php
			while($adherent = $QueryAdherent->fetch())
			{
				$idAdherent = $adherent['id'];
				$QueryResponsable = $cnx->query("SELECT * FROM responsable, responsable_adherent WHERE responsable.id = responsable_adherent.responsable_id AND responsable_adherent.adherent_id = '$idAdherent'");
						
						
						echo "<div class='card'><div class='card-header'><strong>".$adherent['nom'] ." ". $adherent['prenom'] ."</strong> <i>(". $adherent['date_naissance'] .")</i></div><div class='card-body'>";
							while($responsable = $QueryResponsable->fetch())
							{
								echo "<li>". $responsable['nom'] ." ". $responsable['prenom'] ." : <img src='https://img.icons8.com/ios/20/000000/phone-office.png'/><strong> ". $responsable['telephone'] ." </strong><img src='https://img.icons8.com/ios/20/000000/phonelink-ring--v1.png'/><strong> ". $responsable['portable'] ." </strong><img src='https://img.icons8.com/ios/20/000000/email-sign.png'/><strong> ". $responsable['mail']."</strong></li>";
							}
				echo "</div></div>";
			}
			?>	
		</tr> 	  
    </tbody>
</table>



</center>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
</html>

	






