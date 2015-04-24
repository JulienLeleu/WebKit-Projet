<?php
	include('outilBDD.php');
	$bdd = connect('kitprojet');
	insert($bdd,'projet', array($_GET['nomProjet'], $_GET['spm'], $_GET['budget'], $_GET['am'], $_GET['dib'], $_GET['idMfu'], $_GET['programme'], $_GET['domaine']));
	header('Location: accueil.php');
?>