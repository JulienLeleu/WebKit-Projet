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
        <title>Kit Projet - Parties prenantes</title>		
    </head>
    <body>
		<div id="corps">
			<div id="entete">
				<a id ="deconnexion" href="logout.php">Se deconnecter</a><br/>
				<a href="accueil.php"><img id="logo" src="img/logoWebKitProjetV2.png"></a>
			</div>
			<?php getNav(8);?>
			<form action="ajouterPartiePrenante.php" method="POST">
				<button type="button" class="btn btn-default" aria-label="Left Align" onclick="addLinePartiePrenante('tableau')">
					<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
				<button type="button" class="btn btn-default" aria-label="Left Align" onclick="zoom(1,'tab');">
					<span class="glyphicon glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
				</button>
				<button type="button" class="btn btn-default" aria-label="Left Align" onclick="zoom(-1,'tab');">
					<span class="glyphicon glyphicon glyphicon-zoom-out" aria-hidden="true"></span>
				</button>
				<input type="submit" class="btn btn-primary" value="Enregistrer les modifications"/>
				<?php echo displayTabByName($bdd, 'partieprenante', $_SESSION['idProjet']); ?>
				<input type="submit" class="btn btn-primary" value="Enregistrer les modifications"/>
			</form>
		</div>
    </body>
</html>