<?php
	/**
	*	Fonction qui affiche le menu avec le bon onglet d'ouvert en fonction du paramètre passé
	*	@context: numéro de l'onglet ouvert( ex: pour tdb context = 1)
	*/
	function getNav($context){
		$result ='';
		$onglets = array(
			'<li><a href="tdb.php"><span class="glyphicon glyphicon-home"></span></a></li>',
			'<li><a href="#">Fiche projet</a></li>',
			'<li><a href="roadMap.php">RoadMap</a></li>',
			'<li><a href="listeJalonsEtActions.php">Jalons et actions</a></li>',
			'<li><a href="suiviDesRisques.php">Suivi des risques</a></li>',
			'<li><a href="budget.php">Budget</a></li>',
			'<li><a href="#">Plan de charge</a></li>',
			'<li><a href="partiesPrenantes.php">Parties prenantes</a></li>',
			'<li><a href="#"><span class="glyphicon glyphicon-cog"></span></a></li>'
		);
		switch($context){
			case 1:
				$onglets[$context-1] = '<li class="active"><a href="tdb.php"><span class="glyphicon glyphicon-home"></span></a></li>';
			break;
			case 2:
				$onglets[$context-1] = '<li class="active"><a href="#">Fiche projet</a></li>';
			break;
			case 3:
				$onglets[$context-1] = '<li class="active"><a href="roadMap.php">RoadMap</a></li>';
			break;
			case 4:
				$onglets[$context-1] = '<li class="active"><a href="listeJalonsEtActions.php">Jalons et actions</a></li>';
			break;
			case 5:
				$onglets[$context-1] = '<li class="active"><a href="suiviDesRisques.php">Suivi des risques</a></li>';
			break;
			case 6:
				$onglets[$context-1] = '<li class="active"><a href="budget.php">Budget</a></li>';
			break;
			case 7:
				$onglets[$context-1] = '<li class="active"><a href="#">Plan de charge</a></li>';
			break;
			case 8:
				$onglets[$context-1] = '<li class="active"><a href="partiesPrenantes.php">Parties prenantes</a></li>';
			break;
			case 9:
				$onglets[$context-1] = '<li class="active"><a href="#"><span class="glyphicon glyphicon-cog"></span></a></li>';
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