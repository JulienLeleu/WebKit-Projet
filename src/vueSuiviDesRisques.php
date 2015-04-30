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
			<?php getNav(5);?>
			<form action="ajouterRisque.php" method="POST">
				<button type="button" class="btn btn-default" aria-label="Left Align" onclick="addLineSuiviDesRisques('tableau')">
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
								<th>N°</th>
								<th>Theme</th>
								<th>Chantier</th>
								<th>Date ident</th>
								<th>Echeance</th>
								<th>Alerte vers</th>
								<th>Type du risque</th>
								<th>Risque identifié</th>
								<th>Cause du risque</th>
								<th>Détail incidences sur le projet</th>
								<th>Niveau impact</th>
								<th>Probabilité occurence</th>
								<th>Action atténuation</th>
								<th>Acteur</th>
								<th>Statut</th>
								<th>Etat</th>
							</tr>
						</thead>
						<div id="scrollable">
						<tbody>
							<?php
								$i=0;
								foreach ($tableauRisques as $risque):
								$i++;
							?>
							<tr>
								<input type="hidden" name="idRisque[]" value="<?php echo $risque['idRisque']?>">
								<td><input type="checkbox" name="trash<?php echo $i ?>"></td>
								<td><label><?php echo $i?></label></td>
								<td><input type="text" name="theme[]" value="<?php echo $risque['theme']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['theme']?>"></td>
								<td><input type="text" name="chantier[]" value="<?php echo $risque['chantier']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['chantier']?>"></td>
								<td><input type="text" name="dateIdent[]" value="<?php echo $risque['dateIdent']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['dateIdent']?>"></td>
								<td><input type="text" name="echeance[]" value="<?php echo $risque['echeance']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['echeance']?>"></td>
								<td><input type="text" name="alerteVers[]" value="<?php echo $risque['alerteVers']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['alerteVers']?>"></td>
								<td><input type="text" name="typeDuRisque[]" value="<?php echo $risque['typeDuRisque']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['typeDuRisque']?>"></td>
								<td><input type="text" name="risqueIdentifie[]" value="<?php echo $risque['risqueIdentifie']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['risqueIdentifie']?>"></td>
								<td><input type="text" name="causeDuRisque[]" value="<?php echo $risque['causeDuRisque']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['causeDuRisque']?>"></td>
								<td><input type="text" name="detailsIncidencesSurProjet[]" value="<?php echo $risque['detailsIncidencesSurProjet']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['detailsIncidencesSurProjet']?>"></td>
								<td><input type="text" name="niveauImpact[]" value="<?php echo $risque['niveauImpact']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['niveauImpact']?>"></td>
								<td><input type="text" name="probabiliteOccurence[]" value="<?php echo $risque['probabiliteOccurence']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['probabiliteOccurence']?>"></td>
								<td><input type="text" name="actionAttenuation[]" value="<?php echo $risque['actionAttenuation']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['actionAttenuation']?>"></td>
								<td><input type="text" name="acteur[]" value="<?php echo $risque['acteur']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['acteur']?>"></td>
								<td><input type="text" name="statut[]" value="<?php echo $risque['statut']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['statut']?>"></td>
								<td><input type="text" name="etat[]" value="<?php echo $risque['etat']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $risque['etat']?>"></td>
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