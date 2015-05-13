<?php
	/*define("TAILLE_MOIS", 70);
	$date1 = new DateTime(getDateMin());
	$date2 = new DateTime(getDateMax());
	$j=0;
	for($i=new DateTime($date1->format('d-m-Y'));$i<=$date2;$i->modify('+1 month')){
		$j++;
	}
	//prévoir une fonction qui calcule la taille du SVG
	echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"".($j*TAILLE_MOIS)."\" height=\"500\">";
	$j=0;
	$dateTmp=new DateTime($date1->format('d-m-Y'));
	for($i=new DateTime($date1->format('d-m-Y'));$i<=$date2;$i->modify('+1 month')){
		echo '<rect class="rectAnnee" x="'.($j*TAILLE_MOIS).'" y="5" width="'.TAILLE_MOIS.'" height="20"/>';
		if($i==$date1 || $i->format('Y')!=$dateTmp->format('Y')){
			echo '<text id="annee" x="'.($j*TAILLE_MOIS).'" y="20" >'.$i->format('Y').'</text>';
		}
			
		echo '<rect class="rectMois" x="'.($j*TAILLE_MOIS).'" y="25" width="'.TAILLE_MOIS.'" height="20"/>';
		
		echo '<rect x="'.($j*TAILLE_MOIS).'" y="45" width="'.TAILLE_MOIS.'" height="600"/>';	
		echo '<text x="'.($j*TAILLE_MOIS).'" y="40" >'.$i->format('M-Y').'</text>';
		$dateTmp=new DateTime($i->format('d-m-Y'));
		$j++;
	}
	echo '<rect id="test" class="rectMois" x="0" y="50" width="'.(getPosDate(new DateTime('2015-10-28'))).'" height="20"/>';	
	echo '</svg>';
	
	function getPosDate($date){
		global $date1;
		global $date2;
		$x=0;
		$nbMonth=0;
		$i=new DateTime($date1->format('Y-m').'-1');
		while($i->format('Y-m')<$date->format('Y-m')){
			$nbMonth++;
			$i->modify('+1 month');
		}
		$x=(TAILLE_MOIS*($nbMonth-1)) + TAILLE_MOIS*($date->format('d')/31);
		return $x;
	}*/
		require('ganttGraph.php');
		$ganttGraph = new GanttGraph();
		$ganttPhase = new GanttPhase('Test',array(new GanttAction('actionTest',new DateTime('2015-10-21'),new DateTime('2016-12-10')),new GanttAction('actionTest',new DateTime('2015-10-20'),new DateTime('2016-12-10'))));
		$ganttPhase2 = new GanttPhase('Test2',array(new GanttAction('actionTest',new DateTime('2015-09-21'),new DateTime('2016-12-10')),new GanttAction('actionTest',new DateTime('2015-10-20'),new DateTime('2016-12-10'))));
		$ganttGraph->add($ganttPhase);
		$ganttGraph->add($ganttPhase2);
		$ganttGraph->display();
	?>