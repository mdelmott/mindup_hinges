<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

use App\Profil;
use App\Groupe;
use App\Tarif;
use App\Util;
use App\Adresse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class TAPController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Classe Controller
	|--------------------------------------------------------------------------
	|
	*/

	/**
	 * Create Classe View's controller.
	 *
	 * Redirect each button of the page to the correesponding method.
	 *
	 * @return "Create" classe view
	 */

	public function index(){
		
		$groupes = Session::get('groupes');
		$groupes_aff = Session::get('groupes_aff');
		$date = Session::get('date');
		$groupe_id = Input::get('groupe');

		if($groupe_id == null){

			$oldGroupe = 0;
			$groupe = [];
			$groupes_aff = [];

			$groupes = Groupe::selectAllTAP();
			if(count($groupes)>0){
				$groupes_aff = Util::stringifyObject($groupes,'other');
				$date = Carbon::now(); 
				$groupe = Groupe::getAllStudentsTAP($groupes[0]->id,$date);

				Session::put('groupes',$groupes);
				Session::put('groupes_aff',$groupes_aff);
				Session::put('date',$date);
			}
			
		}else{

			$oldGroupe = $groupe_id;
			$groupe_id = $groupes[$groupe_id]->id;
			$groupe = Groupe::getAllStudentsTAP($groupe_id,$date);
		}
		
		Session::put('groupe',$groupe);
		Session::put('oldGroupe', $oldGroupe);

		return View::make("tap",['groupes' => $groupes_aff, 'groupe' => $groupe, 'oldGroupe' => $oldGroupe]);
	}


	public function check($id,$presence){
		
		$groupes_aff = Session::get('groupes_aff');
		$groupe = Session::get('groupe');
		$oldGroupe = Session::get('oldGroupe');

		$absence = 0;
		$adresse = Profil::getAdresseFromTapProfilTable($id);
		if(count($adresse)>0){
			$ville = $adresse[0]->ville;
			if($ville == "Hinges"){
				if($presence == "Present"){
					$prix = Tarif::getTarif('TAPhingeoisPres');
				}else{
					$prix = Tarif::getTarif("TAPhingeoisAbs");
					$absence = 1;
				}
			}else{
				if($presence == "Present"){
					$prix = Tarif::getTarif('TAPextPres'); 
				}else{
					$prix = Tarif::getTarif("TAPextAbs");
					$absence = 1;
				}
			}
		}else{
			if($presence == "Present"){
				$prix = Tarif::getTarif('TAPextPres'); 
			}else{
				$prix = Tarif::getTarif("TAPextAbs");
				$absence = 1;	
			}
		}


		Profil::presenceTAP($id,$absence,$prix);

		$groupe = Util::diff($groupe,$id);
		Session::put('groupe',$groupe);

		return View::make("tap",['groupes' => $groupes_aff, 'groupe' => $groupe, 'oldGroupe' => $oldGroupe]);	
	}

}