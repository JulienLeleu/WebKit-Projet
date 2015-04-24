<?php

require 'outilBdd.php';
$bdd = connect('kitprojet');
// TO DO : Créer les fonctions qui serviront à récuperer la liste des projets

	/**
	*	Fonction qui permet de faire une recherche multi-critères de projet(s)
	*	@param: les paramètres sont les criteres du projet
	*/
	function getProjets($bdd,$spm,$am,$programme,$statut){
		$request = '';
		$query='SELECT * FROM projet;';
		
		if(exist($bdd,'projet')){
			$nbCritere = 0;
			$critere=' WHERE ';
			if(!empty($spm)){
				$nbCritere++;
				if($nbCritere>1){
					$critere=$critere.'AND spm=\''.$spm.'\'';
				}
				else {
					$critere=$critere.'spm=\''.$spm.'\'';
				}
			}
			if(!empty($am)){
				$nbCritere++;
				if($nbCritere>1){
					$critere=$critere.'AND am=\''.$am.'\'';
				}
				else {
					$critere=$critere.'am=\''.$am.'\'';
				}
			}
			if(!empty($programme)){
				$nbCritere++;
				if($nbCritere>1){
					$critere=$critere.'AND programme=\''.$programme.'\'';
				}
				else {
					$critere=$critere.'programme=\''.$programme.'\'';
				}
			}
			if(!empty($statut)){
				$nbCritere++;
				if($nbCritere>1){
					$critere=$critere.'AND statut=\''.$statut.'\'';
				}
				else {
					$critere=$critere.'statut=\''.$statut.'\'';
				}
			}
			if($nbCritere>0) {
				$query='SELECT * FROM projet'.$critere.';';
			}
			else {
				$query='SELECT * FROM projet;';
			}
		}
		$request = $bdd->query($query);
		return $request;
	}
?>