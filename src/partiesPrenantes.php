<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.4-dist/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="css/StickyTableHeaders/css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/styleInterfaceProjet.css" />
		<link rel="stylesheet" type="text/css" href="css/stylePartiesPrenantes.css" />
		<script src="js/jquery-1.11.2.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
		<script src="css/StickyTableHeaders/js/jquery.stickyheader.js"></script>
        <meta charset="utf-8" />
        <title>Kit Projet - Parties prenantes</title>		
    </head>
    <body>
		<div id="corps">
			<div id="entete">
				<a id ="deconnexion" href="logout.php">Se deconnecter</a><br/>
				<a href="accueil.php"><img id="logo" src="img/logoWebKitProjetV2.png"></a>
			</div>
			<?php 
				include('nav.php');
				getNav(8);
			?>
			<form action="#" method="GET">
				<button type="button" class="btn btn-default" aria-label="Left Align">
					<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
				<button type="button" class="btn btn-default" aria-label="Left Align" onclick="zoom(1);">
					<span class="glyphicon glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
				</button>
				<button type="button" class="btn btn-default" aria-label="Left Align" onclick="zoom(-1);">
					<span class="glyphicon glyphicon glyphicon-zoom-out" aria-hidden="true"></span>
				</button>
				<input type="submit" class="btn btn-primary" value="Enregistrer les modifications"/>
				<div id="tableauPartiesPrenantes" style="font-size:10px" >
					<table id="tableau" border="1px" class="overflow-y">
						<thead>
							<tr>
								<th>Nom</th>
								<th>Entité</th>
								<th>Comité</th>
								<th>Site</th>
								<th>Fonction</th>
								<th>Rôle au sein du projet</th>
								<th>Tél</th>
								<th>Email</th>
								<th>Interne/Ext</th>
								<th>Périmètre</th>
								<th>Classification</th>
							</tr>
						</thead>
						<div id="scrollable">
						<tbody>
							<?php
							for($i=0;$i<10;$i++){
								echo '
								<tr>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
									<td><input type="text"></td>
								</tr>';
							}
							?>
						</tbody>
						</div>
					</table>
				</div>
				<input type="submit" class="btn btn-primary" value="Enregistrer les modifications"/>
			</form>
		</div>
    </body>
</html>
<script>
	
	function zoom(modif){
		var t = extractNumberOf(document.getElementById("tableauPartiesPrenantes").style.fontSize);
		t = t + modif;
		document.getElementById("tableauPartiesPrenantes").style.fontSize = t + "px";		
	}

	function extractNumberOf(text){
		var ar = "";
		var tmp = "";
		for (var i = 0; i < text.length; i++) {
			if (!isNaN(text.charAt(i))) { // Si c'est un nombre
				tmp = tmp + text.charAt(i).toString();
			}
		}
	return Number(tmp);
	}
</script>