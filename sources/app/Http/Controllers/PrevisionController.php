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


class PrevisionController extends Controller {

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
		$dates = Session::get('dates');
		$classe_id = Input::get('classe');
		 
		$prevision = [];

		if($classe_id == null || $classe_id == 0){

			$oldClasse = 0;
			$classe = [];
			$classes_aff = [];
			$eleves = [];

			$classes = Classe::selectAll();
			if(count($classes)>0){
				$classes_aff = Util::stringifyObject($classes,'other');
				array_unshift($classes_aff,'Toutes les classes');
				$dates = Util::getDates();				
			 	foreach($dates as $d){
			 		array_push($prevision,Profil::getCountCafetForDate($d));
			 	}

				Session::put('classes',$classes);
				Session::put('classes_aff',$classes_aff);
				Session::put('dates',$dates);
			}
			
		}else{
			$oldClasse = $classe_id;
			$classe_id = $classes[$classe_id-1]->id;
			$eleves = Profil::selectAllByClasse($classe_id);
			foreach ($dates as $d) {
				array_push($prevision,Classe::getPrevisions($classe_id,$d));
			}
		}

		return View::make("administration.prevision",['classes' => $classes_aff, 'prevision' => $prevision, 'eleves' => $eleves, 'oldClasse' => $oldClasse]);
	}
}