<?php
	define('WIDTH_MOIS',70);
	define('MARGIN',5);
	define('HEIGHT',20);
	
class GanttGraph {
	private $listePhases = array();
	private $dateDebut;
	private $dateFin;
	private $width = 0;
	private $height = 0;
	
	public function __construct(){
		
	}
	
	public function add($element){
		$this->listePhases[]=$element;
		$this->majDates();
	}
	
	function display(){
		$this->initPlanning();
		echo '<svg height="'.$this->height.'" width="'.$this->width.'">
			
		</svg>';
	}
	//don't forget to add legend, and function initSVG
	function initPlanning(){
		$this->height=0;
		$this->width=0;
		/*Mettre ici fonction genererEntete*/
		//On laisse 20 pixel de marge pour les années
		$this->height+= HEIGHT;
		//Puis 20 pixels pour la legende des mois
		$this->height+= HEIGHT;
		
		foreach($this->listePhases as $phase){
			foreach($phase->getActions() as $action){
				$action->setPositionY=$this->height + HEIGHT;
				$this->height+= HEIGHT + MARGIN;
			}
			$phase->setheight($this->height);
			$this->height+= HEIGHT;
		}
		$this->majDates();
		
		for($i=new DateTime($this->dateDebut->format('d-m-Y'));$i<=$this->dateFin;$i->modify('+1 month')){
			$this->width+=WIDTH_MOIS;
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
	
	public function getDateDebut(){
		return $this->dateDebut;
	}
	
	public function getDateFin(){
		return $this->dateFin;
	}
	
	function getPosDate($date){
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
	private $position = 0;
	
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
	
	public function setPosition($position){
		$this->position = $position;
	}
	
	public function getPosition(){
		return $this->position;
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