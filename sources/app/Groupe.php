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

	public static function selectAllTAP(){
		return DB::table("groupe")->where('type',0)->get();
	}

	public static function deleteGroupe($id){
		DB::table("groupe_profil")->where('groupe_id',$id)->delete();
		return DB::table("groupe")->where('id',$id)->delete();
	}

	public static function getAllStudentsTAP($id, $d){
		$table1 = DB::table('groupe_profil')->join('tap_profil','groupe_profil.profil_id','=','tap_profil.id_profil')->where('groupe_profil.groupe_id',$id)->get();
		$date = date_format($d,'Y-m-d');
		$table2 = DB::table("tap")->join('tap_profil', 'tap.id', '=', 'tap_profil.id_tap')->where(['tap.date'=> $date,'tap_profil.absent' => -1])->get(); 
		$tap_profil =  Util::merge($table1,$table2);
		$returnedObject = []; 
		foreach($tap_profil as $tp){ 
			$object = [
				'id' => $tp->id,
				'profil' => Profil::getProfil($tp->id_profil)[0]
			];
			array_push($returnedObject, $object);
		}
		return $returnedObject;
	}
}
