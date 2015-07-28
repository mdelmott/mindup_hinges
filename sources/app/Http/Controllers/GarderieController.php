<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class GarderieController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function matin()
	{
		DB::setFetchMode(PDO::FETCH_ASSOC);
		$group_gar = DB::table("groupe")->select("*")
			->where("type","=","garderie")
			->get();

		DB::setFetchMode(PDO::FETCH_CLASS);

		return view('garderie.matin', compact('group_gar'));
	}

	public function apresmidi()
	{
		DB::setFetchMode(PDO::FETCH_ASSOC);
		$group_gar = DB::table("groupe")->select("*")
			->where("type","=","garderie")
			->get();

		DB::setFetchMode(PDO::FETCH_CLASS);

		return view('garderie.apresmidi', compact('group_gar'));
	}

	public function chargementProfil(){
		if(isset($_GET['groupe'])){
			DB::setFetchMode(PDO::FETCH_ASSOC);
			$garderie_profil = DB::table("groupe_profil")->select("*")
				->join("profil", "groupe_profil.profil_id", "=" ,"profil.id")
				->join("groupe", "groupe_profil.groupe_id", "=" ,"groupe.id")
				->select("*", "groupe.nom as groupe_nom", "profil.nom as nom")
				->where("groupe.nom", "=",$_GET['groupe'])
				->get();

			$garderie_profil2 = DB::table("gar_profil")->join("garderie", "gar_profil.id_gar","=","garderie.id")
														->join("profil", "gar_profil.id_profil", "=" ,"profil.id")
														->select("*", "id_profil as profil_id")
														->where("garderie.date","=", Carbon::now()->format("Y-m-d"))
														->get();

			$g = array_merge($garderie_profil, $garderie_profil2);

			$i=0;
			foreach($g as $courrant){
				foreach($g as $courrant2){
					if($courrant["profil_id"] == $courrant2["profil_id"] && count(array_diff($courrant, $courrant2)) > 0 && $i<= count($g)/2){
						unset($g[$i]);
					}
				}
				$i++;
			}

			$g = array_values($g);
			return $g;
		}
	}

	public function ajoutHoraire(){
		$horaire = $_GET['horaire'];
		$nom = $_GET['nom'];
		$prenom = $_GET['prenom'];
		$valeur = $_GET["valeur"];

		$id = DB::table("profil")->select("id")->where("nom", "=", $nom)->where("prenom", "=", $prenom)->get();
		$id = $id[0]->id;

		switch($horaire){
			case "Avant 8h15":
				$horaire = "matin1";
				break;
			case "Après 8h15":
				$horaire = "matin2";
				break;
			case "1h":
				$horaire = "duree_soir";
				break;
			case "2h":
				$horaire = "duree_soir";
				break;
			case "3h":
				$horaire = "duree_soir";
				break;
		}

		if($valeur == 0){
			$valeur = null;
		}


		$select = DB::table("garderie")->select("id", "date")->where("date", "=", Carbon::now()->format("Y-m-d"))->get();

		if(count($select) == 0){
			DB::table("garderie")->insert(["date"=> Carbon::now()->format("Y-m-d")])->get();
		}

		$idDate = DB::table("garderie")->select("id")->where("date", "=", Carbon::now()->format("Y-m-d"))->get();


		$existe = DB::table("gar_profil")->select("*")->where("id_profil", "=", $id)->where("id_gar", "=", $idDate[0]->id)->get();

		if(count($existe)>0){
			DB::table("gar_profil")->where("id_profil", "=", $id)->where("id_gar", "=", $idDate[0]->id)->update([$horaire=> $valeur]);
		}else{
			DB::table("gar_profil")->insert(["id_profil"=>$id, "id_gar"=> $idDate[0]->id, $horaire=> $valeur]);
		}

		return 1;
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
