<?php
	require 'modeleInterfaceProjet.php';
	require 'modeleListeJalonsEtActions.php';
	if(isset($_POST['idActionEtJalon'])){
		$nbLignes = count($_POST['idActionEtJalon']);
	}
	else {
		$nbLignes = 0;
	}

	if($nbLignes>0){
		for($i=0; $i<$nbLignes; $i++){
			if(isset($_POST['trash'.($i+1)])){
				deleteActionEtJalonById($_SESSION['idProjet'], $_POST['idActionEtJalon'][$i]);
			}
			else {
				$intitule = isset( $_POST['intitule'][$i] ) ?  $_POST['intitule'][$i] : NULL;
				$phase = isset( $_POST['phase'][$i] ) ?  $_POST['phase'][$i] : NULL;
				$theme = isset( $_POST['theme'][$i] ) ?  $_POST['theme'][$i] : NULL;
				$chantier = isset( $_POST['chantier'][$i] ) ?  $_POST['chantier'][$i] : NULL;
				$env = isset( $_POST['env'][$i] ) ?  $_POST['env'][$i] : NULL;
				$alerteVers = isset( $_POST['alerteVers'][$i] ) ?  $_POST['alerteVers'][$i] : NULL;
				$fournisseur = isset( $_POST['fournisseur'][$i] ) ?  $_POST['fournisseur'][$i] : NULL;
				$responsable = isset( $_POST['responsable'][$i] ) ?  $_POST['responsable'][$i] : NULL;
				$type = isset( $_POST['type'][$i] ) ?  $_POST['type'][$i] : NULL;
				$dateDebutInitiale = isset( $_POST['dateDebutInitiale'][$i] ) ?  dateDMYtoYMD($_POST['dateDebutInitiale'][$i]) : NULL;
				$dateFinInitiale = isset( $_POST['dateFinInitiale'][$i] ) ?  dateDMYtoYMD($_POST['dateFinInitiale'][$i]) : NULL;
				$dateDebutRevisee = isset( $_POST['dateDebutRevisee'][$i] ) ?  dateDMYtoYMD($_POST['dateDebutRevisee'][$i]) : NULL;
				$dateFinRevisee = isset( $_POST['dateFinRevisee'][$i] ) ?  dateDMYtoYMD($_POST['dateFinRevisee'][$i]) : NULL;
				$ponderation = isset( $_POST['ponderation'][$i] ) ?  $_POST['ponderation'][$i] : NULL;
				$statut = isset( $_POST['statut'][$i] ) ?  $_POST['statut'][$i] : NULL;
				$dependDe = isset( $_POST['dependDe'][$i] ) ?  $_POST['dependDe'][$i] : NULL;
				$commentaires = isset( $_POST['commentaires'][$i] ) ?  $_POST['commentaires'][$i] : NULL;
				insertOrUpdate($_SESSION['idProjet'], array($_POST['idActionEtJalon'][$i], $intitule, $phase, $theme, $chantier, $env, $alerteVers, $fournisseur, $responsable, $type, $dateDebutInitiale, $dateFinInitiale, $dateDebutRevisee, $dateFinRevisee, $ponderation, $statut, $dependDe, $commentaires));
			}
		}
	}
	header('Location: listeJalonsEtActions.php');
?>