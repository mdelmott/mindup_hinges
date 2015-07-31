<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

use App\Profil;
use App\Util;
use App\Tap;
use App\Adresse;
use App\Tarif;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use JavaScript;


class InscriptionTAPController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Inscription TAP Controller
	|--------------------------------------------------------------------------
	|
	*/

	/**
	 * Show tarif page with all tarif.
	 *
	 * @return Tarif view
	 */	

	public function index(){
		
		/* Get all students */
		$profils = Profil::selectAll();
	
		/* Stringify profil objects to use them in select inputs */ 
		$eleves = Util::stringifyObject($profils,"profil");

		if(count($profils) > 0){
			$profil_id = $profils[0]->id;
			$TAP = Profil::getTAP($profil_id);
		}

		$dates = [];

		foreach ($TAP as $t) {
			$date = date_create($t->date);
			array_push($dates,date_format($date,'m/d/Y'));
		}

		Javascript::put(['dates' => $dates]);

		Session::put('profils',$profils);
		Session::put('eleves',$eleves);

		return View::make('administration.inscription.TAP',['eleves' => $eleves, 'oldeleve' => '']);	
	 	
	}

	/**
	 * Update a selected group.
	 *
	 * @return Tarif view
	 */	

	public function createOrDelete(){		
		$action = Input::get('action');
		switch ($action) {
			case 'Ajouter une scéance': return $this->create();break;
			case 'Supprimer une scéance': return $this->delete();break;
			default : return $this->show();break;
		}
	}


	public function show(){
		
		$profils = Session::get('profils');
		$eleves = Session::get('eleves');
		$profil_id  = Input::get('eleve');

		$oldeleve = $profil_id;
		$profil_id = $profils[$profil_id]->id;

		$TAP = Profil::getTAP($profil_id);

		$dates = [];

		foreach ($TAP as $t) {
			$date = date_create($t->date);
			array_push($dates,date_format($date,'m/d/Y'));
		}

		Javascript::put(['dates' => $dates]);

		return View::make('administration.inscription.TAP',['eleves' => $eleves, "oldeleve" => $oldeleve]);			

	}


	public function create(){
		
		$eleves = Session::get('eleves');
		$profils = Session::get('profils');
		$profil_id  = Input::get('eleve');
		$datesToReturn = Input::get('datesToReturn');

		$adresse_id = $profils[$profil_id]->adresse_id;
		$oldeleve = $profil_id;
		$profil_id = $profils[$profil_id]->id;

		$datesToReturn = str_replace('(Paris, Madrid (heure d’été))', '', $datesToReturn);
		$dates = explode(',',$datesToReturn);

		$adresse = Adresse::getAdresse($adresse_id);
		if(count($adresse)>0){
			$ville = $adresse[0]->ville;
		}

		if($ville == "Hinges"){
			$prix = Tarif::getTarif("TAPhingeoisPres");
		}else{
			$prix = Tarif::getTarif("TAPextPres");
		}		
			
		foreach ($dates as $d) {
			$date = date_create($d);
			$TAP_id = Tap::createTAP($date);
			Profil::addTAP($profil_id,$TAP_id,$prix);
		}

		$TAP = Profil::getTAP($profil_id);

		$dates = [];

		foreach ($TAP as $t) {
			$date = date_create($t->date);
			array_push($dates,date_format($date,'m/d/Y'));
		}

		Javascript::put(['dates' => $dates]);

		return View::make('administration.inscription.TAP',['eleves' => $eleves, 'oldeleve' => $oldeleve]); 
	}



	public function delete(){

		$eleves = Session::get('eleves');
		$profils = Session::get('profils');
		$profil_id  = Input::get('eleve');
		$datesToReturn = Input::get('datesToReturn');

		$oldeleve = $profil_id;
		$profil_id = $profils[$profil_id]->id;

		$datesToReturn = str_replace('(Paris, Madrid (heure d’été))', '', $datesToReturn);
		$dates = explode(',',$datesToReturn);

		foreach ($dates as $d) {
			$date = date_create($d);
			$TAP_id = Tap::getTAPId($date);
			if($TAP_id != null){
				Profil::deleteTAP($profil_id,$TAP_id);
			}
		}		

		$TAP = Profil::getTAP($profil_id);

		$dates = [];

		foreach ($TAP as $t) {
			$date = date_create($t->date);
			array_push($dates,date_format($date,'m/d/Y'));
		}

		Javascript::put(['dates' => $dates]);

		return View::make('administration.inscription.TAP',['eleves' => $eleves, 'oldeleve' => $oldeleve]);	
	}
}