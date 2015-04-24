<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.4-dist/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="css/styleInterfaceProjet.css" />
		<script src="js/jquery-1.11.2.js"></script>
		<script src="js/genererTab.js"></script>
        <meta charset="utf-8" />
        <title>Kit Projet - Tableau de bord</title>
    </head>
    <body>
		<div id="corps">
			<div id="entete">
				<a id ="deconnexion" href="logout.php">Se deconnecter</a><br/>
				<a href="accueil.php"><img id="logo" src="img/logoWebKitProjetV2.png"></a>
			</div>
			<?php 
				include('nav.php');
				getNav(1);
			?>
		</div>
    </body>
</html>