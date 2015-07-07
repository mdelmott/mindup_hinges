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

//Uniquement pour les tests. On utilisera les controllers.
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

//Route::get('home', 'HomeController@index');

/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
*/