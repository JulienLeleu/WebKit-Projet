<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.4-dist/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="css/StickyTableHeaders/css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/styleInterfaceProjet.css" />
		<link rel="stylesheet" type="text/css" href="css/styleTableauSaisie.css" />
		<script src="js/outilTableau.js"></script>
		<script src="js/jquery-1.11.2.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
		<script src="css/StickyTableHeaders/js/jquery.stickyheader.js"></script>
		<script src="css/bootstrap-3.3.4-dist/js/bootstrap.js"></script>
        <meta charset="utf-8" />
		<!--Web project manager-->
        <title>Kit Projet - Suivi des risques</title>		
    </head>
    <body>
		<div id="corps">
			<div id="entete">
				<a id ="deconnexion" href="logout.php">Se deconnecter</a><br/>
				<a href="accueil.php"><img id="logo" src="img/logoWebKitProjetV2.png"></a>
			</div>
			<?php getNav(4);
			$bdd = connect('kitProjet');
			echo displayTabByName($bdd, 'actionEtJalon', $_SESSION['idProjet']);
			?>
    </body>
</html>