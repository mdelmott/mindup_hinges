<?php namespace App;

class Util{

	public static function stringifyObject($object,$type){

		$returnedObject = [];	
		$i = 0;
		
		foreach ($object as $o) {
			if($type == "other"){
				$returnedObject[$i] = $o->nom;
			}else{
				$returnedObject[$i] = $o->prenom . " " . $o->nom;
			}
			$i ++;
		}

		return $returnedObject;
	}

	public static function diff($array1,$array2){
		
		$array3 = [];

		foreach ($array1 as $a1) {
			$flag = true;
			if(is_array($array2)){
				foreach ($array2 as $a2) {
					if($a1->id == $a2->id){
						$flag = false; break;
					}	
				}
			}else if($a1['id'] == $array2){
				$flag = false;
			}

			if($flag == true){
				array_push($array3,$a1);
			}
		}

		return $array3;
	} 

	public static function merge($array1,$array2){
		
		$array3 = [];

		foreach ($array1 as $a1) {
			$flag = false;
			foreach ($array2 as $a2) {
				if($a1->id == $a2->id){
					$flag = true; break;
				}	
			}
			if($flag == true){
				array_push($array3,$a1);
			}
		}

		return $array3;
	} 


}
