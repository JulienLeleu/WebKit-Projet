<?php
	require 'modeleInterfaceProjet.php';
	require 'modelePartiesPrenantes.php';
	if(isset($_POST['idPartiePrenante'])){
		$nbLignes = count($_POST['idPartiePrenante']);
	}
	else {
		$nbLignes = 0;
	}

	if($nbLignes>0){
		for($i=0; $i<$nbLignes; $i++){
			$trash = isset( $_POST['trash'][$i] ) ?  $_POST['trash'][$i] : false;
			if($trash == true){
				deletePartiePrenanteById($_SESSION['idProjet'], $_POST['idPartiePrenante'][$i]);
			}
			else {
				$nom = isset( $_POST['nom'][$i] ) ?  $_POST['nom'][$i] : NULL;
				$entite = isset( $_POST['entite'][$i] ) ?  $_POST['entite'][$i] : NULL;
				$comite = isset( $_POST['comite'][$i] ) ?  $_POST['comite'][$i] : NULL;
				$site = isset( $_POST['site'][$i] ) ?  $_POST['site'][$i] : NULL;
				$fonction = isset( $_POST['fonction'][$i] ) ?  $_POST['fonction'][$i] : NULL;
				$role = isset( $_POST['role'][$i] ) ?  $_POST['role'][$i] : NULL;
				$tel = isset( $_POST['tel'][$i] ) ?  $_POST['tel'][$i] : NULL;
				$email = isset( $_POST['email'][$i] ) ?  $_POST['email'][$i] : NULL;
				$interneExterne = isset( $_POST['interneExterne'][$i] ) ?  $_POST['interneExterne'][$i] : NULL;
				$perimetre = isset( $_POST['perimetre'][$i] ) ?  $_POST['perimetre'][$i] : NULL;
				$classification = isset( $_POST['classification'][$i] ) ?  $_POST['classification'][$i] : NULL;
				insertOrUpdate($_SESSION['idProjet'], array($_POST['idPartiePrenante'][$i], $nom, $entite, $comite, $site, $fonction, $role, $tel, $email, $interneExterne, $perimetre, $classification));
			}
		}
	}
	header('Location: partiesPrenantes.php');
?>