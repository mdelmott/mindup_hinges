<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Groupe extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'groupe';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['nom','type'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden;// = ['password', 'remember_token'];


	/* Creer un profil */
	public static function createGroupe($nom, $type){
		return DB::table("groupe")->insertGetId(['nom'=>$nom, 'type'=>$type]);
	}

	public static function selectAll(){
		return DB::table("groupe")->get();
	}

	public static function deleteGroupe($id){
		DB::table("groupe_profil")->where('groupe_id',$id)->delete();
		return DB::table("groupe")->where('id',$id)->delete();
	}
}
