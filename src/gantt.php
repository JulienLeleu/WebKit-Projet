<?php
		require('ganttGraph.php');
		$echelle = "mois";
		if(isset($_GET['echelle'])){
			$echelle = $_GET['echelle'];
		}
		$ganttGraph = new GanttGraph($echelle);
		
		$phases = getPhases();
		foreach($phases as $phase){
			$actions = array();
			foreach($phase[1] as $action){
				if($action['dateDebutRevisee'] == '0000-00-00'){
					if($action['dateDebutInitiale'] == '0000-00-00'){
						$dateDebut='';
					}
					else{
						$dateDebut=new DateTime($action['dateDebutInitiale']);
					}
				}
				else {
					$dateDebut=new DateTime($action['dateDebutRevisee']);
				}
				if($action['dateFinRevisee'] == '0000-00-00'){
					if($action['dateFinInitiale'] == '0000-00-00'){
						$dateFin='';
					}
					else {
						$dateFin=new DateTime($action['dateFinInitiale']);
					}
				}
				else {
					$dateFin=new DateTime($action['dateFinRevisee']);
				}
				
				if($action['dateDebutInitiale'] != '0000-00-00' || $action['dateFinInitiale'] != '0000-00-00')
					$actions[]=new GanttAction($action['intitule'],$dateDebut, $dateFin);
			}
			$ganttGraph->add(new GanttPhase($phase[0],$actions));
		}
		$ganttGraph->display();
		
		
		/*require('ganttGraph.php');
		$ganttGraph = new GanttGraph();
		$ganttGraph->add(new GanttPhase('test',array()));
		$ganttPhase = new GanttPhase('Cadrage',array(new GanttAction('Initialisation du projet',new DateTime('2015-02-21'),new DateTime('2015-06-24')),new GanttAction('Executive summary',new DateTime('2015-10-20'),new DateTime('2016-04-10'))));
		$ganttPhase2 = new GanttPhase('Etude',array(new GanttAction('PROTO - Environnement',new DateTime('2015-09-21'),new DateTime('2015-08-10')),new GanttAction('HOT - Comparatif VM/Physique',new DateTime('2015-10-20'),new DateTime('2016-01-10')),new GanttAction('Preview',new DateTime('2015-04-20'),new DateTime('2015-05-10'))));
		$ganttPhase3 = new GanttPhase('Deploiement appli',array(new GanttAction('Environnement','',new DateTime('2015-03-1')),new GanttAction('Livraison des PA',new DateTime('2015-04-20'),new DateTime('2015-04-10')),new GanttAction('PV de fin de tests',new DateTime('2015-04-20'),new DateTime('2015-05-10'))));
		$ganttPhase4 = new GanttPhase('Tests unitaires',array(new GanttAction('Mise en place de PHPUnit',new DateTime('2015-08-1'),new DateTime('2015-12-10'))));
		$ganttGraph->add($ganttPhase);
		$ganttGraph->add($ganttPhase2);
		$ganttGraph->add($ganttPhase3);
		$ganttGraph->add($ganttPhase4);
		$ganttGraph->display();*/
?>