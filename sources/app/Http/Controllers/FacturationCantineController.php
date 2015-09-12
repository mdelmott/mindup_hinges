<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

use App\Profil;
use App\Classe;
use App\Util;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class FacturationCantineController extends Controller {

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
		$mois_aff = Session::get('mois_aff');
		$mois = Session::get('mois');
		$m = Input::get('mois');
		$classe_id = Input::get('classe');
 
		$facturation = [];

		if($classe_id == null){

			$oldClasse = 0;
			$oldMois = 0;

			$classe = [];
			$classes_aff = [];
			$eleves = [];
			$mois_aff = [];

			$mois = Util::getMonths();
			setlocale(LC_ALL,'fr_FR');
			foreach ($mois as $m) {
				array_push($mois_aff,utf8_encode(Carbon::createFromFormat('j F Y','1 ' . $m)->formatLocalized('%B %Y')));
			}
			$classes = Classe::selectAll();
			if(count($classes)>0){
				$classes_aff = Util::stringifyObject($classes,'other');
				$dates = Util::getMonthDates(Carbon::now());
				$classe_id = $classes[0]->id;
				$eleves = Profil::selectAllByClasse($classe_id);
			 	foreach($dates as $d){
			 		array_push($facturation,Classe::getFacturation($classe_id, $d));
			 	}

			 	Session::put('mois_aff', $mois_aff);
			 	Session::put('mois', $mois);
				Session::put('classes', $classes);
				Session::put('classes_aff', $classes_aff);
			}

		}else{
			$oldClasse = $classe_id;
			$oldMois = $m;
			$m = '1 ' . $mois[$m];
			$dates = Util::getMonthDates(Carbon::createFromFormat('j F Y',$m));
			$classe_id = $classes[$classe_id]->id;
			$eleves = Profil::selectAllByClasse($classe_id);
			foreach ($dates as $d) {
				array_push($facturation,Classe::getFacturation($classe_id,$d));
			}
		}

		return View::make("administration.facturation.cantine",['classes' => $classes_aff, 'mois' => $mois_aff ,'facturation' => $facturation, 'eleves' => $eleves, 'oldClasse' => $oldClasse, 'oldMois' => $oldMois]);
	}
}