<?php
	//Contient les fonctions qui récupérent les informations de la BDD
	require 'modeleAccueil.php';
	
	//Si une recherche avec critère a été effectué, alors on affiche la liste des projets prenant en compte ces critères
	if(isset($_GET['spm']) || isset($_GET['am']) || isset($_GET['programme']) || isset($_GET['statut'])){
		$listeProjets = getProjets($bdd,$_GET['spm'], $_GET['am'], $_GET['programme'], $_GET['statut']);
	}
	//Sinon on affiche tout
	else {
		$listeProjets = selectAll($bdd,'projet');
	}
	//Contient la vue de l'ecran d'accueil : Elle génére notamment la liste des projets à partir de la variable $listeProjet
	require 'vueAccueil.php';
?>