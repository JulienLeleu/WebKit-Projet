<?php
	require 'outilBdd.php';
	$bdd = connect('kitprojet');
	
	function update($idProjet, $arrayValue){
		global $bdd;
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
		global $bdd;
		delete($bdd,'partiePrenante',$idProjet,'idPartiePrenante',$idLigne);
	}
	
	function insertOrUpdate($idProjet, $arrayValue){
		global $bdd;
		if($arrayValue[0]!=0){
			update($idProjet, $arrayValue);
		}
		else {
			$arrayValue[0]=$idProjet;
			insert($bdd,'partiePrenante',$arrayValue);
		}
	}
?>