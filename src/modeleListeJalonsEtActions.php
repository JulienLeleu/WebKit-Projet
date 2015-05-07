<?php
	require 'outilBdd.php';
	$bdd=connect('kitProjet');

	function update($idProjet, $arrayValue){
		global $bdd;
		$valuesToUpdate = ' ';
		$valuesToUpdate=$valuesToUpdate.'intitule=\''.$arrayValue[1].'\'';
		$valuesToUpdate=$valuesToUpdate.', phase=\''.$arrayValue[2].'\'';
		$valuesToUpdate=$valuesToUpdate.', theme=\''.$arrayValue[3].'\'';
		$valuesToUpdate=$valuesToUpdate.', chantier=\''.$arrayValue[4].'\'';
		$valuesToUpdate=$valuesToUpdate.', env=\''.$arrayValue[5].'\'';
		$valuesToUpdate=$valuesToUpdate.', alerteVers=\''.$arrayValue[6].'\'';
		$valuesToUpdate=$valuesToUpdate.', fournisseur=\''.$arrayValue[7].'\'';
		$valuesToUpdate=$valuesToUpdate.', responsable=\''.$arrayValue[8].'\'';
		$valuesToUpdate=$valuesToUpdate.', type=\''.$arrayValue[9].'\'';
		$valuesToUpdate=$valuesToUpdate.', dateDebutInitiale=\''.$arrayValue[10].'\'';
		$valuesToUpdate=$valuesToUpdate.', dateFinInitiale=\''.$arrayValue[11].'\'';
		$valuesToUpdate=$valuesToUpdate.', dateDebutRevisee=\''.$arrayValue[12].'\'';
		$valuesToUpdate=$valuesToUpdate.', dateFinRevisee=\''.$arrayValue[13].'\'';
		$valuesToUpdate=$valuesToUpdate.', ponderation=\''.$arrayValue[14].'\'';
		$valuesToUpdate=$valuesToUpdate.', statut=\''.$arrayValue[15].'\'';
		$valuesToUpdate=$valuesToUpdate.', dependDe=\''.$arrayValue[16].'\'';
		$valuesToUpdate=$valuesToUpdate.', commentaires=\''.$arrayValue[17].'\'';
		//echo "UPDATE actionEtJalon SET".$valuesToUpdate." WHERE idProjet=\'".$idProjet."\' AND idActionEtJalon=\'".$arrayValue[0]."\';<br/><br/>";
		$bdd->query('UPDATE actionEtJalon SET'.$valuesToUpdate.' WHERE idProjet=\''.$idProjet.'\' AND idActionEtJalon=\''.$arrayValue[0].'\';');
	}
	
	function deleteActionEtJalonById($idProjet, $idLigne){
		global $bdd;
		delete($bdd,'actionetjalon',$idProjet,'idActionEtJalon',$idLigne);
	}
	
	function getDateMin(){
		global $bdd;
		$minDebutInitiale = $bdd->query('SELECT MIN(YEAR(dateDebutInitiale)) FROM actionetjalon WHERE dateDebutInitiale <> \'0000-00-00\';')->fetch()[0];
		$minFinInitiale = $bdd->query('SELECT MIN(YEAR(dateFinInitiale)) FROM actionetjalon WHERE dateFinInitiale <> \'0000-00-00\'')->fetch()[0];
		$minDebutRevisee = $bdd->query('SELECT MIN(YEAR(dateDebutRevisee)) FROM actionetjalon WHERE dateDebutRevisee <> \'0000-00-00\'')->fetch()[0];
		$minFinRevisee = $bdd->query('SELECT MIN(YEAR(dateFinRevisee)) FROM actionetjalon WHERE dateFinRevisee <> \'0000-00-00\'')->fetch()[0];

		return min(array_filter(array($minDebutInitiale,$minFinInitiale,$minDebutRevisee,$minFinRevisee)));;
	}
	
	function getDateMax(){
		global $bdd;
		$maxDebutInitiale = $bdd->query('SELECT MAX(YEAR(dateDebutInitiale)) FROM actionetjalon WHERE dateDebutInitiale <> \'0000-00-00\';')->fetch()[0];
		$maxFinInitiale = $bdd->query('SELECT MAX(YEAR(dateFinInitiale)) FROM actionetjalon WHERE dateFinInitiale <> \'0000-00-00\';')->fetch()[0];
		$maxDebutRevisee = $bdd->query('SELECT MAX(YEAR(dateDebutRevisee)) FROM actionetjalon WHERE dateDebutRevisee <> \'0000-00-00\';')->fetch()[0];
		$maxFinRevisee = $bdd->query('SELECT MAX(YEAR(dateFinRevisee)) FROM actionetjalon WHERE dateFinRevisee <> \'0000-00-00\';')->fetch()[0];

		return max(array_filter(array($maxDebutInitiale,$maxFinInitiale,$maxDebutRevisee,$maxFinRevisee)));
	}
	
	function insertOrUpdate($idProjet, $arrayValue){
		global $bdd;
		if($arrayValue[0]!=0){
			update($idProjet, $arrayValue);
		}
		else {
			$arrayValue[0]=$idProjet;
			insert($bdd,'actionEtJalon',$arrayValue);
		}
	}
?>