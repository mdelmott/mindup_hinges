<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

use App\Tarif;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


class TarifController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Tarif Controller
	|--------------------------------------------------------------------------
	|
	*/

	/**
	 * Show tarif page with all tarif.
	 *
	 * @return Tarif view
	 */	

	public function index(){
		
		$Garderieav8h15 = Tarif::getTarif('Garderieav8h15');
		$Garderieap8h15 = Tarif::getTarif('Garderieap8h15');
		$Garderie1h = Tarif::getTarif('Garderie1h');
		$Garderie2h = Tarif::getTarif('Garderie2h');
		$Garderie3h = Tarif::getTarif('Garderie3h');
		$TAPhingeoisPres = Tarif::getTarif('TAPhingeoisPres');
		$TAPhingeoisAbs = Tarif::getTarif('TAPhingeoisAbs');
		$TAPextPres = Tarif::getTarif('TAPextPres');
		$TAPextAbs = Tarif::getTarif('TAPextAbs');
		$RepasStd = Tarif::getTarif('RepasStd');
		$RepasHD = Tarif::getTarif('RepasHD');

		return View::make('administration.tarifs',['Garderieav8h15' => $Garderieav8h15, 'Garderieap8h15' => $Garderieap8h15, 'Garderie1h' => $Garderie1h, 'Garderie2h' => $Garderie2h, 'Garderie3h' => $Garderie3h, 'TAPhingeoisPres' => $TAPhingeoisPres, 'TAPhingeoisAbs' => $TAPhingeoisAbs, 'TAPextPres' => $TAPextPres, 'TAPextAbs' => $TAPextAbs, 'RepasStd' => $RepasStd, 'RepasHD' => $RepasHD]);	
	 	
	}

	/**
	 * Update a selected group.
	 *
	 * @return Tarif view
	 */	

	public function update(){		
		
		$Garderieav8h15 = Input::get('Garderieav8h15');
		$Garderieap8h15 = Input::get('Garderieap8h15');
		$Garderie1h = Input::get('Garderie1h');
		$Garderie2h = Input::get('Garderie2h');
		$Garderie3h = Input::get('Garderie3h');
		$TAPhingeoisPres = Input::get('TAPhingeoisPres');
		$TAPhingeoisAbs = Input::get('TAPhingeoisAbs');
		$TAPextPres = Input::get('TAPextPres');
		$TAPextAbs = Input::get('TAPextAbs');
		$RepasStd = Input::get('RepasStd');
		$RepasHD = Input::get('RepasHD');


		Tarif::updateTarif('Garderieav8h15',$Garderieav8h15);
		Tarif::updateTarif('Garderieap8h15',$Garderieap8h15);
		Tarif::updateTarif('Garderie1h',$Garderie1h);
		Tarif::updateTarif('Garderie2h',$Garderie2h);
		Tarif::updateTarif('Garderie3h',$Garderie3h);
		Tarif::updateTarif('TAPhingeoisPres',$TAPhingeoisPres);
		Tarif::updateTarif('TAPhingeoisAbs',$TAPhingeoisAbs);
		Tarif::updateTarif('TAPextPres',$TAPextPres);
		Tarif::updateTarif('TAPextAbs',$TAPextAbs);
		Tarif::updateTarif('RepasStd',$RepasStd);
		Tarif::updateTarif('RepasHD',$RepasHD);		

		return View::make('administration.tarifs',['Garderieav8h15' => $Garderieav8h15, 'Garderieap8h15' => $Garderieap8h15, 'Garderie1h' => $Garderie1h, 'Garderie2h' => $Garderie2h, 'Garderie3h' => $Garderie3h, 'TAPhingeoisPres' => $TAPhingeoisPres, 'TAPhingeoisAbs' => $TAPhingeoisAbs, 'TAPextPres' => $TAPextPres, 'TAPextAbs' => $TAPextAbs, 'RepasStd' => $RepasStd, 'RepasHD' => $RepasHD]);	
	 }
}