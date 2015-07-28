<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Adresse extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'adresse';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['numero', 'rue', 'ville', 'cp'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden;// = ['password', 'remember_token'];


	/* Creer un profil */
	public static function createAdresse($numero, $rue, $ville, $cp){
		return DB::table("adresse")->insertGetId(['numero' => $numero,'rue'=>$rue, 'ville'=>$ville, "cp" => $cp]);
	}

	public static function getAdresse($id){
		return DB::table("adresse")->where('id',$id)->get();
	}

	public static function updateAdresse($id, $numero, $rue, $ville, $cp){
		DB::table("adresse")->where('id',$id)->update(['numero' => $numero, 'rue' => $rue, 'ville' => $ville, 'cp' => $cp]);
	}

	public static function deleteAdresse($id){
		DB::table("adresse")->where('id',$id)->delete();
	}	

}