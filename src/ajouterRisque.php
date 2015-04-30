<?php
	require 'modeleInterfaceProjet.php';
	require 'modeleSuiviDesRisques.php';
	if(isset($_POST['idRisque'])){
		$nbLignes = count($_POST['idRisque']);
	}
	else {
		$nbLignes = 0;
	}

	if($nbLignes>0){
		for($i=0; $i<$nbLignes; $i++){
			if(isset($_POST['trash'.($i+1)])){
				deleteRisqueById($_SESSION['idProjet'], $_POST['idRisque'][$i]);
			}
			else {
				$theme = isset( $_POST['theme'][$i] ) ?  $_POST['theme'][$i] : NULL;
				$chantier = isset( $_POST['chantier'][$i] ) ?  $_POST['chantier'][$i] : NULL;
				$dateIdent = isset( $_POST['dateIdent'][$i] ) ?  $_POST['dateIdent'][$i] : NULL;
				$echeance = isset( $_POST['echeance'][$i] ) ?  $_POST['echeance'][$i] : NULL;
				$alerteVers = isset( $_POST['alerteVers'][$i] ) ?  $_POST['alerteVers'][$i] : NULL;
				$typeDuRisque = isset( $_POST['typeDuRisque'][$i] ) ?  $_POST['typeDuRisque'][$i] : NULL;
				$risqueIdentifie = isset( $_POST['risqueIdentifie'][$i] ) ?  $_POST['risqueIdentifie'][$i] : NULL;
				$causeDuRisque = isset( $_POST['causeDuRisque'][$i] ) ?  $_POST['causeDuRisque'][$i] : NULL;
				$niveauImpact = isset( $_POST['niveauImpact'][$i] ) ?  $_POST['niveauImpact'][$i] : NULL;
				$detailsIncidencesSurProjet = isset( $_POST['detailsIncidencesSurProjet'][$i] ) ?  $_POST['detailsIncidencesSurProjet'][$i] : NULL;
				$probabiliteOccurence = isset( $_POST['probabiliteOccurence'][$i] ) ?  $_POST['probabiliteOccurence'][$i] : NULL;
				$actionAttenuation = isset( $_POST['actionAttenuation'][$i] ) ?  $_POST['actionAttenuation'][$i] : NULL;
				$acteur = isset( $_POST['acteur'][$i] ) ?  $_POST['acteur'][$i] : NULL;
				$statut = isset( $_POST['statut'][$i] ) ?  $_POST['statut'][$i] : NULL;
				$etat = isset( $_POST['etat'][$i] ) ?  $_POST['etat'][$i] : NULL;
				insertOrUpdate($_SESSION['idProjet'], array($_POST['idRisque'][$i], $theme, $chantier, $dateIdent, $echeance, $alerteVers, $typeDuRisque, $risqueIdentifie, $causeDuRisque, $detailsIncidencesSurProjet, $niveauImpact, $probabiliteOccurence, $actionAttenuation, $acteur, $statut, $etat));
			}
		}
	}
	header('Location: suiviDesRisques.php');
?>