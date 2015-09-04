<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

use App\Profil;
use App\Classe;
use App\Tarif;
use App\Util;
use App\Adresse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class CantineController extends Controller {

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
		$classes = Session::get('classes');
		$classes_aff = Session::get('classes_aff');
		$date = Session::get('date');
		$classe_id = Input::get('classe');

		if($classe_id == null){

			$oldClasse = 0;
			$classe = [];
			$classes_aff = [];

			$classes = Classe::selectAll();
			if(count($classes)>0){
				$classes_aff = Util::stringifyObject($classes,'other');
				$date = Carbon::now(); 
				$classe = Classe::getAllStudentsCafet($classes[0]->id,$date);

				Session::put('classes',$classes);
				Session::put('classes_aff',$classes_aff);
				Session::put('date',$date);
			}
			
		}else{

			$oldClasse = $classe_id;
			$classe_id = $classes[$classe_id]->id;
			$classe = Classe::getAllStudentsCafet($classe_id,$date);
		}
		
		Session::put('classe',$classe);
		Session::put('oldClasse', $oldClasse);

		return View::make("cantine",['classes' => $classes_aff, 'classe' => $classe, 'oldClasse' => $oldClasse]);
	}


	public function check($id,$presence){
		
		$classes_aff = Session::get('classes_aff');
		$classe = Session::get('classe');
		$oldClasse = Session::get('oldClasse');

		if(Profil::getRepasProfil($id)[0]->hors_delai == 0){
			$prix = Tarif::getTarif('RepasStd');
		}else{
			$prix = Tarif::getTarif('RepasHD');
		}

		if($presence == 'Present'){
			Profil::presenceCafet($id,0,$prix);
		}else{
			Profil::presenceCafet($id,1,$prix);
		}

		$classe  = Util::diff($classe,$id);
		Session::put('classe',$classe);

		return View::make("cantine",['classes' => $classes_aff, 'classe' => $classe, 'oldClasse' => $oldClasse]);	
	}

	public function showProfil($id){
		
		$profil = Profil::getProfil($id)[0];
		$adresse = Adresse::getAdresse($profil->adresse_id);

		$rue = '';
		$ville = '';
		$cp = '';

		if($adresse != null){
			$adresse = $adresse[0];
			if($adresse->numero != ''){
				$rue =  $adresse->numero . ", " . $adresse->rue;
			}else{
				$rue = $adresse->rue;
			}
			$ville = $adresse->ville;
			$cp = $adresse->cp;
		}

		return View::make("profil",['nom'=> $profil->nom, 'prenom' => $profil->prenom, 'tel' => $profil->tel, 'remarques' => $profil->remarques, 'rue' => $rue, 'ville' => $ville, 'cp' => $cp]);	
	} 
	
}