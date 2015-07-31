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


class GroupeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Groupe Controller
	|--------------------------------------------------------------------------
	|
	*/

	/**
	 * Create Groupe View's controller.
	 *
	 * Redirect each button of the page to the correesponding method.
	 *
	 * @return "Create" groupe view
	 */

	public function createOrAdd(){
		
		$action = Input::get('action');

		switch($action){
			case "Ajouter" : $this->addProfil();break;
			case "Enregistrer": $this->create();break;
		}
		
		return View::make("administration.scolarite.groupes",['eleves' => Session::get('eleves'), 'groupe' => Session::get('groupe'), 'nom' => Session::get('nom'), 'type' => Session::get('type') ]);
	}

	/**
	 * Update or Delete Groupe View's controller.
	 *
	 * Redirect each button of the page to the correesponding method.
	 *
	 * @return "Update or delete" groupe view
	 */

	public function updateOrDelete(){
		
		$action = Input::get('action');
		
		switch($action){
			case "Ajouter" : $this->addProfil();break;
			case "Enregistrer": return $this->update();break;
			case "Supprimer":  return $this->delete();break;
			default: return $this->show();break;
		}

		return View::make("administration.scolarite.groupesSupprimer",['groupes' => Session::get('groupes_aff'), 'groupe' => Session::get('groupe'), 'eleves' => Session::get('eleves'), 'oldgroupe' => Session::get('oldgroupe')]);	
	}


	/**
	 * Show the application dashboard to the user.
	 *
	 * @return "Create" groupe view
	 */

	public function index(){

		/* Get all students */
		$profils = Profil::selectAll();
	
		/* Stringify profil objects to use them in select inputs */ 
		$eleves = Util::stringifyObject($profils,"profil");
		
		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('groupe',[]);
		Session::put('profils',$profils);
		Session::put('eleves',$eleves);
		Session::put('calledPage',"administration.scolarite.groupes");

		/* Show create groupe view with all needed informations */
		return View::make('administration.scolarite.groupes',['eleves' => $eleves,'groupe' => [], 'nom' => "", 'type' => 0]);
	}


	/**
	 * Show selected groupe's informations.
	 *
	 * @return "Update or delete" classe view
	 */	

	public function show(){

		/* Get the selected groupe */ 
		$groupe_id = Input::get('groupe');
		$groupes = Session::get('groupes');
		$groupes_aff = Session::get('groupes_aff');
		$ids = [];

		$profils = Profil::selectAll();
		
		/* Select all the groupes and stringify profil objects to use them in select inputs */
		if($groupes == null){
			$groupes = Groupe::selectAll();
			$groupes_aff = Util::stringifyObject($groupes,"other");
		}

		/* Get selected group students (If it is the first time that the function is called, we get first group's students) */
		if($groupe_id != null){
			$oldgroupe = $groupe_id;
			$groupe_id = $groupes[$groupe_id]->id;
			$groupe = Profil::selectAllByGroupe($groupe_id);
		}else{
			$oldgroupe = null;
			if(count($groupes) > 0){
				$groupe_id = $groupes[0]->id;
				$groupe = Profil::selectAllByGroupe($groupe_id);
			}else{
				$groupe = [];
			}	
		}

		$profils = Util::diff($profils,$groupe);
		$eleves = Util::stringifyObject($profils,'profil');

		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('groupe',$groupe);
		Session::put('groupes', $groupes);
		Session::put('groupes_aff', $groupes_aff);
		Session::put('ids', $ids);
		Session::put('oldgroupe',$oldgroupe);
		Session::put('calledPage',"administration.scolarite.groupesSupprimer");
		Session::put('profils',$profils);
		Session::put('eleves',$eleves);

		/* Show create groupe view with all needed informations */
		return View::make("administration.scolarite.groupesSupprimer",['groupes' => $groupes_aff, 'groupe' => $groupe, 'eleves' => $eleves, 'oldgroupe' => $oldgroupe]);	
	
	}


	/**
	 * Create a new group.
	 *
	 * @return "Create" groupe view 
	 */	

	public function create(){
		
		/* Get the students, the name and the type of the group*/
		$elevesGroupe = Session::get('groupe');
		$nom = Input::get('nom');
		$type = Input::get('type');

		/* Creation of the group in group table with group's name and type */ 
		$groupe_id = Groupe::createGroupe($nom,$type);

		/* Affect group for all the students */ 
		foreach($elevesGroupe as $eg){
			Profil::addGroupe($eg->id,$groupe_id);
		}

		/* Get all students */
		$profils = Profil::selectAll();
	
		/* Stringify profil objects to use them in select inputs */ 
		$eleves = Util::stringifyObject($profils,"profil");

		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('eleves',$eleves);
		Session::put('profils',$profils);
		Session::put('groupe', []);
		Session::put('nom',null);
		Session::put('type',0);
		Session::put('groupes',null);
		Session::put('groupes_aff',null);
	}

	/**
	 * Update a selected group.
	 *
	 * @return "Create" groupe view
	 */	

	public function update(){		

		/* Get the selected group and its students */
		$ids = Session::get('ids');
		$groupe = Session::get('groupe');
		$groupe_id = Input::get('groupe');
		$groupes = Session::get('groupes');

		/* Disaffect the group to each student that have been got out of the class */
		foreach ($ids as $id) {
			Profil::deleteGroupe($id,$groupes[$groupe_id]->id);
		}

		/* Affect the group to each student that have been got into the class */
		foreach($groupe as $g){
			Profil::addGroupe($g->id, $groupes[$groupe_id]->id);
		}

		/* Get all students */
		$profils = Profil::selectAll();
	
		/* Stringify profil objects to use them in select inputs */ 
		$eleves = Util::stringifyObject($profils,"profil");

		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('eleves',$eleves);
		Session::put('profils',$profils);
		Session::put('groupes',null);
		Session::put('groupe', []);
		Session::put('nom',null);
		Session::put('ids',null);
		Session::put('groupes_aff',null);

		/* Show create groupe view with all needed informations */
		return View::make("administration.scolarite.groupes",['eleves' => $eleves, 'groupe' => [], 'nom' => null, 'type' => 0]);
	}

	/**
	 * Delete a selected group.
	 *
	 * @return "Create" groupe view
	 */	

	public function delete(){		

		/* Get the selected group */
		$groupe_id = Input::get('groupe');
		$groupes = Session::get('groupes');
		$groupe = $groupes[$groupe_id];

		/* Delete group */
		Groupe::deleteGroupe($groupe->id);

		/* Get all students */
		$profils = Profil::selectAll();
	
		/* Stringify profil objects to use them in select inputs */ 
		$eleves = Util::stringifyObject($profils,"profil");	

		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('groupes',null);
		Session::put('groupe', []);
		Session::put('nom',null);
		Session::put('ids',null);
		Session::put('groupes_aff',null);
		Session::put('eleves',$eleves);
		Session::put('profils',$profils);

		/* Show create groupe view with all needed informations */
		return View::make("administration.scolarite.groupes",['eleves' => $eleves, 'groupe' => [], 'nom' => null, 'type' => 0]);
	}

	
	/**
	 * Add a student to a group.
	 *
	 * @return "Create" View or "Update or delete" View 
	 */	

	public function addProfil(){

		/* Get the student to add to the group */ 
		$profil_id = Input::get('eleve');
		$nom = Input::get('nom');
		$type = Input::get('type');
		$groupe = Session::get('groupe');
		$profils = Session::get('profils');

		/* Add the student to the group */ 
		array_push($groupe,$profils[$profil_id]);
	    
		/* Get the student out of the selection input */
	    $profils = Util::diff($profils,$groupe);

	    /* Stringify profil objects to use them in select inputs */ 
		$eleves = Util::stringifyObject($profils,"profil");

		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('groupe',$groupe);
		Session::put('profils',$profils);
		Session::put('eleves',$eleves);
		Session::put('nom',$nom);
		Session::put('type',$type);
	}


	/**
	 * Delete a profil.
	 *
	 * @param profil id to delete
	 *
	 * @return "Create" groupe view or "Update or delete" groupe view
	 */	

	public function deleteProfil($id){

		/* Get the profil to delete*/
		$groupe = Session::get('groupe');
		$profils = Session::get('profils');
		$ids = Session::get('ids');
        $eleve = Profil::getProfil($id);

        /* Add profil id to ids to delete */
		if($ids == null){
			$ids = [$id];
		}else{
			array_push($ids, $id);	
		}
		
		/* Get out the selected student of the group */
		$groupe = Util::diff($groupe,$eleve);
		
		/* Put selected student on selection input */
		array_push($profils,$eleve[0]);

		/* Stringify profil objects to use them in select inputs */ 		
		$eleves = Util::stringifyObject($profils,"profil");

		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('groupe',$groupe);
		Session::put('profils',$profils);
		Session::put('eleves',$eleves);
		Session::put('ids',$ids);

		return View::make(Session::get('calledPage'),['groupes' => Session::get('groupes_aff'), 'groupe' => $groupe, 'eleves' => $eleves, 'oldgroupe' => Session::get('oldgroupe'), 'nom' => Session::get('nom'), 'type' => Session::get('type')]);	
	 	
	}

}