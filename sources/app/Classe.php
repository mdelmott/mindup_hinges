<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classe extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'classe';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['nom'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden;// = ['password', 'remember_token'];


	/* Creer un profil */
	public static function createClasse($nom){
		return DB::table("classe")->insertGetId(['nom'=>$nom]);
	}

	public static function selectAll(){
		return DB::table("classe")->get();
	}

	public static function deleteClasse($id){
		return DB::table("classe")->where('id',$id)->delete();
	}
}
