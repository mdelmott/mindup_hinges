<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tarif extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tarifs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['nom','tarif'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden;// = ['password', 'remember_token'];


	/* Creer un profil */
	public static function getTarif($nom){
		$tarif = DB::table("tarifs")->where(['nom'=>$nom])->get();
		if(count($tarif)>0){
			return number_format($tarif[0]->tarif,2);
		}else{
			return null;
		}
	}

	public static function updateTarif($nom,$tarif){
		$count = DB::table("tarifs")->where(['nom' => $nom])->count();
		if($count == 0){
			DB::table("tarifs")->insert(['nom'=>$nom, 'tarif' => $tarif]);
		}else{
			DB::table("tarifs")->where(['nom'=>$nom])->update(['tarif' => $tarif]);
		}	
	}
}
