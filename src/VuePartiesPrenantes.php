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
				<button type="button" class="btn btn-default" aria-label="Left Align" onclick="addLinePartiePrenante('#tableau')">
					<span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
				<button type="button" class="btn btn-default" aria-label="Left Align" onclick="zoom(1,'tableauPartiesPrenantes');">
					<span class="glyphicon glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
				</button>
				<button type="button" class="btn btn-default" aria-label="Left Align" onclick="zoom(-1,'tableauPartiesPrenantes');">
					<span class="glyphicon glyphicon glyphicon-zoom-out" aria-hidden="true"></span>
				</button>
				<input type="submit" class="btn btn-primary" value="Enregistrer les modifications"/>
				<div id="tableauPartiesPrenantes" style="font-size:10px" >
					<table id="tableau" border="1px" class="overflow-y">
						<thead>
							<tr>
								<th><span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span></th>
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
							foreach ($tableauPartiePrenante as $partiePrenante):
							?>
							<tr>
								<input type="hidden" name="idPartiePrenante[]" value="<?php echo $partiePrenante['idPartiePrenante']?>">
								<td><input type="checkbox" name="trash[]"></td>
								<td><input type="text" name="nom[]" value="<?php echo $partiePrenante['nom']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $partiePrenante['nom']?>"></td>
								<td><input type="text" name="entite[]" value="<?php echo $partiePrenante['entite']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $partiePrenante['entite']?>"></td>
								<td><input type="text" name="comite[]" value="<?php echo $partiePrenante['comite']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $partiePrenante['comite']?>"></td>
								<td><input type="text" name="site[]" value="<?php echo $partiePrenante['site']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $partiePrenante['site']?>"></td>
								<td><input type="text" name="fonction[]" value="<?php echo $partiePrenante['fonction']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $partiePrenante['fonction']?>"></td>
								<td><input type="text" name="role[]" value="<?php echo $partiePrenante['roleProjet']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $partiePrenante['roleProjet']?>"></td>
								<td><input type="text" name="tel[]" value="<?php echo $partiePrenante['tel']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $partiePrenante['tel']?>"></td>
								<td><input type="text" name="email[]" value="<?php echo $partiePrenante['email']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $partiePrenante['email']?>"></td>
								<td><input type="text" name="interneExterne[]" value="<?php echo $partiePrenante['interneExterne']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $partiePrenante['interneExterne']?>"></td>
								<td><input type="text" name="perimetre[]" value="<?php echo $partiePrenante['perimetre']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $partiePrenante['perimetre']?>"></td>
								<td><input type="text" name="classification[]" value="<?php echo $partiePrenante['classification']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $partiePrenante['classification']?>"></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						</div>
					</table>
				</div>
				<input type="submit" class="btn btn-primary" value="Enregistrer les modifications"/>
			</form>
		</div>
    </body>
</html>