<?php
	define('WIDTH',70);
	define('MARGIN',5);
	define('HEIGHT',15);
	define('MARGIN_TEXT',10);
/*
	L'objet ganttGraph est l'objet qui permet de générer le diagramme de GanttAction
	Grâce aux fonction Add on peut lui ajouter des Phases, qui elles même peuvent contenir des
	actions et jalons
*/
class GanttGraph {
	private $ganttLegende;
	private $listePhases = array();
	private $dateDebut;
	private $dateFin;
	private $width = 0;
	private $height = 0;
	private $widthUnity = WIDTH;
	private $typeAffichage = "mois";
	
	public function __construct($typeAffichage){
		$this->typeAffichage=$typeAffichage;
		$this->initWidth();
	}
	
	/*fonction qui permet d'ajouter des elements au graphe, notamment des phases*/
	public function add($element){
		$this->listePhases[]=$element;
		$this->majDates();
	}
	
	/*fonction qui génére l'affichage du diagramme de GANTT*/
	function display(){
		$this->initPlanning();
		echo '<svg height="'.$this->height.'" width="'.$this->width.'">';
		/*Affichage de la légende*/
		$i=0;$j=0;$k=0;$widthTmp=0;$widthSemaineTmp=0;
		foreach($this->ganttLegende->getAnnees() as $annee){
			echo '<rect x="'.$widthTmp.'" y="0" width="'.$this->widthUnity*count($annee->getMois()).'" height="'.$this->height.'"/>';
			echo '<rect class="rectAnnee" x="'.$widthTmp.'" y="0" width="'.$this->widthUnity*count($annee->getMois()).'" height="'.HEIGHT.'"/>';
			echo '<text id="annee" x="'.$widthTmp.'" y="'.MARGIN_TEXT.'" >'.$annee->getAnnee().'</text>';
			foreach($annee->getMois() as $mois){
				if($this->typeAffichage != "annee" && $this->typeAffichage != "y"){
						echo '<rect x="'.($j*$this->widthUnity).'" y="'.HEIGHT.'" width="'.$this->widthUnity.'" height="'.$this->height.'"/>';
						echo '<rect class="rectMois" x="'.($j*$this->widthUnity).'" y="'.HEIGHT.'" width="'.$this->widthUnity.'" height="'.HEIGHT.'"/>';
						echo '<text x="'.($j*$this->widthUnity).'" y="'.(MARGIN + 2*MARGIN_TEXT).'" >'.$mois->getMois().'</text>';

					if($this->typeAffichage != "mois" && $this->typeAffichage != "m"){
						foreach($mois->getSemaines() as $semaine){
							echo '<rect x="'.($widthSemaineTmp).'" y="'.(2*HEIGHT).'" width="'.($this->widthUnity/4).'" height="'.$this->height.'"/>';
							echo '<rect class="rectMois" x="'.($widthSemaineTmp).'" y="'.(HEIGHT+HEIGHT).'" width="'.($this->widthUnity/4).'" height="'.HEIGHT.'"/>';
							echo '<text x="'.($widthSemaineTmp).'" y="'.(HEIGHT + MARGIN + 2*MARGIN_TEXT).'" >'.$semaine.'</text>';
							$k++;
							$widthSemaineTmp+=$this->widthUnity/4;
						}
					}
				}
				$j++;
			}
			$i++;
			$widthTmp+=$this->widthUnity*count($annee->getMois());
		}
		/*Affichage des phases*/
		$k=0;
		foreach($this->listePhases as $phase) {
			//Pour dessiner la fleche
			if($phase->getWidth()-10 >0){
				$tailleFleche = 10;
			}
			else {
				$tailleFleche = $phase->getWidth() - ($phase->getWidth()*0.80);
			}
			echo '<polygon id="rectPhase" points="'.$phase->getPositionX().','.($phase->getPositionY()).' '.$phase->getPositionX().','.($phase->getPositionY()+$phase->getHeight()).' '.($phase->getWidth() + $phase->getPositionX()-$tailleFleche).','.($phase->getPositionY() + $phase->getHeight()).' '.($phase->getWidth() + $phase->getPositionX()).','.($phase->getPositionY() + $phase->getHeight()/2).' '.($phase->getWidth() + $phase->getPositionX()-$tailleFleche).','.($phase->getPositionY()).'" />';
			echo '<text id="phase" x="'.$phase->getPositionX().'" y="'. (MARGIN_TEXT + $phase->getPositionY()).'">'.$phase->getNom().'</text>';
			/*Affichage des actions et jalons*/
			foreach($phase->getActions() as $action){
				//Si c'est un jalon, c'est à dire si il a une date de debut > date de Fin
				if($action->getDateDebut()<$action->getDateFin() && $action->getDateDebut()!=null){
					//Pour dessiner la fleche
					$tailleFleche = 10;
					//Si la taille du rectangle fait plus de 10 pixels
					if($action->getWidth()-10 >0){
						echo '<polygon id="rectActions" points="'.$action->getPositionX().','.($action->getPositionY()+MARGIN).' '.$action->getPositionX().','.($action->getPositionY()+$action->getHeight()+MARGIN).' '.($action->getWidth() + $action->getPositionX()-$tailleFleche).','.($action->getPositionY() + $action->getHeight() + MARGIN).' '.($action->getWidth() + $action->getPositionX()).','.($action->getPositionY() + $action->getHeight()/2 + MARGIN).' '.($action->getWidth() + $action->getPositionX()-$tailleFleche).','.($action->getPositionY()+MARGIN).'" />';
					}
					//Sinon on affiche juste un triangle
					else {
						echo '<polygon id="rectActions" points="'.($action->getWidth() + $action->getPositionX()-$tailleFleche).','.($action->getPositionY() + $action->getHeight() + MARGIN).' '.($action->getWidth() + $action->getPositionX()).','.($action->getPositionY() + $action->getHeight()/2 + MARGIN).' '.($action->getWidth() + $action->getPositionX()-$tailleFleche).','.($action->getPositionY()+MARGIN).'" />';
					}
					echo '<text id="action" x="'.(($action->getPositionX()+$action->getWidth())).'" y="'. (MARGIN_TEXT + $action->getPositionY()+MARGIN).'">'.str_replace('-', '/', $action->getDateFin()->format('d-m')) . ' - ' . $action->getNom().'</text>';
				}
				//Sinon si c'est une action
				else {
					//On trace l'action soit à la date de debut, soit à la date de fin, en considérant qu'il n'y ait pas de date de Fin < date de début
					$date = max(array($action->getDateDebut(),$action->getDateFin()));
					if($date!=null){
						$this->drawForm($action,$date);
						echo '<text id="action" x="'.($this->getPosDate($date)+10).'" y="'. (MARGIN_TEXT + $action->getPositionY()+MARGIN).'">'.str_replace('-', '/', $date->format('d-m')) . ' - ' . $action->getNom().'</text>';
					}
				}
			}
			$k++;
		}
		/*Affichage du jour courant*/
		$positionDateDuJour = $this->getPosDate(new DateTime());
		echo '<line x1="'.$positionDateDuJour.'" x2="'.$positionDateDuJour.'" y1="'.(2*HEIGHT).'" y2="'.$this->height.'"/>';
		echo '</svg>';
	}
	/*
		Fonction qui permet d'initialiser le planning : taille du SVG, hauteur, position des phases et actions etc ...
	*/
	function initPlanning(){
		$this->height=0;
		$this->width=200;
		$this->initLegende();
		
		foreach($this->listePhases as $phase){
			$phase->setheight($phase->getHeight() + HEIGHT);
			$this->height+= HEIGHT;
			foreach($phase->getActions() as $action){
				$action->setPositionY($this->height);
				$action->setPositionX($this->getPosDate($action->getDateDebut()));
				$action->setWidth(($this->getPosDate($action->getDateFin()) - $this->getPosDate($action->getDateDebut())));
				$this->height+= HEIGHT;
				$phase->setheight($phase->getHeight() + HEIGHT);
			}
			$this->height+= MARGIN;
			$phase->setPositionX($this->getPosDate($phase->getDateDebut()));
			$phase->setPositionY($this->height-$phase->getHeight());
			$phase->setWidth($this->getPosDate($phase->getDateFin()) - $this->getPosDate($phase->getDateDebut()));
		}
		$this->height+= MARGIN;
		$this->majDates();
	}
	
	/*
		Fonction qui permet d'initialiser l'echelle de temps
	*/
	function initLegende(){
		//On laisse 20 pixel de marge pour les années
		// $this->height+= HEIGHT;
		//Puis 20 pixels pour la legende des mois
		switch($this->typeAffichage){
			case "annee":
			case "y":
			$this->height+= HEIGHT;
			break;
			
			case "trimestre": 
			case "t":
			$this->height+= HEIGHT;
			$this->height+= HEIGHT;
			break;
			
			case "mois":
			case "m":
			$this->height+= HEIGHT;
			$this->height+= HEIGHT;
			break;
			
			case "semaine":
			case "s":
			$this->height+= HEIGHT;
			$this->height+= HEIGHT;
			$this->height+= HEIGHT;
			break;
			
			case "jour":
			case "d":
			$this->height+= HEIGHT;
			$this->height+= HEIGHT;
			$this->height+= HEIGHT;
			$this->height+= HEIGHT;
			break;
			
			default:
			$this->height+= HEIGHT;
			$this->height+= HEIGHT;
			break;
		}
		
		$this->ganttLegende = new GanttLegende();
		$anneeTmp=0;
		$moisTmp=null;
		$ganttMois = null;
		$annee=null;
		$mois = null;
		/*for($i=new DateTime('1-'.$this->dateDebut->format('m-Y'));$i<=$this->dateFin;$i->modify('+1 month')){
			$mois = $i->format('M');
			$this->width+=$this->widthUnity;
			//On test la valeur suivante de $i
			$i2 = new DateTime($i->format('d-m-Y'));
			$i2->modify('+1 month');
			
			//Si les deux annees qui se suivent sont differentes
			if($i->format('Y')!=$anneeTmp){
				//Si l'annee precedente existe, on l'ajoute
				if($annee!=null){
					$this->ganttLegende->add($annee);
				}
				$annee = new GanttLegendeAnnee($i->format('Y'));
				$annee->add($mois);
			}
			else {
				$annee->add($mois);
			}
			//Si c'est la derniere année de la boucle on l'ajoute a la legende
			if($i2>=$this->dateFin){
				$this->ganttLegende->add($annee);
			}
			$anneeTmp = $i->format('Y');
		}*/
		
		for($i=new DateTime('1-'.$this->dateDebut->format('m-Y'));$i<=$this->dateFin;$i->modify('+1 week')){
			$mois = $i->format('M');
			//On test la valeur suivante de $i
			$i2 = new DateTime($i->format('d-m-Y'));
			$i2->modify('+1 week');
			// $this->width+=$this->widthUnity;
			if($ganttMois != null){
				$ganttMois->add($i->format('W'));
			}
			//Si les deux annees qui se suivent sont differentes
			if($i->format('Y')!=$anneeTmp){
				//Si l'annee precedente existe, on l'ajoute
				if($annee!=null){
					$this->ganttLegende->add($annee);
				}
				$annee = new GanttLegendeAnnee($i->format('Y'));
				if($mois!=$moisTmp){
					$this->width+=$this->widthUnity;
					$ganttMois = new GanttLegendeMois($mois);
					$annee->add($ganttMois);
				}
			}
			else {
				if($mois!=$moisTmp){
					$this->width+=$this->widthUnity;
					$ganttMois = new GanttLegendeMois($mois);
					$annee->add($ganttMois);
				}
			}
			//Si c'est la derniere année de la boucle on l'ajoute a la legende
			if($i2>$this->dateFin){
				$this->ganttLegende->add($annee);
			}
			$moisTmp = $i->format('M');
			$anneeTmp = $i->format('Y');
		}
	}
	
	public function initWidth(){
		switch($this->typeAffichage){
			case "annee":
			case "y":
			$this->widthUnity = WIDTH/12;
			break;
			
			case "trimestre": 
			case "t":
			$this->widthUnity = WIDTH/3;
			break;
			
			case "mois":
			case "m":
			$this->widthUnity = WIDTH;
			break;
			
			case "semaine":
			case "s":
			$this->widthUnity = 4 * WIDTH;
			break;
			
			case "jour":
			case "d":
			$this->widthUnity = 28 * WIDTH;
			break;
			
			default:
			$this->widthUnity = WIDTH;
			$this->typeAffichage = "mois";
			break;
		}
	}
	
	public function calculeDateDebut(){
		$arrayDateTmp = array();
		foreach($this->listePhases as $phase){
			$arrayDateTmp[]=$phase->getDateDebut();
			$arrayDateTmp[]=$phase->getDateFin();
		}
		if(is_array(array_filter($arrayDateTmp)) && count(array_filter($arrayDateTmp))>0){
			return min(array_filter($arrayDateTmp))->format('d-m-Y');
		}
		else 
			return null;
	}
	
	public function calculeDateFin(){
		$arrayDateTmp = array();
		foreach($this->listePhases as $phase){
			$arrayDateTmp[]=$phase->getDateDebut();
			$arrayDateTmp[]=$phase->getDateFin();
		}
		if(is_array(array_filter($arrayDateTmp)) && count(array_filter($arrayDateTmp))>0){
			return max(array_filter($arrayDateTmp))->format('d-m-Y');
		}
		else 
			return null;
	}
	
	private function majDates(){
		$this->dateDebut = new DateTime($this->calculeDateDebut());
		$this->dateFin = new DateTime($this->calculeDateFin());
	}
	
	function drawForm($action,$date){
		switch($action->getForm()){
			
			case "triangle" :
			echo '<polygon class="rectAnnee" points="'.($this->getPosDate($date)-7).','.(MARGIN_TEXT + $action->getPositionY()+MARGIN -5).' '.($this->getPosDate($date)).','.(MARGIN_TEXT + $action->getPositionY()+MARGIN +5).' '.($this->getPosDate($date)+7).','.(MARGIN_TEXT + $action->getPositionY()+MARGIN -5).' '.($this->getPosDate($date)).','.(MARGIN_TEXT + $action->getPositionY()+MARGIN -15).'" />';
			break;
			
			case "losange" :
			echo '<polygon fill ="yellow" stroke="black" points="'.($this->getPosDate($date)-7).','.(MARGIN_TEXT + $action->getPositionY()+MARGIN -5).' '.($this->getPosDate($date)).','.(MARGIN_TEXT + $action->getPositionY()+MARGIN +5).' '.($this->getPosDate($date)+7).','.(MARGIN_TEXT + $action->getPositionY()+MARGIN -5).' '.($this->getPosDate($date)).','.(MARGIN_TEXT + $action->getPositionY()+MARGIN -15).'" />';
			break;
			
			default : 
			echo '<circle cx="'.($this->getPosDate($date)).'" cy="'. (MARGIN_TEXT + $action->getPositionY()+MARGIN -5).'" r="5" fill="red" stroke="midnightblue" stroke-width="2" />';
			break;
		}
	}
	
	public function getDateDebut(){
		return $this->dateDebut;
	}
	
	public function getDateFin(){
		return $this->dateFin;
	}
	
	public function getPosDate($date){
		if($date!=null){
			$nbMois=0;
			$pos=0;
			for($i=new DateTime('1-'.$this->dateDebut->format('m-Y'));$i<=$date;$i->modify('+1 month')){
				$nbMois++;
			}
			$pos=($nbMois-1)*$this->widthUnity;
			//Pour connaitre le nombre de jours dans le mois :
			$nbDayInMonth = cal_days_in_month(CAL_GREGORIAN, $date->format('m'), $date->format('Y'));
			$pos+=$this->widthUnity*($date->format('d')/$nbDayInMonth);
			return $pos;
		}
		// $date = new DateTime($date);
	}
}

class GanttLegende {
	private $listeAnnees = array();
	
	public function __construct(){}
	
	public function add($element){
		$this->listeAnnees[] = $element;
	}
	
	public function getAnnees(){
		return $this->listeAnnees;
	}
}

class GanttLegendeAnnee{
	private $annee;
	private $listeMois = array();
	
	public function __construct($annee){
		$this->annee = $annee;
	}
	
	public function add($element){
		$this->listeMois[] = $element;
	}

	function getAnnee(){
		return $this->annee;
	}
	
	public function getMois(){
		return $this->listeMois;
	}
}

class GanttLegendeMois{
	private $mois;
	private $listeSemaines;
	
	public function __construct($mois){
		$this->mois = $mois;
	}
	
	public function add($element){
		$this->listeSemaines[] = $element;
	}

	function getMois(){
		return $this->mois;
	}
	
	public function getSemaines(){
		return $this->listeSemaines;
	}
}

class GanttLegendeSemaine{
	private $semaine;
	private $listeJours;
	
	public function __construct($semaine){
		$this->semaine = $semaine;
	}
	
	public function add($element){
		$this->listeJours[] = $element;
	}

	function getSemaine(){
		return $this->semaine;
	}
	
	public function getJours(){
		return $this->listeJours;
	}
}

class GanttPhase {
	private $nom;
	private $dateDebut;
	private $dateFin;
	private $arrayActions = array();
	private $positionX = 0;
	private $positionY = 0;
	private $height = 0;
	private $width = 0;
	
	public function __construct($nom,$arrayActions){
		$this->nom = $nom;
		
		if(isset($arrayActions)){
			$this->arrayActions=$arrayActions;
			$this->dateDebut = new DateTime($this->calculeDateDebut());
			$this->dateFin = new DateTime($this->calculeDateFin());
		}
	}
	
	public function add($element){
		$this->arrayActions[]=$element;
		$this->dateDebut = new DateTime($this->calculeDateDebut());
		$this->dateFin = new DateTime($this->calculeDateFin());
	}
	
	private function calculeDateDebut(){
		$arrayDateTmp = array();
		foreach($this->arrayActions as $action){
			$arrayDateTmp[]=$action->getDateDebut();
			$arrayDateTmp[]=$action->getDateFin();
		}
		if(is_array(array_filter($arrayDateTmp)) && count(array_filter($arrayDateTmp))>0){
			return min(array_filter($arrayDateTmp))->format('d-m-Y');
		}
		else 
			return null;
	}
	
	private function calculeDateFin(){
		$arrayDateTmp = array();
		foreach($this->arrayActions as $action){
			$arrayDateTmp[]=$action->getDateDebut();
			$arrayDateTmp[]=$action->getDateFin();
		}
		if(is_array(array_filter($arrayDateTmp)) && count(array_filter($arrayDateTmp))>0){
			return max(array_filter($arrayDateTmp))->format('d-m-Y');
		}
		else 
			return null;
	}
	
	public function getNom(){
		return $this->nom;
	}
	
	public function getDateDebut(){
		return $this->dateDebut;
	}
	
	public function getDateFin(){
		return $this->dateFin;
	}
	
	public function setPositionX($positionX){
		$this->positionX = $positionX;
	}
	
	public function getPositionX(){
		return $this->positionX;
	}
	
	public function setPositionY($positionY){
		$this->positionY = $positionY;
	}
	
	public function getPositionY(){
		return $this->positionY;
	}
	
	public function setWidth($width){
		$this->width = $width;
	}
	
	public function getWidth(){
		return $this->width;
	}
	
	public function setHeight($height){
		$this->height = $height;
	}
	
	public function getHeight(){
		return $this->height;
	}
	
	public function getActions(){
		return $this->arrayActions;
	}
	
	public function __toString(){
		return 'Nom : '.$this->nom.' Debut : '.$this->dateDebut->format('Y-m-d').' Fin : '.$this->dateFin->format('Y-m-d');
	}
}

class GanttAction {
	private $nom;
	private $dateDebut;
	private $dateFin;
	private $positionX = 0;
	private $positionY = 0;
	private $formType = "none";
	private $width = 0;
	private $height = HEIGHT;
	
	public function __construct($nom, $dateDebut, $dateFin){
		$this->nom=$nom;
		$this->dateDebut=$dateDebut;
		$this->dateFin=$dateFin;
	}
	
	public function getNom(){
		return $this->nom;
	}
	
	public function getDateDebut(){
		return $this->dateDebut;
	}
	
	public function getDateFin(){
		return $this->dateFin;
	}
	
	public function setPositionY($positionY){
		$this->positionY = $positionY;
	}
	
	public function getPositionY(){
		return $this->positionY;
	}
	
	public function setPositionX($positionX){
		$this->positionX = $positionX;
	}
	
	public function getPositionX(){
		return $this->positionX;
	}
	
	public function setForm($form){
		$this->formType = $form;
	}
	
	public function getForm(){
		return $this->formType;
	}
	
	public function setWidth($width){
		$this->width = $width;
	}
	
	public function getWidth(){
		return $this->width;
	}
	
	public function setHeight($height){
		$this->height = $height;
	}
	
	public function getHeight(){
		return $this->height;
	}
	
	public function __toString(){
		return 'Nom : '.$this->nom.' Debut : '.$this->dateDebut->format('Y-m-d').' Fin : '.$this->dateFin->format('Y-m-d');
	}
}

class GanttLine {
	public function __construct(){
	}
}
?>