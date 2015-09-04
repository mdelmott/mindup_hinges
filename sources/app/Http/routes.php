<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', ["as"=>"administration", "uses"=>'HomeController@index', 'middleware' => ['auth', 'verifUser']]);

//Uniquement pour les tests de vue. On utilisera les controllers.

/* Scolarite */

   	/* Profils */
   	
   	Route::get('/Scolarite',['as'=>'Scolarite', 'uses'=>'ProfilController@index', 'middleware' => ['auth', 'verifUser']]);
	Route::get('/Scolarite/Profils',['as'=>'Scolarite.Profils', 'uses' => 'ProfilController@index', 'middleware' => ['auth', 'verifUser']]);
	Route::get('/Scolarite/Profils/ModifierOuSupprimer',['as'=>'Scolarite.Profils.ModifierOuSupprimer', 'uses' => 'ProfilController@show', 'middleware' => ['auth', 'verifUser']]);

	Route::post('/Scolarite/Profils/Create',['as'=>'Scolarite.Profils.Create', 'uses'=>'ProfilController@create', 'middleware' => ['auth', 'verifUser']]);
	Route::post('/Scolarite/Profils/UpdateOrDelete',['as'=>'Scolarite.Profils.UpdateOrDelete', 'uses'=>'ProfilController@updateOrDelete', 'middleware' => ['auth', 'verifUser']]);

	/* Classes */
	
	Route::get('/Scolarite/Classes',['as'=>'Scolarite.Classes', 'uses' => 'ClasseController@index','middleware' => ['auth', 'verifUser']]);
	Route::get('/Scolarite/Classes/ModifierOuSupprimer',['as'=>'Scolarite.Classes.ModifierOuSupprimer', 'uses' => 'ClasseController@show','middleware' => ['auth', 'verifUser']]);

	Route::post('/Scolarite/Classes/Create',['as'=>'Scolarite.Classes.Create', 'uses'=>'ClasseController@createOrAdd', 'middleware' => ['auth', 'verifUser']]);
	Route::get('/Scolarite/Classes/DeleteProfil/{id}',['as'=>'Scolarite.Classes.DeleteProfil', 'uses'=>'ClasseController@deleteProfil', 'middleware' => ['auth', 'verifUser']]);
	Route::post('/Scolarite/Classes/UpdateOrDelete',['as'=>'Scolarite.Classes.UpdateOrDelete', 'uses'=>'ClasseController@updateOrDelete', 'middleware' => ['auth', 'verifUser']]);
	

	/* Groupes */

	Route::get('/Scolarite/Groupes',['as'=>'Scolarite.Groupes', 'uses' => 'GroupeController@index','middleware' => ['auth', 'verifUser']]);
	Route::get('/Scolarite/Groupes/ModifierOuSupprimer',['as'=>'Scolarite.Groupes.ModifierOuSupprimer', 'uses' => 'GroupeController@show','middleware' => ['auth', 'verifUser']]);

	Route::post('/Scolarite/Groupes/Create',['as'=>'Scolarite.Groupes.Create', 'uses'=>'GroupeController@createOrAdd', 'middleware' => ['auth', 'verifUser']]);
	Route::get('/Scolarite/Groupes/DeleteProfil/{id}',['as'=>'Scolarite.Groupes.DeleteProfil', 'uses'=>'GroupeController@deleteProfil', 'middleware' => ['auth', 'verifUser']]);
	Route::post('/Scolarite/Groupes/UpdateOrDelete',['as'=>'Scolarite.Groupes.UpdateOrDelete', 'uses'=>'GroupeController@updateOrDelete', 'middleware' => ['auth', 'verifUser']]);


/* INSCRIPTION */

Route::get('/Inscription',['as'=>'Inscription', 'uses' => 'InscriptionCantineController@index', 'middleware' => ['auth', 'verifUser']]);

Route::get('/Inscription/Cantine',['as'=>'Inscription.Cantine', 'uses' => 'InscriptionCantineController@index', 'middleware' => ['auth', 'verifUser']]);
Route::post('/Inscription/Cantine/Create',['as'=>'Inscription.Cantine.Create', 'uses' => 'InscriptionCantineController@createOrDelete', 'middleware' => ['auth', 'verifUser']]);

Route::get('/Inscription/TAP',['as'=>'Inscription.TAP', 'uses' => 'InscriptionTAPController@index', 'middleware' => ['auth', 'verifUser']]);
Route::post('/Inscription/TAP/Create',['as'=>'Inscription.TAP.Create', 'uses' => 'InscriptionTAPController@createOrDelete', 'middleware' => ['auth', 'verifUser']]);


/* PREVISION */

Route::get('/Prevision',['as'=>'Prevision', 'uses' => 'PrevisionController@index', 'middleware' => ['auth', 'verifUser']]);
Route::post('/Prevision',['as'=>'Prevision', 'uses' => 'PrevisionController@index', 'middleware' => ['auth', 'verifUser']]);

/* FACTURATION */

Route::get('/Facturation',['as'=>'Facturation', 'uses' => 'FacturationCantineController@index', 'middleware' => ['auth', 'verifUser']]);
Route::get('/Facturation/Cantine',['as'=>'Facturation.Cantine', 'uses' => 'FacturationCantineController@index', 'middleware' => ['auth', 'verifUser']]);
Route::post('/Facturation/Cantine',['as'=>'Facturation.Cantine', 'uses' => 'FacturationCantineController@index', 'middleware' => ['auth', 'verifUser']]);

Route::get('/Facturation/Garderie',['as'=>'Facturation.Garderie', 'uses' => 'FacturationGarderieController@index', 'middleware' => ['auth', 'verifUser']]);
Route::post('/Facturation/Garderie',['as'=>'Facturation.Garderie', 'uses' => 'FacturationGarderieController@index', 'middleware' => ['auth', 'verifUser']]);

Route::get('/Facturation/TAP',['as'=>'Facturation.TAP', 'uses' => 'FacturationTAPController@index', 'middleware' => ['auth', 'verifUser']]);
Route::post('/Facturation/TAP',['as'=>'Facturation.TAP', 'uses' => 'FacturationTAPController@index', 'middleware' => ['auth', 'verifUser']]);

/* TARIFS */

Route::get('/Tarifs',['as'=>'Tarifs', 'uses' => 'TarifController@index', 'middleware' => ['auth', 'verifUser']]);
Route::post('/Tarifs/Update',['as'=>'Tarifs.Update', 'uses'=>'TarifController@update', 'middleware' => ['auth', 'verifUser']]);
	

/* Comptes */

Route::get('/Comptes',['as'=>'Comptes', 'uses' => 'GestionComptesController@changeAdminDatas', 'middleware' => ['auth', 'verifUser']]);
Route::get('/Comptes/Administration',['as'=>'Comptes.Administration', 'uses' => 'GestionComptesController@changeAdminDatas', 'middleware' => ['auth', 'verifUser']]);
Route::post('/Comptes/Administration',['as'=>'Comptes.Administration', 'uses' => 'GestionComptesController@changeAdminDatas', 'middleware' => ['auth', 'verifUser']]);
Route::get('/Comptes/Autres',['as'=>'Comptes.Autres', 'uses' => 'GestionComptesController@changeOtherDatas', 'middleware' => ['auth', 'verifUser']]);
Route::post('/Comptes/Autres',['as'=>'Comptes.Autres', 'uses' => 'GestionComptesController@changeOtherDatas', 'middleware' => ['auth', 'verifUser']]);


/* Cantines */

Route::get('/Cantine',['as'=>'Cantine', 'uses' => 'CantineController@index', 'middleware' => ['auth', 'verifUser']]);
Route::post('/Cantine',['as'=>'Cantine', 'uses' => 'CantineController@index', 'middleware' => ['auth', 'verifUser']]);
Route::get('/Cantine/Check/{id}/{presence}',['as'=>'Cantine.Check', 'uses' => 'CantineController@check', 'middleware' => ['auth', 'verifUser']]);

/* TAP */

Route::get('/TAP',['as'=>'TAP', 'uses' => 'TAPController@index', 'middleware' => ['auth', 'verifUser']]);
Route::post('/TAP',['as'=>'TAP', 'uses' => 'TAPController@index', 'middleware' => ['auth', 'verifUser']]);
Route::get('/TAP/Check/{id}/{presence}',['as'=>'TAP.Check', 'uses' => 'TAPController@check', 'middleware' => ['auth', 'verifUser']]);

/* Enseignants */

Route::get('/Enseignants',['as'=>'Enseignants', 'uses' => 'EnseignantController@index', 'middleware' => ['auth', 'verifUser']]);

Route::get('home', ['uses'=>'HomeController@index', 'middleware' => ['auth', 'verifUser']]);

/* Garderie */
Route::get('/Garderie',['as'=>'Garderie', 'uses' => "GarderieController@index", 'middleware' => ['auth', 'verifUser']]);


/** AJAX **/
Route::get('/ChargementEleve',['as' => 'AjaxChargementProfil', 'uses' => 'GarderieController@chargementProfil', 'middleware' => ['auth', 'verifUser']]);
Route::get('/AjoutHoraire',['as' => 'AjaxAjoutHoraire', 'uses' => 'GarderieController@ajoutHoraire', 'middleware' => ['auth', 'verifUser']]);
Route::get('/ChargementEleveEnseignant',['as' => 'AjaxChargementProfilEnseignant', 'uses' => 'EnseignantController@chargementProfil', 'middleware' => ['auth', 'verifUser']]);

/** Connexion **/
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

?>