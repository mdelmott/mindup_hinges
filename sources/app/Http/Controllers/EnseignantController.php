<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class EnseignantController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		DB::setFetchMode(PDO::FETCH_ASSOC);
		$groupe_class = DB::table("groupe")->select("*")
			->where("type","=", 1)
			->get();
		DB::setFetchMode(PDO::FETCH_CLASS);

		return view("enseignants", compact('groupe_class'));
	}

	public function chargementProfil(){
		if(isset($_GET['classe'])){
			DB::setFetchMode(PDO::FETCH_ASSOC);

			$classe_profil = DB::select("SELECT * FROM profil WHERE id in (SELECT DISTINCT profil_id FROM groupe_profil WHERE groupe_id = ".$_GET['classe'].")");

			DB::setFetchMode(PDO::FETCH_CLASS);

			return array_values($classe_profil);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
