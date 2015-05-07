<?php
	/**
	*	Fonction qui permet de se connecter à la base de donnée
	*	à effectuer avant d'utiliser toute autre fonction utilisant la bdd
	*	@DatabaseName : Le nom de la base de donnée
	*/
	function connect($databaseName){
		try{
			$bdd = new PDO('mysql:host=localhost;dbname='.$databaseName.';charset=utf8', 'root', 'root');
			//Pour traiter les exceptions
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (Exception $e){
				die('Erreur : ' . $e->getMessage());
		}
		return $bdd;
	}
	/**
	*	Fonction qui permet de récuperer toutes les lignes d'une table
	*	@bdd : La variable associée à la base de donnée
	*	@nomTable : nom de la table
	*/
	function selectAll($bdd, $nomTable){
		$request = $bdd->query('SELECT * FROM '.$nomTable.';');
		return $request;
	}

	/**
	*	Fonction qui permet de s'authentifier
	*	Elle vérifie que le couple pseudo/mot de passe est bien inscrit dans la base de donnée
	*	@bdd : La variable associée à la base de donnée
	*	@login : le login de l'utilisateur
	*	@password : le mot de passe de l'utilisateur
	*/
	function isRegistered ($bdd,$login,$password) {
		$bdd->query('SELECT * FROM user WHERE login=\''.$login.'\' AND mdp=\''.$password.'\';');
	}
	
	/**
	*	Fonction qui permet d'insérer une ou plusieurs valeur(s) dans la bdd à partir d'un tableau de résultats
	*	@bdd : La variable associée à la base de donnée
	*	@nomTable : le nom de la table pour l'opération
	*	@arrayValue : le tableau de valeurs à insérer dans la table
	*/
	function insert ($bdd,$nomTable,$arrayValue) {
		$valeurs = '';
		for($i=0;$i<count($arrayValue);$i++){
			if($i!=count($arrayValue)-1) {
				$valeurs = $valeurs . '\'' . $arrayValue[$i] .'\', ';
			}
			else {
				$valeurs = $valeurs . '\'' .$arrayValue[$i] . '\'';
			}
		}
		//echo "INSERT INTO ".$nomTable." VALUES(NULL, ".$valeurs.");<br><br/>";
		$bdd->query('INSERT INTO '.$nomTable.' VALUES(NULL, '.$valeurs.');');
	}
	
	function delete($bdd, $nomTable, $idProjet, $nomColId, $idLigne){
		//echo "DELETE FROM ".$nomTable."WHERE idProjet='".$idProjet."' AND ".$nomColId."='".$idLigne."';<br/><br/>";
		$bdd->query('DELETE FROM '.$nomTable.' WHERE idProjet=\''.$idProjet.'\' AND '.$nomColId.'=\''.$idLigne.'\';');
	}
	
	/**
	*	Fonction qui permet de savoir si une table existe ou nom
	*/
	function exist($bdd,$nomTable){
		//On teste l'existence de la table
		$request = $bdd->query('SHOW TABLES LIKE \''.$nomTable.'\'');
		if(!$request) {
			die(print_r($bdd->errorInfo(), TRUE));
			return false;
		}
		if($request->rowCount()>0){
			return true;
		}
		return false;
	}
	
	/**
	*	Fonction qui permet de récuperer une liste d'options a insérer dans des balises <select> à partir d'un nom
	*	Si la table existe on renvoie un résultat, sinon on renvoie une chaine vide => ne fait pas planter le code en cas d'echec
	*	@bdd : La variable associée à la base de donnée
	*	@nomComboBox : Nom de la table contenant les valeurs de la combo box désirée
	*/
	function displayComboBoxByName($bdd,$nomComboBox){
		$result = '';
		
		//Si elle existe on extrait son contenu et on renvoi les valeur sous forme de balises <options>
		if(exist($bdd,$nomComboBox)) {
			$request = $bdd->query('SELECT * FROM '.$nomComboBox.';');
			while($donnees = $request->fetch()){
				$result = $result.'<option>'.$donnees['valeur'].'</option>';
			}
			$request->closeCursor();
		}
		return $result;
	}
	/**
	*	Fonction qui génére un tableau a partir du nom de la table
	*	et de l'id projet.
	*	Pré-requis : Avoir une table qui existe et entrer les valeurs dans la table typeForm
	*/
	function displayTabByName($bdd, $nomTable, $idProjet){
		$resultat ="";
		if(exist($bdd,$nomTable)){
			$request = $bdd->query('SELECT * FROM '.$nomTable.' WHERE idProjet=\''.$idProjet.'\';');
			$resultat .= "<div id=\"tab\" style=\"font-size:10px\">\n";
			$resultat .= "<table id=\"tableau\" border=\"1px\" class=\"overflow-y\">\n";
			//Entête
			$resultat .= "<thead>\n";
			$resultat .= "<tr>\n";
			$resultat .= "<th><span class=\"glyphicon glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></th>";
			$resultat .= "<th>N°</th>";
			//On affiche le nom des colonnes
			for ($i=0; $i<$request->columnCount(); $i++){
                $nomColonne = $request->getColumnMeta($i);
				$requestTypeForm = $bdd->query('SELECT type FROM typeform WHERE nomTable=\''.$nomTable.'\' AND nomColonne=\''.$nomColonne['name'].'\';');
				$typeForm = $requestTypeForm->fetch()[0];
				if($typeForm!="hidden" && $typeForm!="null"){
					$resultat .= "<th>".$nomColonne['name']."</th>\n";
				}
            }
			$resultat .= "</tr>\n";
			$resultat .= "</thead>\n";
			
			
			//Corps du tableau
			$resultat .= "<div id=\"scrollable\">\n";
			$resultat .= "<tbody>\n";
			$cursorLine =0;
			$resultat .= "<input type=\"hidden\" name=\"table\" value=\"".$nomTable."\">";
			while($donnees = $request->fetch()){
				$cursorLine++;
				if($cursorLine%2==0){
					$resultat .= "<tr class=\"rowPair\">\n";
				}
				else {
					$resultat .= "<tr class=\"rowImpair\">\n";
				}
				$resultat .= "<td><input type=\"checkbox\" name=\"trash".$cursorLine."\"></td>";
				$resultat .= "<td><label>".$cursorLine."</label></td>";
				
				//En fonction du type de formulaire qui doit être utilisé par colonne on affiche ...
				for ($i=0; $i<$request->columnCount(); $i++){
					$nomColonne = $request->getColumnMeta($i);
					$requestTypeForm = $bdd->query('SELECT type FROM typeform WHERE nomTable=\''.$nomTable.'\' AND nomColonne=\''.$nomColonne['name'].'\';');
					$typeForm = $requestTypeForm->fetch()[0];
					
					switch($typeForm){
						case "text":
						$resultat .= "<td><input type=\"text\" name=\"".$nomColonne['name']."[]\" value=\"".$donnees[$i]."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"".$donnees[$i]."\"></td>\n";
						break;
						
						case "date":
						$resultat .= "<td><input type=\"date\" name=\"".$nomColonne['name']."[]\" value=\"".$donnees[$i]."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"".$donnees[$i]."\"></td>\n";
						break;
						
						case "label":
						$resultat .= "<td><label data-toggle=\"tooltip\" data-placement=\"top\" title=\"".$donnees[$i]."\">".$donnees[$i]."</label></td>\n";
						break;
						
						case "hidden":
						$resultat .= "<input type=\"hidden\" name=\"".$nomColonne['name']."[]\" value=\"".$donnees[$i]."\">";
						break;
						
						default :
						if($typeForm!="null"){
							$resultat .= "<td><input type=\"text\" name=\"".$nomColonne['name']."[]\" value=\"".$donnees[$i]."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"".$donnees[$i]."\"></td>\n";
						}
						break;
					}
				}
				$resultat .= "</tr>\n";
			}
			$resultat .= "</tbody>\n";
			$resultat .= "</div>\n";
			$resultat .= "</table>\n";
			$resultat .= "</div>";
			$resultat .= "</div>\n";
		}
		else {
			$resultat = "<h2>Cette table n'existe pas</h2><br/><br/>";
		}
		return $resultat;
	}
	
	function displayBudget($bdd, $dateMin, $dateMax, $idProjet){
		$resultat ="";
		$request = $bdd->query('SELECT * FROM budget WHERE idProjet=\''.$idProjet.'\';');
		while($donnees = $request->fetch()){
			for($i=$dateMin; $i<=$dateMax; $i++){
				$req1 = $bdd->query('SELECT annee FROM budget, colBudget WHERE idProjet=\''.$idProjet.'\' AND budget.idBudget=colBudget.idBudget AND budget.idBudget=\''.$donnees['idBudget'].'\' AND annee=\''.$i.'\' GROUP BY annee;');
				if($req1->rowCount()==0){
					insert($bdd,'colBudget',array($donnees['idBudget'],$i,0));
				}
				echo "<br/>" . $i;
			}
		}
			$resultat .= "<div id=\"tab\" style=\"font-size:10px\">\n";
			$resultat .= "<table id=\"tableau\" border=\"1px\" class=\"overflow-y\">\n";
			//Entête
			$resultat .= "<thead>\n";
			$resultat .= "<tr>\n";
			$resultat .= "<th><span class=\"glyphicon glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></th>";
			$resultat .= "<th>N°</th>";
			//On affiche le nom des colonnes
			for ($i=0; $i<$request->columnCount(); $i++){
                $nomColonne = $request->getColumnMeta($i);
				$requestTypeForm = $bdd->query('SELECT type FROM typeform WHERE nomTable=\'budget\' AND nomColonne=\''.$nomColonne['name'].'\';');
				$typeForm = $requestTypeForm->fetch()[0];
				if($typeForm!="hidden" && $typeForm!="null"){
					$resultat .= "<th>".$nomColonne['name']."</th>\n";
				}
            }
			$resultat .= "</tr>\n";
			$resultat .= "</thead>\n";
			$resultat .= "</div>";
		
		// for($i=$dateMin; $i<=$dateMax; $i++){
			// $req1 = $bdd->query('SELECT annee FROM budget, colBudget WHERE idProjet=\''.$idProjet.'\' AND budget.idBudget=colBudget.idBudget AND annee=\''.$i.'\' GROUP BY annee;');//AND idBudget = $idBudget
			// if(!$req1){
				// die(print_r($bdd->errorInfo(), TRUE));
				// insert($bdd,'colBudget',array('',/*idBudget,*/$i,0));
			// }
			// $resultat .= "<div id=\"tab\" style=\"font-size:10px\">\n";
			// $resultat .= "<table id=\"tableau\" border=\"1px\" class=\"overflow-y\">\n";
			// Entête
			// $resultat .= "<thead>\n";
			// $resultat .= "<tr>\n";
			// $resultat .= "<th><span class=\"glyphicon glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></th>";
			// $resultat .= "<th>N°</th>";
		// }
		echo $resultat;
	}
	
	/**
	*	TO DO
	*/
	function disconnect (){}
	
?>