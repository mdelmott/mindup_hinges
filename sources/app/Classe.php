<?php namespace App;

use App\Util;

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

	public static function getAllStudentsCafet($id, $d){
		$table1 = DB::table("profil")->join('repas_profil', 'profil.id', '=', 'repas_profil.id_profil')->where(['profil.classe_id' => $id, 'repas_profil.absent' => -1])->get();
		$date = date_format($d,'Y-m-d');
		$table2 = DB::table("repas")->join('repas_profil', 'repas.id', '=', 'repas_profil.id_repas')->where('repas.date', $date)->get(); 
		$repas_profil =  Util::merge($table1,$table2);
		$returnedObject = []; 
		foreach($repas_profil as $rp){ 
			$object = [
				'id' => $rp->id,
				'profil' => Profil::getProfil($rp->id_profil)[0]
			];
			array_push($returnedObject, $object);
		}
		return $returnedObject;
	}

	public static function getPrevisions($id, $d){
		$table1 = DB::table("profil")->join('repas_profil', 'profil.id', '=', 'repas_profil.id_profil')->where(['profil.classe_id' => $id])->get();
		$table2 = DB::table("repas")->join('repas_profil', 'repas.id', '=', 'repas_profil.id_repas')->where('repas.date', $d)->get(); 
		$repas_profil =  Util::merge($table1,$table2);
		$returnedObject = ['date' => $d ,'profils' => $repas_profil, 'count' => count($repas_profil)]; 
		return $returnedObject;
	}

}
