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
				<button type="button" class="btn btn-default" aria-label="Left Align" onclick="zoom(1,'tableauPartiesPrenantes');">
					<span class="glyphicon glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
				</button>
				<button type="button" class="btn btn-default" aria-label="Left Align" onclick="zoom(-1,'tableauPartiesPrenantes');">
					<span class="glyphicon glyphicon glyphicon-zoom-out" aria-hidden="true"></span>
				</button>
				<input type="submit" class="btn btn-primary" value="Enregistrer les modifications"/>
				<div id="tab" style="font-size:10px" >
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
							$i=0;
							foreach ($tableauPartiePrenante as $partiePrenante):
								$i++;
								$nom='value="'.$partiePrenante['nom'].'" data-toggle="tooltip" data-placement="top" title="'.$partiePrenante['nom'].'"';
								$entite='value="'.$partiePrenante['entite'].'" data-toggle="tooltip" data-placement="top" title="'.$partiePrenante['entite'].'"';
								$comite='value="'.$partiePrenante['comite'].'" data-toggle="tooltip" data-placement="top" title="'.$partiePrenante['comite'].'"';
								$site='value="'.$partiePrenante['site'].'" data-toggle="tooltip" data-placement="top" title="'.$partiePrenante['site'].'"';
								$fonction='value="'.$partiePrenante['fonction'].'" data-toggle="tooltip" data-placement="top" title="'.$partiePrenante['fonction'].'"';
								$role='value="'.$partiePrenante['roleProjet'].'" data-toggle="tooltip" data-placement="top" title="'.$partiePrenante['roleProjet'].'"';
								$tel='value="'.$partiePrenante['tel'].'" data-toggle="tooltip" data-placement="top" title="'.$partiePrenante['tel'].'"';
								$email='value="'.$partiePrenante['email'].'" data-toggle="tooltip" data-placement="top" title="'.$partiePrenante['email'].'"';
								$interneExterne='value="'.$partiePrenante['interneExterne'].'" data-toggle="tooltip" data-placement="top" title="'.$partiePrenante['interneExterne'].'"';
								$perimetre='value="'.$partiePrenante['perimetre'].'" data-toggle="tooltip" data-placement="top" title="'.$partiePrenante['perimetre'].'"';
								$classification='value="'.$partiePrenante['classification'].'" data-toggle="tooltip" data-placement="top" title="'.$partiePrenante['classification'].'"';
							
							?>
							<tr>
								<input type="hidden" name="idPartiePrenante[]" value="<?php echo $partiePrenante['idPartiePrenante']?>">
								<td><input type="checkbox" name="trash<?php echo $i;?>"></td>
								<td><input type="text" name="nom[]" <?php echo $nom ?>></td>
								<td><input type="text" name="entite[]" <?php echo $entite ?>></td>
								<td><input type="text" name="comite[]" <?php echo $comite ?>></td>
								<td><input type="text" name="site[]" <?php echo $site ?>></td>
								<td><input type="text" name="fonction[]" <?php echo $fonction ?>></td>
								<td><input type="text" name="role[]" <?php echo $role ?>></td>
								<td><input type="text" name="tel[]" <?php echo $tel ?>></td>
								<td><input type="text" name="email[]" <?php echo $email ?>></td>
								<td><input type="text" name="interneExterne[]" <?php echo $interneExterne ?>></td>
								<td><input type="text" name="perimetre[]" <?php echo $perimetre ?>></td>
								<td><input type="text" name="classification[]" <?php echo $classification ?>></td>
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