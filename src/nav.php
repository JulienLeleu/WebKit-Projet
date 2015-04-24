<?php
	/**
	*	Fonction qui affiche le menu avec le bon onglet d'ouvert en fonction du paramètre passé
	*	@context: numéro de l'onglet ouvert( ex: pour tdb context = 1)
	*/
	function getNav($context){
		$result ='';
		$onglets = array(
			'<li><a href="tdb.php"><span class="glyphicon glyphicon-home"></span> Tableau de bord</a></li>',
			'<li><a href="#">Fiche projet</a></li>',
			'<li><a href="#">RoadMap</a></li>',
			'<li><a href="#">Liste jalons/actions</a></li>',
			'<li><a href="#">Suivi des risques</a></li>',
			'<li><a href="#">Budget</a></li>',
			'<li><a href="#">Plan de charge</a></li>',
			'<li><a href="partiesPrenantes.php">Parties prenantes</a></li>',
			'<li><a href="#"><span class="glyphicon glyphicon-cog"></span> Paramètres</a></li>'
		);
		switch($context){
			case 1:
				$onglets[$context-1] = '<li class="active"><a href="tdb.php"><span class="glyphicon glyphicon-home"></span> Tableau de bord</a></li>';
			break;
			case 2:
				$onglets[$context-1] = '<li class="active"><a href="#">Fiche projet</a></li>';
			break;
			case 3:
				$onglets[$context-1] = '<li class="active"><a href="#">RoadMap</a></li>';
			break;
			case 4:
				$onglets[$context-1] = '<li class="active"><a href="#">Liste jalons/actions</a></li>';
			break;
			case 5:
				$onglets[$context-1] = '<li class="active"><a href="#">Suivi des risques</a></li>';
			break;
			case 6:
				$onglets[$context-1] = '<li class="active"><a href="#">Budget</a></li>';
			break;
			case 7:
				$onglets[$context-1] = '<li class="active"><a href="#">Plan de charge</a></li>';
			break;
			case 8:
				$onglets[$context-1] = '<li class="active"><a href="partiesPrenantes.php">Parties prenantes</a></li>';
			break;
			case 9:
				$onglets[$context-1] = '<li class="active"><a href="#"><span class="glyphicon glyphicon-cog"></span> Paramètres</a></li>';
			break;
		}
		
		$result = $result . '<nav>';
		$result = $result . '<ul class="nav nav-tabs">';
		for($i = 0; $i<count($onglets); $i++) {
			$result = $result . $onglets[$i];
		}
		$result = $result . '</ul>';
		$result = $result . '</nav>';
		echo $result;
	}
?>