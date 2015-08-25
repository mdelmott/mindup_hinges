<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

use App\Profil;
use App\Adresse;
use App\Util;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class ProfilController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Profil Controller
	|--------------------------------------------------------------------------
	|
	*/


	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */

	public function index()
	{
		return view("administration.scolarite.profils");
	}


	/**
	 * Update or delete a profil.
	 *
	 * @return 
	 */	

	public function updateOrDelete(){
		$action = Input::get('action');
		switch($action){
			case "Supprimer ce profil" : return $this->delete();break;
			case "Enregistrer les modifications": return $this->update();break;
			default: return $this->show();break;
		}	
	}

	/**
	 * Show selected profil's informations
	 *
	 * @return ModifierOuSupprimer View with all selected profil's informations
	 */	

	public function show(){

		$profil_id = Input::get('eleve');
		$rue = "";
		$ville = "";
		$cp = "";
		$nom = "";
		$prenom = "";
		$tel = "";
		$remarques = "";

		/* Affect format "prenom nom" for each option of the select input */

		$profils = Profil::selectAll();
		$eleves = Util::stringifyObject($profils,'profil');

		/* Get selected profil's informations */

		if($profil_id != null){
			$eleve = $profils[$profil_id];
			$nom = $eleve->nom;
			$prenom = $eleve->prenom;
			$tel = $eleve->tel;
			$remarques = $eleve->remarques;
			$oldeleve = $profil_id;
		}else{
			$oldeleve = null;
			if(count($profils) > 0){
				$eleve = $profils[0];
				$nom = $eleve->nom;
				$prenom = $eleve->prenom;
				$tel = $eleve->tel;
				$remarques = $eleve->remarques;		
			}else{
				$eleve = null;
			}			
		}

		/* Get selected profil's adresse */

		if($eleve != null){
			if($eleve->adresse_id != null){
				$adresse = Adresse::getAdresse($eleve->adresse_id)[0];
				if($adresse->numero != null){
				$rue = $adresse->numero . ", " . $adresse->rue;
				}else{
					$rue = $adresse->rue;
				}
				$ville = $adresse->ville;
				$cp = $adresse->cp;
			}
		}

        Session::put('profils',$profils);

		/* Make the view with selected profil's informations */
		return View::make("administration.scolarite.profilsSupprimer",['eleves' => $eleves, 'oldeleve' => $oldeleve, 'nom' => $nom, 'prenom' => $prenom, 'tel' => $tel, 'rue' => $rue, 'ville' => $ville, 'cp' => $cp, "remarques" => $remarques]);
	}


	/**
	 * Create a new profil.
	 *
	 * @return create profil's view 
	 */	

	public function create(){

		/* Get informations */

		$nom = Input::get('nom');
		$prenom = Input::get('prenom');
		$tel = Input::get('tel');
		$adresse = Input::get('adresse');
		$ville = Input::get('ville');
		$cp = Input::get('cp');
		$remarques = Input::get('remarques');

		$exist = Profil::verifProfil($nom,$prenom);
		
		if($exist == 0){
			/* Create profil's address */
		
			if($adresse != "" || $ville != "" || $cp != ""){
				if(strpos($adresse,',') == false){
					$rue = $adresse;
					$numero = null;
				}else{
					list($numero, $rue) = explode(',',$adresse);	
				}
				$adresse_id = Adresse::createAdresse($numero, $rue, $ville, $cp);	
			}else{
				$adresse_id = null;
			}

			/* Create profil */
		
			Profil::createProfil($nom, $prenom, $tel, $adresse_id, $remarques);
		}

		return view("administration.scolarite.profils"); 
	}

	/**
	 * Update a profil.
	 *
	 * @return create profil's view
	 */	

	public function update(){		
		
		/* Get new informations */

		$eleve_id = Input::get('eleve');
		$profils = Session::get('profils');

		$id = $profils[$eleve_id]->id;
		$nom = Input::get('nom');
		$prenom = Input::get('prenom');
		$tel = Input::get('tel');
		$adresse = Input::get('adresse');
		$ville = Input::get('ville');
		$cp = Input::get('cp');
		$remarques = Input::get('remarques');
		
		/* Update profil */

		$profil = Profil::updateProfil($id, $nom, $prenom, $tel, $remarques)[0];
		
		/* Update profil's address */ 

		if($profil->adresse_id != null){
			if($adresse != "" || $ville != "" || $cp != ""){
				if(strpos($adresse,',') == false){
					$rue = $adresse;
					$numero = null;
				}else{
					list($numero, $rue) = explode(',',$adresse);	
				}
				Adresse::updateAdresse($profil->adresse_id, $numero, $rue, $ville, $cp);	
			}else{
				Profil::changeAdresse($id,null);
				Adresse::deleteAdresse($profil->adresse_id);
			}
		}else{
			if($adresse != "" || $ville != "" || $cp != ""){
				if(strpos($adresse,',') == false){
					$rue = $adresse;
					$numero = null;
				}else{
					list($numero, $rue) = explode(',',$adresse);	
				}
				$adresse_id = Adresse::createAdresse($numero, $rue, $ville, $cp);
				Profil::changeAdresse($id,$adresse_id);	
			}
		}


		Session::put('profils',null);
		return view("administration.scolarite.profils"); 
	}

	/**
	 * Delete a profil.
	 *
	 * @return create profil's view
	 */	

	public function delete(){

		/* Get profil's id */ 	
		
		$eleve_id = Input::get('eleve');
		$profils = Session::get('profils');
		$id = $profils[$eleve_id]->id;

		/* Get profil's address id */
		
		$adresse_id = Profil::getProfil($id)[0]->adresse_id;
		
		/* Delete profil */

		Profil::changeAdresse($id,null);
		Profil::changeClasse($id,null);
		Profil::deleteProfil($id);
		
		/* Delete profil's address */

		if($adresse_id != null){
			Adresse::deleteAdresse($adresse_id);
		}
		return view("administration.scolarite.profils");	
	}

}