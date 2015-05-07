<?php
	require 'outilBdd.php';
	$bdd = connect('kitprojet');
	
	function update($idProjet, $arrayValue){
		global $bdd;
		$valuesToUpdate = ' ';
		$valuesToUpdate=$valuesToUpdate.'theme=\''.$arrayValue[1].'\'';
		$valuesToUpdate=$valuesToUpdate.', chantier=\''.$arrayValue[2].'\'';
		$valuesToUpdate=$valuesToUpdate.', dateIdent=\''.$arrayValue[3].'\'';
		$valuesToUpdate=$valuesToUpdate.', echeance=\''.$arrayValue[4].'\'';
		$valuesToUpdate=$valuesToUpdate.', alerteVers=\''.$arrayValue[5].'\'';
		$valuesToUpdate=$valuesToUpdate.', typeDuRisque=\''.$arrayValue[6].'\'';
		$valuesToUpdate=$valuesToUpdate.', risqueIdentifie=\''.$arrayValue[7].'\'';
		$valuesToUpdate=$valuesToUpdate.', causeDuRisque=\''.$arrayValue[8].'\'';
		$valuesToUpdate=$valuesToUpdate.', detailsIncidencesSurProjet=\''.$arrayValue[9].'\'';
		$valuesToUpdate=$valuesToUpdate.', niveauImpact=\''.$arrayValue[10].'\'';
		$valuesToUpdate=$valuesToUpdate.', probabiliteOccurence=\''.$arrayValue[11].'\'';
		$valuesToUpdate=$valuesToUpdate.', actionAttenuation=\''.$arrayValue[12].'\'';
		$valuesToUpdate=$valuesToUpdate.', acteur=\''.$arrayValue[13].'\'';
		$valuesToUpdate=$valuesToUpdate.', statut=\''.$arrayValue[14].'\'';
		$valuesToUpdate=$valuesToUpdate.', etat=\''.$arrayValue[15].'\'';
		//echo "UPDATE risque SET".$valuesToUpdate." WHERE idProjet=\'".$idProjet."\' AND idRisque=\'".$arrayValue[0]."\';<br/><br/>";
		$bdd->query('UPDATE risque SET'.$valuesToUpdate.' WHERE idProjet=\''.$idProjet.'\' AND idRisque=\''.$arrayValue[0].'\';');
	}
	
	function deleteRisqueById($idProjet, $idLigne){
		global $bdd;
		delete($bdd,'risque',$idProjet,'idRisque',$idLigne);
	}
	
	function insertOrUpdate($idProjet, $arrayValue){
		global $bdd;
		if($arrayValue[0]!=0){
			update($idProjet, $arrayValue);
		}
		else {
			$arrayValue[0]=$idProjet;
			insert($bdd,'risque',$arrayValue);
		}
	}
?>