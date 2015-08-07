<?php namespace App;

use Carbon\Carbon;

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

	
	public static function getDates(){

		$flag = 0;
		$dates = [];
		$date = Carbon::now();

		while($flag != 2){
			if($date->dayOfWeek !== Carbon::SATURDAY && $date->dayOfWeek !== Carbon::SUNDAY){
			 	array_push($dates,date_format($date,'Y-m-d'));
			 	if($date->dayOfWeek === Carbon::FRIDAY){
			 		$flag ++;
			 	}
			}
			$date->addDays(1);
		}

		return $dates;
	}


	public static function getMonths(){
		
		setlocale(LC_ALL,'en');
		$months = [];
		
		$date = Carbon::now();
		$month =  $date->formatLocalized('%B');
		array_push($months,$date->formatLocalized('%B %Y'));
		$date->addMonths(1);

		while($date->formatLocalized('%B') != $month){
			array_push($months,$date->formatLocalized('%B %Y'));
			$date->addMonths(1);			
		} 

		return $months;
	}
	
	public static function getMonthDates($d){
		
		$date = $d->startOfMonth();
		$dates = [];
		array_push($dates,date_format($date,'Y-m-d'));
		$date->addDays(1);

		while($date->formatLocalized('%d') != '1'){
			array_push($dates,date_format($date,'Y-m-d'));
			$date->addDays(1);			
		} 
		
		return $dates;
	}
}
