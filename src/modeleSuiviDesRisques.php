<?php
	require 'outilBdd.php';
	
	function getRisques($idProjet){
		$bdd = connect('kitprojet');
		return $bdd->query('SELECT * FROM risque WHERE idProjet=\''.$idProjet.'\';');
	}
	
	/**
	*	Fonction qui vérifie si la ligne est déjà dans la bdd ou non
	*	/!\ NE SERT PLUS
	*/
	function lineExist($idProjet, $id){
		$bdd = connect('kitprojet');
		$resultat = $bdd->query('SELECT * FROM risque WHERE idProjet=\''.$idProjet.'\' AND idRisque=\''.$id.'\';');
		//Si il y a au moins une entrée(normalement il y en a qu'une seule)
		if($resultat->rowCount() > 0) {
			return true;
		}
		return false;
	}
	
	function update($idProjet, $arrayValue){
		$bdd = connect('kitprojet');
		$valuesToUpdate = ' ';
		$valuesToUpdate=$valuesToUpdate.'theme=\''.$arrayValue[1].'\'';
		$valuesToUpdate=$valuesToUpdate.', chantier=\''.$arrayValue[2].'\'';
		$valuesToUpdate=$valuesToUpdate.', dateIdent=\''.$arrayValue[3].'\'';
		$valuesToUpdate=$valuesToUpdate.', echeance=\''.$arrayValue[4].'\'';
		$valuesToUpdate=$valuesToUpdate.', typeDuRisque=\''.$arrayValue[5].'\'';
		$valuesToUpdate=$valuesToUpdate.', risqueIdentifie=\''.$arrayValue[6].'\'';
		$valuesToUpdate=$valuesToUpdate.', causeDuRisque=\''.$arrayValue[7].'\'';
		$valuesToUpdate=$valuesToUpdate.', detailsIncidencesSurProjet=\''.$arrayValue[8].'\'';
		$valuesToUpdate=$valuesToUpdate.', niveauImpact=\''.$arrayValue[9].'\'';
		$valuesToUpdate=$valuesToUpdate.', probabiliteOccurence=\''.$arrayValue[10].'\'';
		$valuesToUpdate=$valuesToUpdate.', actionAttenuation=\''.$arrayValue[11].'\'';
		$valuesToUpdate=$valuesToUpdate.', acteur=\''.$arrayValue[12].'\'';
		$valuesToUpdate=$valuesToUpdate.', statut=\''.$arrayValue[13].'\'';
		$valuesToUpdate=$valuesToUpdate.', etat=\''.$arrayValue[14].'\'';
		echo "UPDATE risque SET".$valuesToUpdate." WHERE idProjet=\'".$idProjet."\' AND idRisque=\'".$arrayValue[0]."\';<br/><br/>";
		$bdd->query('UPDATE risque SET'.$valuesToUpdate.' WHERE idProjet=\''.$idProjet.'\' AND idRisque=\''.$arrayValue[0].'\';');
	}
	
	function deleteRisqueById($idProjet, $idLigne){
		$bdd = connect('kitprojet');
		delete($bdd,'risque',$idProjet,'idRisque',$idLigne);
	}
	
	function insertOrUpdate($idProjet, $arrayValue){
		$bdd = connect('kitprojet');
		if($arrayValue[0]!=0){
			update($idProjet, $arrayValue);
		}
		else {
			$arrayValue[0]=$idProjet;
			insert($bdd,'risque',$arrayValue);
		}
	}
?>