<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

use App\Profil;
use App\Repas;
use App\Util;
use App\Tarif;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

use JavaScript;


class InscriptionCantineController extends Controller {

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
			$repas = Profil::getRepas($profil_id);
			$repas_hd = Profil::getRepasHD($profil_id);
		}

		$dates = [];
		$dates_hd = [];

		foreach ($repas as $r) {
			$date = date_create($r->date);
			array_push($dates,date_format($date,'m/d/Y'));
		}

		foreach ($repas_hd as $r) {
			$date_hd = date_create($r->date);
			array_push($dates_hd,date_format($date_hd,'m/d/Y'));
		}

		Javascript::put(['dates' => $dates, 'dates_hd' => $dates_hd]);

		Session::put('profils',$profils);
		Session::put('eleves',$eleves);

		return View::make('administration.inscription.cantine',['eleves' => $eleves, "oldeleve" => null]);
	}

	/**
	 * Update a selected group.
	 *
	 * @return Tarif view
	 */	

	public function createOrDelete(){		
		$action = Input::get('action');
		switch ($action) {
			case 'Ajouter un repas': return $this->create();break;
			case 'Supprimer un repas': return $this->delete();break;
			default : return $this->show();break;
		}
	}


	public function show(){
		
		$profils = Session::get('profils');
		$eleves = Session::get('eleves');
		$profil_id  = Input::get('eleve');

		$oldeleve = $profil_id;
		$profil_id = $profils[$profil_id]->id;

		$repas = Profil::getRepas($profil_id);
		$repas_hd = Profil::getRepasHD($profil_id);

		$dates = [];
		$dates_hd = [];

		foreach ($repas as $r) {
			$date = date_create($r->date);
			array_push($dates,date_format($date,'m/d/Y'));
		}

		foreach ($repas_hd as $r) {
			$date_hd = date_create($r->date);
			array_push($dates_hd,date_format($date_hd,'m/d/Y'));
		}

		Javascript::put(['dates' => $dates, 'dates_hd' => $dates_hd]);

		return View::make('administration.inscription.cantine',['eleves' => $eleves, "oldeleve" => $oldeleve]);			

	}


	public function create(){
		
		$eleves = Session::get('eleves');
		$profils = Session::get('profils');
		$profil_id  = Input::get('eleve');
		$datesToReturn = Input::get('datesToReturn');
		$hd = Input::get('Horsdelai');

		$oldeleve = $profil_id;
		$profil_id = $profils[$profil_id]->id;

		$datesToReturn = str_replace('(Paris, Madrid (heure d’été))', '', $datesToReturn);
		$dates = explode(',',$datesToReturn);

		if($hd == null){
			$prix = Tarif::getTarif('RepasStd');
			$hd = 0;
		}else{
			$prix = Tarif::getTarif('RepasHD');
			$hd = 1;
		}		
			
		foreach ($dates as $d) {
			$date = date_create($d);
			$repas_id = Repas::createRepas($date);
			Profil::addRepas($profil_id,$repas_id,$hd,$prix);
		}

		$repas = Profil::getRepas($profil_id);
		$repas_hd = Profil::getRepasHD($profil_id);

		$dates = [];
		$dates_hd = [];

		foreach ($repas as $r) {
			$date = date_create($r->date);
			array_push($dates,date_format($date,'m/d/Y'));
		}

		foreach ($repas_hd as $r) {
			$date_hd = date_create($r->date);
			array_push($dates_hd,date_format($date_hd,'m/d/Y'));
		}

		Javascript::put(['dates' => $dates, 'dates_hd' => $dates_hd]);

		return View::make('administration.inscription.cantine',['eleves' => $eleves, 'oldeleve' => $oldeleve]); 
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
			$repas_id = Repas::getRepasId($date);
			if($repas_id != null){
				Profil::deleteRepas($profil_id,$repas_id);
			}
		}		

		$dates = [];
		$dates_hd = [];

		foreach ($repas as $r) {
			$date = date_create($r->date);
			array_push($dates,date_format($date,'m/d/Y'));
		}

		foreach ($repas_hd as $r) {
			$date_hd = date_create($r->date);
			array_push($dates_hd,date_format($date_hd,'m/d/Y'));
		}

		Javascript::put(['dates' => $dates, 'dates_hd' => $dates_hd]);

		return View::make('administration.inscription.cantine',['eleves' => $eleves, 'oldeleve' => $oldeleve]);	
	}
}