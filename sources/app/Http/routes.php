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


Route::get('/', ["as"=>"administration", "uses"=>'HomeController@index', 'middleware' => 'auth']);

//Uniquement pour les tests de vue. On utilisera les controllers.

/* Scolarite */

   	/* Profils */
   	
   	Route::get('/Scolarite',['as'=>'Scolarite', 'uses'=>'ProfilController@index', 'middleware' => 'auth']);
	Route::get('/Scolarite/Profils',['as'=>'Scolarite.Profils', 'uses' => 'ProfilController@index', 'middleware' => 'auth']);
	Route::get('/Scolarite/Profils/ModifierOuSupprimer',['as'=>'Scolarite.Profils.ModifierOuSupprimer', 'uses' => 'ProfilController@show', 'middleware' => 'auth']);

	Route::post('/Scolarite/Profils/Create',['as'=>'Scolarite.Profils.Create', 'uses'=>'ProfilController@create', 'middleware' => 'auth']);
	Route::post('/Scolarite/Profils/UpdateOrDelete',['as'=>'Scolarite.Profils.UpdateOrDelete', 'uses'=>'ProfilController@updateOrDelete', 'middleware' => 'auth']);

	/* Classes */
	
	Route::get('/Scolarite/Classes',['as'=>'Scolarite.Classes', 'uses' => 'ClasseController@index','middleware' => 'auth']);
	Route::get('/Scolarite/Classes/ModifierOuSupprimer',['as'=>'Scolarite.Classes.ModifierOuSupprimer', 'uses' => 'ClasseController@show','middleware' => 'auth']);

	Route::post('/Scolarite/Classes/Create',['as'=>'Scolarite.Classes.Create', 'uses'=>'ClasseController@createOrAdd', 'middleware' => 'auth']);
	Route::get('/Scolarite/Classes/DeleteProfil/{id}',['as'=>'Scolarite.Classes.DeleteProfil', 'uses'=>'ClasseController@deleteProfil', 'middleware' => 'auth']);
	Route::post('/Scolarite/Classes/UpdateOrDelete',['as'=>'Scolarite.Classes.UpdateOrDelete', 'uses'=>'ClasseController@updateOrDelete', 'middleware' => 'auth']);
	

	/* Groupes */

	Route::get('/Scolarite/Groupes',['as'=>'Scolarite.Groupes', 'uses' => 'GroupeController@index','middleware' => 'auth']);
	Route::get('/Scolarite/Groupes/ModifierOuSupprimer',['as'=>'Scolarite.Groupes.ModifierOuSupprimer', 'uses' => 'GroupeController@show','middleware' => 'auth']);

	Route::post('/Scolarite/Groupes/Create',['as'=>'Scolarite.Groupes.Create', 'uses'=>'GroupeController@createOrAdd', 'middleware' => 'auth']);
	Route::get('/Scolarite/Groupes/DeleteProfil/{id}',['as'=>'Scolarite.Groupes.DeleteProfil', 'uses'=>'GroupeController@deleteProfil', 'middleware' => 'auth']);
	Route::post('/Scolarite/Groupes/UpdateOrDelete',['as'=>'Scolarite.Groupes.UpdateOrDelete', 'uses'=>'GroupeController@updateOrDelete', 'middleware' => 'auth']);


/* INSCRIPTION */

Route::get('/Inscription',['as'=>'Inscription', 'uses' => 'InscriptionCantineController@index', 'middleware' => 'auth']);

Route::get('/Inscription/Cantine',['as'=>'Inscription.Cantine', 'uses' => 'InscriptionCantineController@index', 'middleware' => 'auth']);
Route::post('/Inscription/Cantine/Create',['as'=>'Inscription.Cantine.Create', 'uses' => 'InscriptionCantineController@createOrDelete', 'middleware' => 'auth']);

Route::get('/Inscription/TAP',['as'=>'Inscription.TAP', 'uses' => 'InscriptionTAPController@index', 'middleware' => 'auth']);
Route::post('/Inscription/TAP/Create',['as'=>'Inscription.TAP.Create', 'uses' => 'InscriptionTAPController@createOrDelete', 'middleware' => 'auth']);


/* PREVISION */

Route::get('/Prevision',['as'=>'Prevision', 'uses' => function(){
	return view('administration.prevision');
}, 'middleware' => 'auth']);


/* FACTURATION */

Route::get('/Facturation',['as'=>'Facturation', 'uses' => function(){
	return view('administration.facturation.cantine');
}, 'middleware' => 'auth']);

Route::get('/Facturation/Cantine',['as'=>'Facturation.Cantine', 'uses' => function(){
	return view('administration.facturation.cantine');
}, 'middleware' => 'auth']);

Route::get('/Facturation/Garderie',['as'=>'Facturation.Garderie', 'uses' => function(){
	return view('administration.facturation.garderie');
}, 'middleware' => 'auth']);

Route::get('/Facturation/TAP',['as'=>'Facturation.TAP', 'uses' => function(){
	return view('administration.facturation.tap');
}, 'middleware' => 'auth']);


/* TARIFS */

Route::get('/Tarifs',['as'=>'Tarifs', 'uses' => 'TarifController@index', 'middleware' => 'auth']);
Route::post('/Tarifs/Update',['as'=>'Tarifs.Update', 'uses'=>'TarifController@update', 'middleware' => 'auth']);
	

/* Comptes */

Route::get('/Comptes',['as'=>'Comptes', 'uses' => function(){
	return view('administration.comptes.administration');
}, 'middleware' => 'auth']);

Route::get('/Comptes/Administration',['as'=>'Comptes.Administration', 'uses' => function(){
	return view('administration.comptes.administration');
}, 'middleware' => 'auth']);

Route::get('/Comptes/Autres',['as'=>'Comptes.Autres', 'uses' => function(){
	return view('administration.comptes.autres');
}, 'middleware' => 'auth']);


/* Cantines */

Route::get('/Cantine',['as'=>'Cantine', 'uses' => 'CantineController@index', 'middleware' => 'auth']);
Route::post('/Cantine',['as'=>'Cantine', 'uses' => 'CantineController@index', 'middleware' => 'auth']);
Route::get('/Cantine/Check/{id}/{presence}',['as'=>'Cantine.Check', 'uses' => 'CantineController@check', 'middleware' => 'auth']);

/* TAP */

Route::get('/TAP',['as'=>'TAP', 'uses' => 'TAPController@index', 'middleware' => 'auth']);
Route::post('/TAP',['as'=>'TAP', 'uses' => 'TAPController@index', 'middleware' => 'auth']);
Route::get('/TAP/Check/{id}/{presence}',['as'=>'TAP.Check', 'uses' => 'TAPController@check', 'middleware' => 'auth']);

/* Enseignants */

Route::get('/Enseignants',['as'=>'Enseignants', 'uses' => 'EnseignantController@index', 'middleware' => 'auth']);

Route::get('home', ['uses'=>'HomeController@index', 'middleware' => 'auth']);

/* Garderie */
Route::get('/Garderie',['as'=>'Garderie', 'uses' => "GarderieController@index", 'middleware' => 'auth']);


/** AJAX **/
Route::get('/ChargementEleve',['as' => 'AjaxChargementProfil', 'uses' => 'GarderieController@chargementProfil', 'middleware' => 'auth']);
Route::get('/AjoutHoraire',['as' => 'AjaxAjoutHoraire', 'uses' => 'GarderieController@ajoutHoraire', 'middleware' => 'auth']);
Route::get('/ChargementEleveEnseignant',['as' => 'AjaxChargementProfilEnseignant', 'uses' => 'EnseignantController@chargementProfil', 'middleware' => 'auth']);

/** Connexion **/
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

?>