<?php
	include('modeleInterfaceProjet.php');
	require 'modeleSuiviDesRisques.php';
	$tableauRisques= getRisques($_SESSION['idProjet']);
	require 'nav.php';
	require 'vueSuiviDesRisques.php';
?>