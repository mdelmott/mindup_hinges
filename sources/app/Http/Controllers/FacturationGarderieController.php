<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

use App\Profil;
use App\Groupe;
use App\Util;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class FacturationGarderieController extends Controller {

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
		$mois_aff = Session::get('mois_aff');
		$mois = Session::get('mois');
		$m = Input::get('mois');
		$groupe_id = Input::get('groupe');
 
		$facturation = [];

		if($groupe_id == null){

			$oldGroupe = 0;
			$oldMois = 0;

			$groupe = [];
			$groupes_aff = [];
			$eleves = [];
			$mois_aff = [];

			$mois = Util::getMonths();
			setlocale(LC_ALL,'fr_FR');
			foreach ($mois as $m) {
				array_push($mois_aff,utf8_encode(Carbon::createFromFormat('j F Y','1 ' . $m)->formatLocalized('%B %Y')));
			}
			$groupes = Groupe::selectAllGarderie();
			if(count($groupes)>0){
				$groupes_aff = Util::stringifyObject($groupes,'other');
				$dates = Util::getMonthDates(Carbon::now());
				$groupe_id = $groupes[0]->id;
				$eleves = Profil::selectAllByGroupe($groupe_id);
			 	foreach($dates as $d){
			 		array_push($facturation,Groupe::getGarderieFacturation($groupe_id, $d));
			 	}
			 	Session::put('mois_aff', $mois_aff);
			 	Session::put('mois', $mois);
				Session::put('groupes', $groupes);
				Session::put('groupes_aff', $groupes_aff);
			}
		}else{
			$oldGroupe = $groupe_id;
			$oldMois = $m;
			$m = '1 ' . $mois[$m];
			$dates = Util::getMonthDates(Carbon::createFromFormat('j F Y',$m));
			$groupe_id = $groupes[$groupe_id]->id;
			$eleves = Profil::selectAllByGroupe($groupe_id);
			foreach ($dates as $d) {
				array_push($facturation,Groupe::getGarderieFacturation($groupe_id,$d));
			}
		}

		return View::make("administration.facturation.garderie",['groupes' => $groupes_aff, 'mois' => $mois_aff ,'facturation' => $facturation, 'eleves' => $eleves, 'oldGroupe' => $oldGroupe, 'oldMois' => $oldMois]);
	}
}