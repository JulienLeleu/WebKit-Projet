<?php
	session_start();
	if(isset($_GET['idProjet']) || isset($_SESSION['idProjet'])){
		if(isset($_GET['idProjet']))
		$_SESSION['idProjet']=$_GET['idProjet'];
	}
	else {
		header('Location: accueil.php');
	}
?>