<?php
	require 'outilBdd.php';
	
	function getPartiesPrenantes($idProjet){
		$bdd = connect('kitprojet');
		return $bdd->query('SELECT * FROM partiePrenante WHERE idProjet=\''.$idProjet.'\';');
	}
	
	/**
	*	Fonction qui vérifie si la ligne est déjà dans la bdd ou non
	*	/!\ NE SERT PLUS
	*/
	function lineExist($idProjet, $id){
		$bdd = connect('kitprojet');
		$resultat = $bdd->query('SELECT * FROM partiePrenante WHERE idProjet=\''.$idProjet.'\' AND idPartiePrenante=\''.$id.'\';');
		//Si il y a au moins une entrée(normalement il y en a qu'une seule)
		if($resultat->rowCount() > 0) {
			return true;
		}
		return false;
	}
	
	function update($idProjet, $arrayValue){
		$bdd = connect('kitprojet');
		$valuesToUpdate = ' ';
		$valuesToUpdate=$valuesToUpdate.'nom=\''.$arrayValue[1].'\'';
		$valuesToUpdate=$valuesToUpdate.', entite=\''.$arrayValue[2].'\'';
		$valuesToUpdate=$valuesToUpdate.', comite=\''.$arrayValue[3].'\'';
		$valuesToUpdate=$valuesToUpdate.', site=\''.$arrayValue[4].'\'';
		$valuesToUpdate=$valuesToUpdate.', fonction=\''.$arrayValue[5].'\'';
		$valuesToUpdate=$valuesToUpdate.', roleProjet=\''.$arrayValue[6].'\'';
		$valuesToUpdate=$valuesToUpdate.', tel=\''.$arrayValue[7].'\'';
		$valuesToUpdate=$valuesToUpdate.', email=\''.$arrayValue[8].'\'';
		$valuesToUpdate=$valuesToUpdate.', interneExterne=\''.$arrayValue[9].'\'';
		$valuesToUpdate=$valuesToUpdate.', perimetre=\''.$arrayValue[10].'\'';
		$valuesToUpdate=$valuesToUpdate.', classification=\''.$arrayValue[11].'\'';
		echo "UPDATE partiePrenante SET".$valuesToUpdate." WHERE idProjet=\'".$idProjet."\' AND idPartiePrenante=\'".$arrayValue[0]."\';<br/><br/>";
		$bdd->query('UPDATE partiePrenante SET'.$valuesToUpdate.' WHERE idProjet=\''.$idProjet.'\' AND idPartiePrenante=\''.$arrayValue[0].'\';');
	}
	
	function deletePartiePrenanteById($idProjet, $idLigne){
		$bdd = connect('kitprojet');
		delete($bdd,'partiePrenante',$idProjet,'idPartiePrenante',$idLigne);
	}
	
	function insertOrUpdate($idProjet, $arrayValue){
		$bdd = connect('kitprojet');
		if($arrayValue[0]!=0){
			update($idProjet, $arrayValue);
		}
		else {
			$arrayValue[0]=$idProjet;
			insert($bdd,'partiePrenante',$arrayValue);
		}
	}
?>