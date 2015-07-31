<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Repas extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'repas';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['date'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden;// = ['password', 'remember_token'];


	/* Creer un profil */
	public static function createRepas($date){
		$repas = DB::table("repas")->where(['date'=>$date])->get();
		if(count($repas)>0){
			return $repas[0]->id;
		}else{
			return DB::table("repas")->insertGetId(['date'=>$date]);
		}
	}

	public static function getRepasId($date){
		$repas = DB::table("repas")->where(['date'=>$date])->get();
		if(count($repas)>0){
			return $repas[0]->id;
		}else{
			return null;
		}
	}
}
