<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tap extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tap';

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
	public static function createTAP($date){
		$tap = DB::table("tap")->where(['date'=>$date])->get();
		if(count($tap)>0){
			return $tap[0]->id;
		}else{
			return DB::table("tap")->insertGetId(['date'=>$date]);
		}
	}

	public static function getTAPId($date){
		$tap = DB::table("tap")->where(['date'=>$date])->get();
		if(count($tap)>0){
			return $tap[0]->id;
		}else{
			return null;
		}
	}
}
