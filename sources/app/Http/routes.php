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
Route::get('/Scolarite',['as'=>'Scolarite', 'uses' => function(){
	return view('administration.scolarite.profils');
}, 'middleware' => 'auth']);

Route::get('/Scolarite/Profils',['as'=>'Scolarite.Profils', 'uses' => function(){
	return view('administration.scolarite.profils');
}, 'middleware' => 'auth']);

Route::get('/Scolarite/Profils/Supprimer',['as'=>'Scolarite.Profils.Supprimer', 'uses' => function(){
	return view('administration.scolarite.profilsSupprimer');
}, 'middleware' => 'auth']);

Route::get('/Scolarite/Classes',['as'=>'Scolarite.Classes', 'uses' => function(){
	return view('administration.scolarite.classes');
}, 'middleware' => 'auth']);

Route::get('/Scolarite/Classes/Supprimer',['as'=>'Scolarite.Classes.Supprimer', 'uses' => function(){
	return view('administration.scolarite.classesSupprimer');
}, 'middleware' => 'auth']);

Route::get('/Scolarite/Groupes',['as'=>'Scolarite.Groupes', 'uses' => function(){
	return view('administration.scolarite.groupes');
}, 'middleware' => 'auth']);

Route::get('/Scolarite/Groupes/Supprimer',['as'=>'Scolarite.Groupes.Supprimer', 'uses' => function(){
	return view('administration.scolarite.groupesSupprimer');
}, 'middleware' => 'auth']);

/* INSCRIPTION */

Route::get('/Inscription',['as'=>'Inscription', 'uses' => function(){
	return view('administration.inscription.cantine');
}, 'middleware' => 'auth']);

Route::get('/Inscription/Cantine',['as'=>'Inscription.Cantine', 'uses' => function(){
	return view('administration.inscription.cantine');
}, 'middleware' => 'auth']);

Route::get('/Inscription/TAP',['as'=>'Inscription.TAP', 'uses' => function(){
	return view('administration.inscription.tap');
}, 'middleware' => 'auth']);


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

Route::get('/Tarifs',['as'=>'Tarifs', 'uses' => function(){
	return view('administration.tarifs');
}, 'middleware' => 'auth']);

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
Route::get('/Cantine',['as'=>'Cantine', 'uses' => function(){
	return view('cantine');
}, 'middleware' => 'auth']);

/* TAP */
Route::get('/TAP',['as'=>'TAP', 'uses' => function(){
	return view('tap');
}, 'middleware' => 'auth']);

/* Garderie */
Route::get('/Garderie',['as'=>'Garderie', 'uses' => function(){
	return view('garderie.matin');
}, 'middleware' => 'auth']);

Route::get('/Garderie/Matin',['as'=>'Garderie.Matin', 'uses' => function(){
	return view('garderie.matin');
}, 'middleware' => 'auth']);

Route::get('/Garderie/ApresMidi',['as'=>'Garderie.ApresMidi', 'uses' => function(){
	return view('garderie.apresmidi');
}, 'middleware' => 'auth']);

/* Enseignants */

Route::get('/Enseignants',['as'=>'Enseignants', 'uses' => function(){
	return view('enseignants');
}, 'middleware' => 'auth']);

Route::get('home', ['uses'=>'HomeController@index', 'middleware' => 'auth']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
?>