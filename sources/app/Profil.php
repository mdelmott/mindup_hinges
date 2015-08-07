<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Profil extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profil';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['nom', 'prenom','tel','adresse','ville','remarques'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden;// = ['password', 'remember_token'];


	/* Creer un profil */
	public static function createProfil($nom, $prenom, $tel, $adresse_id, $remarques){
		DB::table("profil")->insert(['nom'=>$nom, 'prenom'=>$prenom, 'tel'=>$tel, 'adresse_id' => $adresse_id, 'remarques'=>$remarques]);
	}

	/* Creer un profil */
	public static function selectAll(){
		return DB::table("profil")->get();

	}

	public static function selectAllByClasse($classe_id){
		return DB::table("profil")->where('classe_id',$classe_id)->get();
	}

	public static function selectAllByGroupe($groupe_id){
		$returnedArray = [];
		$groupe_profils = DB::table("groupe_profil")->where('groupe_id',$groupe_id)->get();
		foreach ($groupe_profils as $groupe_profil) {
			array_push($returnedArray,Profil::getProfil($groupe_profil->profil_id)[0]);
		}
		return $returnedArray;
	}

	public static function getProfil($id){
		return DB::table("profil")->where("id",$id)->get();
	}

	public static function updateProfil($id, $nom, $prenom, $tel, $remarques){
		DB::table("profil")->where('id',$id)->update(['nom' => $nom, 'prenom' => $prenom, 'tel' => $tel, 'remarques' => $remarques]);
		return DB::table("profil")->where('id',$id)->get();
	}

	public static function deleteProfil($id){
		DB::table("groupe_profil")->where("profil_id",$id)->delete();
		DB::table("tap_profil")->where("id_profil",$id)->delete();
		DB::table("repas_profil")->where("id_profil",$id)->delete();
		DB::table("gar_profil")->where("id_profil",$id)->delete();
		DB::table("profil")->where("id",$id)->delete();
	}

	public static function changeAdresse($id,$adresse_id){
		return DB::table("profil")->where("id",$id)->update(["adresse_id" => $adresse_id]);
	}

	public static function changeClasse($id,$classe_id){
		return DB::table("profil")->where("id",$id)->update(["classe_id" => $classe_id]);
	}

	public static function addGroupe($id,$groupe_id){
		$count = DB::table("groupe_profil")->where(['profil_id' => $id, 'groupe_id' => $groupe_id])->count();
		if($count == 0){
			DB::table("groupe_profil")->insert(['profil_id' => $id, 'groupe_id' => $groupe_id]);	
		}
	}

	public static function deleteGroupe($id,$groupe_id){
		DB::table("groupe_profil")->where(['profil_id' => $id, 'groupe_id' => $groupe_id])->delete();
	}

	public static function getRepas($id){
		return DB::table("repas")->join('repas_profil', 'repas.id', '=', 'repas_profil.id_repas')->where(['repas_profil.id_profil' => $id, 'repas_profil.hors_delai' => 0])->get();
	}

	public static function getRepasHD($id){
		return DB::table("repas")->join('repas_profil', 'repas.id', '=', 'repas_profil.id_repas')->where(['repas_profil.id_profil' => $id, 'repas_profil.hors_delai' => 1])->get();
	}

	public static function addRepas($id,$repas_id,$hd,$prix){
		$count = DB::table('repas_profil')->where(['id_profil' => $id, 'id_repas' => $repas_id])->count();
		if($count == 0){
			DB::table("repas_profil")->insert(['id_profil' => $id, 'id_repas' => $repas_id, 'hors_delai' => $hd, 'absent' => -1, 'prix' => $prix]);
		}
	}

	public static function deleteRepas($id,$repas_id){
		DB::table("repas_profil")->where(['id_profil' => $id, 'id_repas' => $repas_id])->delete();
	}

	public static function presenceCafet($id,$presence){
		DB::table('repas_profil')->where('id',$id)->update(['absent' => $presence]);
	}

	public static function getTAP($id){
		return DB::table("tap")->join('tap_profil', 'tap.id', '=', 'tap_profil.id_tap')->where('tap_profil.id_profil', $id)->get();
	}

	public static function addTAP($id,$tap_id,$prix){
		$count = DB::table('tap_profil')->where(['id_profil' => $id, 'id_tap' => $tap_id])->count();
		if($count == 0){
			DB::table("tap_profil")->insert(['id_profil' => $id, 'id_tap' => $tap_id, 'absent' => -1, 'prix' => $prix]);
		}
	}

	public static function deleteTAP($id,$tap_id){
		DB::table("tap_profil")->where(['id_profil' => $id, 'id_tap' => $tap_id])->delete();
	}

	public static function presenceTap($id,$prix){
		if($prix == null){
			DB::table('tap_profil')->where('id',$id)->update(['absent' => 0]);
		}else{
			DB::table('tap_profil')->where('id',$id)->update(['absent' => 1, 'prix' => $prix]);
		}
	}

	public static function getAdresseFromTapProfilTable($tap_profil_id){
		$profil = DB::table("tap_profil")->join('profil','tap_profil.id_profil','=','profil.id')->where('tap_profil.id',$tap_profil_id)->get();
		return DB::table("adresse")->where('id',$profil[0]->adresse_id)->get();
	}

	public static function getCountCafetForDate($d){
		$count = DB::table("repas_profil")->join('repas','repas_profil.id_repas','=','repas.id')->where('repas.date',$d)->count();
		$objectToReturn = ['date' => $d , 'count' => $count];
		return $objectToReturn;
	}
}
