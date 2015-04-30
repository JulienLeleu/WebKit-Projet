<!DOCTYPE html>
<html>
<head>	
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.4-dist/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/styleAccueil.css" />
  <title>WebKit Projet - Accueil</title>
</head>
<body>
	<div id="corps">
		<div id="entete">
			<a id ="deconnexion" href="logout.php">Se deconnecter</a><br/>
			<a href="accueil.php"><img id="logo" src="img/logoWebKitProjetV2.png"></a>
		</div>
		<div id="nouveauKit">
			<a href="nouveauKit.php" class="btn btn-primary">Nouveau kit Projet</a>
			<a href="importKit.php" class="btn btn-primary">Import kit via MFU</a><br/>
		</div>
		<h4>ou</h4>
		<h3>Rechercher un kit existant :</h3>
		<div id="recherche">
			<form action="accueil.php#resultatRecherche" method="GET">
				<label>SPM :</label><input type ="text" name="spm"/><br/>
				<label>AM :</label><select name="am" size="1">
				<option></option>
				<?php 
					//Affiche la combo box des am
					echo displayComboBoxByName($bdd,'cbAm');
				?>
				</select><br/>
				<label>Programme :</label><select name="programme" size="1">
				<option></option>
				<?php 
					//Affiche la combo box des programmes
					echo displayComboBoxByName($bdd,'cbProgramme');
				?>
				</select><br/>
				<label>Statut :</label><select name="statut" size="1">
				<option></option>
				<?php 
					//Affiche la combo box des statuts
					//echo displayComboBoxByName($bdd,'cbStatut');
				?>
				</select><br/>
				<input type="submit" value="Rechercher" class="btn btn-primary"/>
			</form>
		</div>
		<br/><br/>
		<fieldset>
			<legend id="legend">Résultat(s) de la recherche</legend>
			<div id="scrollBar">
				<table id="resultatRecherche" class="table" border="1px">
					<thead>
						<tr>
							<th>Nom projet</th>
							<th>AM</th>
							<th>Derniere modification</th>
							<th>Statut</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$numeroLigne=0;
						foreach ($listeProjets as $projet):
							$numeroLigne++;
							//On colore les lignes paires (voir css .rowPair)
							if($numeroLigne%2==0) {
								$rowType = 'rowPair';
							}
							else {
								$rowType = 'rowImpair';
							}
					?>
					<tr id="row" <?php echo 'class="'.$rowType .'" onclick="changePage(\'tdb.php?idProjet='.$projet['idProjet'].'\');"'?>>
						<td id="titreProjet"><strong><?= $projet['nomProjet'] ?></strong></td>
						<td><?= $projet['am'] ?></td>
						<td>Non renseigné</td>
						<td>Non renseigné</td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</fieldset>
	</div>
	<script>
		function changePage(adresse)
		{
			window.location.href = adresse;
		}
	</script>
</body>
</html>
