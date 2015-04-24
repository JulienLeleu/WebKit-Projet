	<?php
		include('outilBdd.php');
		$bdd = connect('kitprojet');
	?>
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
			<a href="accueil.php"><img src="img/logoWebKitProjet.png"></a>
		</div>
		<div id="nouveauKit">
			<a href="newKit.php" class="btn btn-primary">Nouveau kit Projet</a>
			<a href="importKit.php" class="btn btn-primary">Import kit via MFU</a><br/>
		</div>
		<h4>ou</h4>
		<h3>Rechercher un kit existant :</h3>
		<div id="recherche">
			<form action="accueil.php" method="GET">
				<label>SPM :</label><input type ="text" name="spm"/><br/>
				<label>AM :</label><select name="am" size="1">
				<option></option>
				<?php 
					//Affiche la combo box des am
					echo getComboBoxByName($bdd,'cbAm');
				?>
				</select><br/>
				<label>Programme :</label><select name="programme" size="1">
				<option></option>
				<?php 
					//Affiche la combo box des programmes
					echo getComboBoxByName($bdd,'cbProgramme');
				?>
				</select><br/>
				<label>Statut :</label><select name="statut" size="1">
				<option></option>
				<?php 
					//Affiche la combo box des statuts
					echo getComboBoxByName($bdd,'cbStatut');
				?>
				</select><br/>
				<input type="submit" value="Rechercher" class="btn btn-primary"/>
			</form>
		</div>
		<br/><br/>
		<form>
			<fieldset>
				<legend  class="bg-primary">Résultat(s) de la recherche</legend>
				<table class="table" border="1px">
					<tr>
						<th>Nom projet</th>
						<th>AM</th>
						<th>Derniere modification</th>
						<th>Statut</th>
					</tr>
				</table>
			</fieldset>
		</form>
	</div>
</body>
</html>