<!DOCTYPE html>
<html>
<head>	
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.4-dist/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="css/styleNewKit.css" />
  <title>WebKit Projet - Accueil</title>
</head>
<body>
	<div id="corps">
		<a id ="deconnexion" href="logout.php">Se deconnecter</a><br/>
		<a href="accueil.php"><img id="logo" src="img/logoWebKitProjetV2.png"></a><br/>
			<div id="ajout">
				<form action="ajouterNouveauKit.php" method="GET" onsubmit="return verifForm(this)">
					<label>Nom Projet :</label><input type="text" name="nomProjet" onBlur="verifText(this)"/><br/>
					<label>SPM :</label><input type="text" name="spm" onBlur="verifOnlyText(this)"/><br/>
					<label>Budget :</label><select name="budget" size="1">
						<?php 
							//Affiche la combo box des budgets
							echo getComboBoxByName($bdd,'cbBudget');
						?>
					</select><br/>
					<label>AM :</label><select name="am" size="1">
						<?php
							//Affiche la combo box des AM
							echo getComboBoxByName($bdd,'cbAm');
						?>
					</select><br/>
					<label>DIB :</label><select name="dib" size="1">
						<?php
							//Affiche la combo box des DIB
							echo getComboBoxByName($bdd,'cbDib');
						?>
					</select><br/>
					<label>Projet MFU concerné(id) :</label><input type="text" name="idMfu" onBlur="verifIsNumeric(this);"/><br/>
					<label>Programme :</label><select name="programme" size="1">
						<?php
							//Affiche la combo box des programmes
							echo getComboBoxByName($bdd,'cbProgramme');
						?>
					</select><br/>
					<label>Domaine :</label><select name="domaine" size="1">
						<?php
							//Affiche la combo box des domaines
							echo getComboBoxByName($bdd,'cbDomaine');
						?>
					</select><br/><br/>
					<input type="submit" value="Créer" class="btn btn-primary">
				</form>
			</div>
	</div>
	<script>
		/**
		*	Fonction qui surligne le champ de saisie en rouge si il y a une erreur
		*	@champ: le champ de saisie
		*	@erreur: booleen
		*/
		function surligne(champ, erreur){
		   if(erreur)
			  champ.style.backgroundColor = "#fba";
		   else
			  champ.style.backgroundColor = "";
		}
		
		/**
		*	Fonction qui vérifie si le texte n'est pas vide
		*/
		function verifText(champ)
		{
		   if(champ.value.length < 1)
		   {
			  surligne(champ,true);
			  return false;
		   }
		   else
		   {
			  surligne(champ,false);
			  return true;
		   }
		}
		
		/**
		*	Fonction qui vérifie que le texte ne contienne pas de chiffres
		*/
		function verifOnlyText(champ){
			if(!containsNumeric(champ)){
				verifText(champ);
				return true;
			}
			else{
				surligne(champ,true);
				return false;
			}
			
		}
		
		/**
		*	Fonction qui vérifie que le texte contienne uniquement des chiffres
		*/
		function verifIsNumeric(champ){
			if(isNaN(champ.value)){
				surligne(champ,true);
				return false;
			}
			else {
				surligne(champ,false);
				return true;
			}
		}
		
		/**
		*	Fonction qui permet de savoir si le texte contient ou non des caractéres numériques
		*/
		function containsNumeric(champ){
			for(i=0;i<champ.value.length;++i) {
				if(champ.value.charAt(i) >= "0" && champ.value.charAt(i) <= "9") {
					return true;
				}
			}
			return false;
		}
		/**
		*	Fonction qui vérifie que le formulaire est bien remplie
		*/
		function verifForm(f){
		   var nomProjetOk = verifText(f.nomProjet);
		   var SPMok = verifOnlyText(f.spm) && verifText(f.spm);
		   var idMFUOk = verifIsNumeric(f.idMfu) && verifText(f.idMfu);
		   
		   if(nomProjetOk && SPMok && idMFUOk)
			  return true;
		   else
		   {
			  alert("Veuillez remplir correctement tous les champs");
			  return false;
		   }
		}
	</script>
</body>
</html>