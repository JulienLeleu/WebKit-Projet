<?php
	require 'outilBdd.php';
	$bdd=connect('kitprojet');
	function getPhases(){
		$array = array();
		global $bdd;
		$request = $bdd->query('SELECT phase, count(*) FROM actionetjalon GROUP BY phase ORDER BY idActionEtJalon ASC;');
		$i=0;
		while($donnees = $request->fetch()){
			//echo $donnees['phase']." ".getDateMin('phase',$donnees['phase'])." ".getDateMax('phase',$donnees['phase']). " nb d'actions :".$donnees['count(*)']."<br/>";
			if(getDateMinByColumn('phase',$donnees['phase'])!= null || getDateMaxByColumn('phase',$donnees['phase'])!= null)
				array_push($array,array($i++,$donnees['phase'],getDateMinByColumn('phase',$donnees['phase']),getDateMaxByColumn('phase',$donnees['phase']),$donnees['count(*)']));
		}
		return $array;
	}
		//dateDebutInitiale	dateFinInitiale	dateDebutRevisee dateFinRevisee
	
function getDateMin(){
		global $bdd;
		$minDebutInitiale = $bdd->query('SELECT MIN((dateDebutInitiale)) FROM actionetjalon WHERE dateDebutInitiale <> \'0000-00-00\';')->fetch()[0];
		$minFinInitiale = $bdd->query('SELECT MIN((dateFinInitiale)) FROM actionetjalon WHERE dateFinInitiale <> \'0000-00-00\'')->fetch()[0];
		$minDebutRevisee = $bdd->query('SELECT MIN((dateDebutRevisee)) FROM actionetjalon WHERE dateDebutRevisee <> \'0000-00-00\'')->fetch()[0];
		$minFinRevisee = $bdd->query('SELECT MIN((dateFinRevisee)) FROM actionetjalon WHERE dateFinRevisee <> \'0000-00-00\'')->fetch()[0];

		return min(array_filter(array($minDebutInitiale,$minFinInitiale,$minDebutRevisee,$minFinRevisee)));;
	}
	
	function getDateMax(){
		global $bdd;
		$maxDebutInitiale = $bdd->query('SELECT MAX((dateDebutInitiale)) FROM actionetjalon WHERE dateDebutInitiale <> \'0000-00-00\';')->fetch()[0];
		$maxFinInitiale = $bdd->query('SELECT MAX((dateFinInitiale)) FROM actionetjalon WHERE dateFinInitiale <> \'0000-00-00\';')->fetch()[0];
		$maxDebutRevisee = $bdd->query('SELECT MAX((dateDebutRevisee)) FROM actionetjalon WHERE dateDebutRevisee <> \'0000-00-00\';')->fetch()[0];
		$maxFinRevisee = $bdd->query('SELECT MAX((dateFinRevisee)) FROM actionetjalon WHERE dateFinRevisee <> \'0000-00-00\';')->fetch()[0];

		return max(array_filter(array($maxDebutInitiale,$maxFinInitiale,$maxDebutRevisee,$maxFinRevisee)));
	}
	
	function getDateMinByColumn($nomColumn,$value){
		global $bdd;
		$minDebutInitiale = $bdd->query('SELECT MIN(dateDebutInitiale) FROM actionetjalon WHERE '.$nomColumn.'=\''.$value.'\' AND dateDebutInitiale <> \'0000-00-00\';')->fetch()[0];
		$minFinInitiale = $bdd->query('SELECT MIN(dateFinInitiale) FROM actionetjalon WHERE '.$nomColumn.'=\''.$value.'\' AND dateFinInitiale <> \'0000-00-00\'')->fetch()[0];
		$minDebutRevisee = $bdd->query('SELECT MIN(dateDebutRevisee) FROM actionetjalon WHERE '.$nomColumn.'=\''.$value.'\' AND dateDebutRevisee <> \'0000-00-00\'')->fetch()[0];
		$minFinRevisee = $bdd->query('SELECT MIN(dateFinRevisee) FROM actionetjalon WHERE '.$nomColumn.'=\''.$value.'\' AND dateFinRevisee <> \'0000-00-00\'')->fetch()[0];
		if(count(array_filter(array($minDebutInitiale,$minFinInitiale,$minDebutRevisee,$minFinRevisee)))>0){
			return min(array_filter(array($minDebutInitiale,$minFinInitiale,$minDebutRevisee,$minFinRevisee)));;
		}
		return null;
	}
	
	function getDateMaxByColumn($nomColumn,$value){
		global $bdd;
		$maxDebutInitiale = $bdd->query('SELECT MAX(dateDebutInitiale) FROM actionetjalon WHERE '.$nomColumn.'=\''.$value.'\' AND dateDebutInitiale <> \'0000-00-00\';')->fetch()[0];
		$maxFinInitiale = $bdd->query('SELECT MAX(dateFinInitiale) FROM actionetjalon WHERE '.$nomColumn.'=\''.$value.'\' AND dateFinInitiale <> \'0000-00-00\';')->fetch()[0];
		$maxDebutRevisee = $bdd->query('SELECT MAX(dateDebutRevisee) FROM actionetjalon WHERE '.$nomColumn.'=\''.$value.'\' AND dateDebutRevisee <> \'0000-00-00\';')->fetch()[0];
		$maxFinRevisee = $bdd->query('SELECT MAX(dateFinRevisee) FROM actionetjalon WHERE '.$nomColumn.'=\''.$value.'\' AND dateFinRevisee <> \'0000-00-00\';')->fetch()[0];
		if(count(array_filter(array($maxDebutInitiale,$maxFinInitiale,$maxDebutRevisee,$maxFinRevisee)))){
			return max(array_filter(array($maxDebutInitiale,$maxFinInitiale,$maxDebutRevisee,$maxFinRevisee)));
		}
		return null;
	}
?>