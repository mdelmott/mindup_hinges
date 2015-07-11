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

Route::get('/', ["as"=>"administration", "uses"=>'HomeController@index']);

//Uniquement pour les tests de vue. On utilisera les controllers.

/* Scolarite */
Route::get('/Scolarite',['as'=>'Scolarite', 'uses' => function(){
	return view('administration.scolarite.profils');
}]);

Route::get('/Scolarite/Profils',['as'=>'Scolarite.Profils', 'uses' => function(){
	return view('administration.scolarite.profils');
}]);

Route::get('/Scolarite/Profils/Supprimer',['as'=>'Scolarite.Profils.Supprimer', 'uses' => function(){
	return view('administration.scolarite.profilsSupprimer');
}]);

Route::get('/Scolarite/Classes',['as'=>'Scolarite.Classes', 'uses' => function(){
	return view('administration.scolarite.classes');
}]);

Route::get('/Scolarite/Classes/Supprimer',['as'=>'Scolarite.Classes.Supprimer', 'uses' => function(){
	return view('administration.scolarite.classesSupprimer');
}]);

Route::get('/Scolarite/Groupes',['as'=>'Scolarite.Groupes', 'uses' => function(){
	return view('administration.scolarite.groupes');
}]);

Route::get('/Scolarite/Groupes/Supprimer',['as'=>'Scolarite.Groupes.Supprimer', 'uses' => function(){
	return view('administration.scolarite.groupesSupprimer');
}]);

/* INSCRIPTION */

Route::get('/Inscription',['as'=>'Inscription', 'uses' => function(){
	return view('administration.inscription.cantine');
}]);

Route::get('/Inscription/Cantine',['as'=>'Inscription.Cantine', 'uses' => function(){
	return view('administration.inscription.cantine');
}]);

Route::get('/Inscription/TAP',['as'=>'Inscription.TAP', 'uses' => function(){
	return view('administration.inscription.tap');
}]);


/* PREVISION */
Route::get('/Prevision',['as'=>'Prevision', 'uses' => function(){
	return view('administration.prevision');
}]);

/* FACTURATION */

Route::get('/Facturation',['as'=>'Facturation', 'uses' => function(){
	return view('administration.facturation.cantine');
}]);

Route::get('/Facturation/Cantine',['as'=>'Facturation.Cantine', 'uses' => function(){
	return view('administration.facturation.cantine');
}]);

Route::get('/Facturation/Garderie',['as'=>'Facturation.Garderie', 'uses' => function(){
	return view('administration.facturation.garderie');
}]);

Route::get('/Facturation/TAP',['as'=>'Facturation.TAP', 'uses' => function(){
	return view('administration.facturation.tap');
}]);

/* TARIFS */

Route::get('/Tarifs',['as'=>'Tarifs', 'uses' => function(){
	return view('administration.tarifs');
}]);

/* Comptes */

Route::get('/Comptes',['as'=>'Comptes', 'uses' => function(){
	return view('administration.comptes.administration');
}]);

Route::get('/Comptes/Administration',['as'=>'Comptes.Administration', 'uses' => function(){
	return view('administration.comptes.administration');
}]);

Route::get('/Comptes/Autres',['as'=>'Comptes.Autres', 'uses' => function(){
	return view('administration.comptes.autres');
}]);


//Route::get('home', 'HomeController@index');

/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
*/