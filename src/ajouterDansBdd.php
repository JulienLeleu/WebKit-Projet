<?php
	require 'modeleInterfaceProjet.php';
	require 'modelePartiesPrenantes.php';
	if(count($_POST)>0){
		$array = array_keys($_POST);
		$nbLignes = count($_POST);
		foreach ($array as $value){
			echo $value; echo '<br/>';
		}
		for($i=0;$i<$nbLignes;$i++){
			//Suppression
			if(isset($_POST['trash'.($i+1)])){
				if($i==0){
					$id=$array[2];
					echo $id;
				}
				else {
					$id=$array[1];
				}
				//delete($bdd,$_POST['table'],$_SESSION['idProjet'],$id,$_POST[$id][$i]);
			}
			//ajout
			else {
			}
		}
	}
?>