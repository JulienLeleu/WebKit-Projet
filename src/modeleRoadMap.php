<?php
	require 'outilBdd.php';
	$bdd=connect('kitprojet');
	function getPhases(){
		$array = array();
		global $bdd;
		$request = $bdd->query('SELECT phase, count(*) FROM actionetjalon WHERE idProjet=\''.$_SESSION['idProjet'].'\' GROUP BY phase ORDER BY idActionEtJalon ASC;');
		while($donnees = $request->fetch()){
			$actions=getActions($donnees['phase']);
			$array[]=array($donnees['phase'],$actions);
		}
		return $array;
	}
	
	function getActions($phase){
		global $bdd;
		$actions = $bdd->query('SELECT * FROM actionetjalon WHERE idProjet=\''.$_SESSION['idProjet'].'\' AND phase=\''.$phase.'\';');
		return $actions;
	}
?>