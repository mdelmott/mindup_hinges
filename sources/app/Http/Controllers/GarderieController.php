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
	public function index()
	{
		DB::setFetchMode(PDO::FETCH_ASSOC);
		$group_gar = DB::table("groupe")->select("*")
			->where("type","=","garderie")
			->get();

		DB::setFetchMode(PDO::FETCH_CLASS);


		if(Carbon::now()->format("H") + 2 < 12){
			return view('garderie.matin', compact('group_gar'));
		}else{
			return view('garderie.apresmidi', compact('group_gar'));
		}
	}

	public function chargementProfil(){
		if(isset($_GET['groupe'])){
			DB::setFetchMode(PDO::FETCH_ASSOC);
			$select = DB::table("garderie")->select("id", "date")->where("date", "=", Carbon::now()->format("Y-m-d"))->get();

			if(count($select) == 0){
				DB::table("garderie")->insert(["date"=> Carbon::now()->format("Y-m-d")]);
			}

			if(Carbon::now()->format("H") + 2 < 12){
				$garderie_profil = DB::select("SELECT * FROM profil, adresse
												WHERE profil.id not in (SELECT id_profil FROM gar_profil
												WHERE id_gar IN (SELECT MAX(id) FROM garderie WHERE date = '".Carbon::now()->format("Y-m-d")."'))
												AND profil.adresse_id = adresse.id");
			}else{
				$garderie_profil = DB::select("SELECT * FROM profil, adresse
												WHERE (profil.id in (SELECT id_profil FROM gar_profil WHERE duree_soir IS NULL AND id_gar IN (SELECT MAX(id) FROM garderie WHERE date = '".Carbon::now()->format("Y-m-d")."'))
												OR profil.id NOT IN (SELECT id_profil FROM gar_profil WHERE id_gar IN (SELECT MAX(id) FROM garderie WHERE date = '".Carbon::now()->format("Y-m-d")."')))
												AND profil.adresse_id = adresse.id");
			}

			DB::setFetchMode(PDO::FETCH_CLASS);

			return array_values($garderie_profil);
		}
	}

	public function ajoutHoraire(){
		$horaire = $_GET['horaire'];
		$nom = $_GET['nom'];
		$prenom = $_GET['prenom'];
		$valeur = $_GET["valeur"];

		$id = DB::table("profil")->select("id")->where("nom", "=", $nom)->where("prenom", "=", $prenom)->get();
		$id = $id[0]->id;

		$nomtarif = "";

		switch($horaire){
			case "Avant 8h15":
				$horaire = "matin1";
				$nomtarif = "Garderieav8h15";
				break;
			case "Après 8h15":
				$horaire = "matin2";
				$nomtarif = "Garderieap8h15";
				break;
			case "1h":
				$horaire = "duree_soir";
				$nomtarif = "Garderie1h";
				break;
			case "2h":
				$horaire = "duree_soir";
				$nomtarif = "Garderie2h";
				break;
			case "3h":
				$horaire = "duree_soir";
				$nomtarif = "Garderie3h";
				break;
		}

		$prix = DB::table("tarifs")->select("id")->where("nom", "=", $nomtarif)->get();

		$prix = $prix["0"]->id;


		if($valeur == 0){
			$valeur = null;
		}

		if($prix == 0){
			$prix = null;
		}


		$select = DB::table("garderie")->select("id", "date")->where("date", "=", Carbon::now()->format("Y-m-d"))->get();

		if(count($select) == 0){
			DB::table("garderie")->insert(["date"=> Carbon::now()->format("Y-m-d")]);
		}

		$idDate = DB::table("garderie")->select("id")->where("date", "=", Carbon::now()->format("Y-m-d"))->get();


		$existe = DB::table("gar_profil")->select("*")->where("id_profil", "=", $id)->where("id_gar", "=", $idDate[0]->id)->get();


		if(count($existe)>0){
			DB::table("gar_profil")->where("id_profil", "=", $id)->where("id_gar", "=", $idDate[0]->id)->update([$horaire=> $valeur]);
		}else{
			DB::table("gar_profil")->insert(["id_profil"=>$id, "id_gar"=> $idDate[0]->id, $horaire=> $valeur, "prix" => $prix]);
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
