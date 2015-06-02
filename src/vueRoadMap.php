<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.4-dist/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="css/styleInterfaceProjet.css" />
		<link rel="stylesheet" type="text/css" href="css/styleRoadMap.css" />
		<script src="js/outilTableau.js"></script>
		<script src="js/jquery-1.11.2.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
		<script src="css/bootstrap-3.3.4-dist/js/bootstrap.js"></script>
		<script src="../lib/jspdf/jspdf.js"></script>
		<script src="../lib/jspdf/libs/Deflate/adler32cs.js"></script>
		<script src="../lib/jspdf/libs/FileSaver.js/FileSaver.js"></script>
		<script src="../lib/jspdf/libs/Blob.js/BlobBuilder.js"></script>
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
			<?php 
				getNav(3);
			?>
			<div id="echelle">
				<label>Echelle de temps :</label>
					<button onclick="location.href='roadMap.php?echelle=annee'" class="btn">Année</button>
					<!--<button onclick="location.href='roadMap.php?echelle=trimestre'" class="btn">Trimestre</button>-->
					<button onclick="location.href='roadMap.php?echelle=mois'" class="btn">Mois</button>
					<button onclick="location.href='roadMap.php?echelle=semaine'" class="btn">Semaine</button>
					<!--<button onclick="location.href='roadMap.php?echelle=jour'" class="btn">Jour</button>-->
			</div>
			<div id="gantt">
			<?php
				include('gantt.php');
			?>
			</div>
		</div>
    </body>
</html>