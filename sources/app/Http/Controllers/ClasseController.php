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


class ClasseController extends Controller {

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

	public function createOrAdd(){
		
		$action = Input::get('action');

		switch($action){
			case "Ajouter" : $this->addProfil();break;
			case "Enregistrer": $this->create();break;
		}
		
		return View::make("administration.scolarite.classes",['eleves' => Session::get('eleves'), 'classe' => Session::get('classe'), 'nom' => Session::get('nom')]);
	}

	/**
	 * Update or Delete Classe View's controller.
	 *
	 * Redirect each button of the page to the correesponding method.
	 *
	 * @return "Update or delete" classe view
	 */

	public function updateOrDelete(){
		
		$action = Input::get('action');
		
		switch($action){
			case "Ajouter" : $this->addProfil();break;
			case "Enregistrer les modifications": return $this->update();break;
			case "Supprimer cette classe":  return $this->delete();break;
			default: return $this->show();break;
		}

		return View::make("administration.scolarite.classesSupprimer",['classes' => Session::get('classes_aff'), 'classe' => Session::get('classe'), 'eleves' => Session::get('eleves'), 'oldclasse' => Session::get('oldclasse')]);	
	}


	/**
	 * Show the application dashboard to the user.
	 *
	 * @return "Create" classe view
	 */

	public function index(){

		/* Get all students not affected to a class */
		$profils = Profil::selectAllByClasse(null);
	
		/* Stringify profil objects to use them in select inputs */ 
		$eleves = Util::stringifyObject($profils,"profil");
		
		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('classe',[]);
		Session::put('profils',$profils);
		Session::put('eleves',$eleves);
		Session::put('calledPage',"administration.scolarite.classes");

		/* Show create classe view with all needed informations */
		return View::make('administration.scolarite.classes',['eleves' => $eleves,'classe' => [], 'nom' => ""]);
	}


	/**
	 * Show selected classe's informations.
	 *
	 * @return "Update or delete" classe view
	 */	

	public function show(){

		/* Get the selected class */ 
		$classe_id = Input::get('classe');
		$classes = Session::get('classes');
		$classes_aff = Session::get('classes_aff');

		$ids = [];

		/* Select all the classes and stringify profil objects to use them in select inputs */
		if($classes == null){
			$classes = Classe::selectAll();
			$classes_aff = Util::stringifyObject($classes,"other");
		}

		/* Get selected class students (If it is the first time that the function is called, we get first class's students) */
		if($classe_id != null){
			$oldclasse = $classe_id;
			$classe_id = $classes[$classe_id]->id;
			$classe = Profil::selectAllByClasse($classe_id);
		}else{
			$oldclasse = null;
			if(count($classes) > 0){
				$classe_id = $classes[0]->id;
				$classe = Profil::selectAllByClasse($classe_id);
			}else{
				$classe = [];
			}	
		}

		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('classe',$classe);
		Session::put('classes', $classes);
		Session::put('classes_aff', $classes_aff);
		Session::put('ids', $ids);
		Session::put('oldclasse',$oldclasse);
		Session::put('calledPage',"administration.scolarite.classesSupprimer");
		
		/* Show create classe view with all needed informations */
		return View::make("administration.scolarite.classesSupprimer",['classes' => $classes_aff, 'classe' => $classe, 'eleves' => Session::get('eleves'), 'oldclasse' => $oldclasse]);	
	
	}


	/**
	 * Create a new class.
	 *
	 * @return "Create" classe view 
	 */	

	public function create(){
		
		/* Get the students and the name of the class*/
		$elevesClasse = Session::get('classe');
		$eleves = Session::get('eleves');
		$nom = Input::get('nom');

		/* Creation of the class in class table with class's name */ 
		$classe_id = Classe::createClasse($nom);

		/* Affect class for all the students */ 
		foreach($elevesClasse as $ec){
			Profil::changeClasse($ec->id,$classe_id);
		}

		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('eleves',$eleves);
		Session::put('classe', []);
		Session::put('nom',null);
		Session::put('classes',null);
		Session::put('classes_aff',null);
	}

	/**
	 * Update a selected class.
	 *
	 * @return "Create" classe view
	 */	

	public function update(){		

		/* Get the selected class and its students */
		$ids = Session::get('ids');
		$classe = Session::get('classe');
		$classe_id = Input::get('classe');
		$classes = Session::get('classes');

		/* Disaffect the class to each student that have been got out of the class */
		foreach ($ids as $id) {
			Profil::changeClasse($id,null);
		}

		/* Affect the class to each student that have been got into the class */
		foreach($classe as $c){
			Profil::changeClasse($c->id, $classes[$classe_id]->id);
		}

		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('classes',null);
		Session::put('classe', []);
		Session::put('nom',null);
		Session::put('ids',null);
		Session::put('classes_aff',null);

		/* Show create classe view with all needed informations */
		return View::make("administration.scolarite.classes",['eleves' => Session::get('eleves'), 'classe' => [], 'nom' => null]);
	}

	/**
	 * Delete a selected class.
	 *
	 * @return "Create" classe view
	 */	

	public function delete(){		

		/* Get the selected class */
		$classe_id = Input::get('classe');
		$classes = Session::get('classes');
		$profils = Session::get('profils');
		$classe = $classes[$classe_id];

		/* Select all the students of selected class */
		$elevesSansClasse = Profil::selectAllByClasse($classe->id);

		/* Disaffect the class to each student of this class and put them on selection input */
		foreach ($elevesSansClasse as $eleve) {
		 	Profil::changeClasse($eleve->id,null);
		 	array_push($profils,$eleve);
		}

		/* Stringify profil objects to use them in select inputs */ 
		$eleves = Util::stringifyObject($profils,"profil");		

		/* Delete selected class */
		Classe::deleteClasse($classe->id);

		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('classes',null);
		Session::put('classe', []);
		Session::put('nom',null);
		Session::put('ids',null);
		Session::put('classes_aff',null);
		Session::put('eleves',$eleves);
		Session::put('profils',$profils);

		/* Show create classe view with all needed informations */
		return View::make("administration.scolarite.classes",['eleves' => $eleves, 'classe' => [], 'nom' => null]);
	}

	
	/**
	 * Add a student to a class.
	 *
	 * @return "Create" View or "Update or delete" View 
	 */	

	public function addProfil(){

		/* Get the student to add to the class */ 
		$profil_id = Input::get('eleve');
		$nom = Input::get('nom');
		$classe = Session::get('classe');
		$profils = Session::get('profils');

		/* Add the student to the class */ 
		array_push($classe,$profils[$profil_id]);
	    
		/* Get the student out of the selection input */
	    $profils = Util::diff($profils,$classe);

	    /* Stringify profil objects to use them in select inputs */ 
		$eleves = Util::stringifyObject($profils,"profil");

		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('classe',$classe);
		Session::put('profils',$profils);
		Session::put('eleves',$eleves);
		Session::put('nom',$nom);
	}


	/**
	 * Delete a profil.
	 *
	 * @param profil id to delete
	 *
	 * @return "Create" classe view or "Update or delete" classe view
	 */	

	public function deleteProfil($id){

		/* Get the profil to delete*/
		$classe = Session::get('classe');
		$profils = Session::get('profils');
		$ids = Session::get('ids');
        $eleve = Profil::getProfil($id);

        /* Add profil id to ids to delete */
		if($ids == null){
			$ids = [$id];
		}else{
			array_push($ids, $id);	
		}
		
		/* Get out the selected student of the class */
		$classe = Util::diff($classe,$eleve);
		
		/* Put selected student on selection input */
		array_push($profils,$eleve[0]);

		/* Stringify profil objects to use them in select inputs */ 		
		$eleves = Util::stringifyObject($profils,"profil");

		/* Save each variable in session variable to use them in other method of the conntroller*/
		Session::put('classe',$classe);
		Session::put('profils',$profils);
		Session::put('eleves',$eleves);
		Session::put('ids',$ids);

		return View::make(Session::get('calledPage'),['classes' => Session::get('classes_aff'), 'classe' => $classe, 'eleves' => $eleves, 'oldclasse' => Session::get('oldclasse'), 'nom' => Session::get('nom')]);	
	 	
	}

}