<?php
	include('modeleInterfaceProjet.php');
	require 'modelePartiesPrenantes.php';
	$tableauPartiePrenante = getPartiesPrenantes($_SESSION['idProjet']);
	
	require 'nav.php';
	require 'vuePartiesPrenantes.php';
?>