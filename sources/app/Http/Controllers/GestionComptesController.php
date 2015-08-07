<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use PDO;

class GestionComptesController extends Controller {


	public function changeAdminDatas(){
		$ancienmdp = Input::get('ancienmdp');
		$nouveaumdp = Input::get('nouveaumdp');
		$confirmmdp = Input::get('confirmmdp');

		if($ancienmdp == null && $nouveaumdp == null && $confirmmdp == null){
			return View::make('administration.comptes.administration',['msg'=>'']);
		}else{
			if($nouveaumdp == $confirmmdp){
				if(Auth::attempt(['login' => 'admin', 'password'=>$ancienmdp])){
					User::updateUser('admin', $nouveaumdp);
					return View::make('administration.comptes.administration',['msg'=>'']);
				}else{
					return View::make('administration.comptes.administration',['msg'=>'Error : Le mot de passe ne correspont pas à celui du compte admin']);
				}
			}else{
				return View::make('administration.comptes.administration',['msg'=>'Error : Le mot de passe de confirmation ne correspont pas au nouveau mot de passe']);
			}
		}
	}

	public function changeOtherDatas(){
		
		$espaces = ['Cantine', 'TAP', 'Garderie', 'Enseignant'];
		$espace_id = Input::get('espace');
		$nouveaumdp = Input::get('nouveaumdp');
		$confirmmdp = Input::get('confnouveaumdp');

		if($espace_id != null){
			$espace = $espaces[$espace_id];
			if($nouveaumdp == $confirmmdp){
				User::updateUser($espace,$nouveaumdp);
			}else{
				$comptes = User::getUsers();
				return View::make('administration.comptes.autres', ['comptes' => $comptes, 'espaces' => $espaces, 'msg' => 'Error : Le mot de passe de confirmation ne correspont pas au nouveau mot de passe']);
			}
		}

		$comptes = User::getUsers();
		return View::make('administration.comptes.autres', ['comptes' => $comptes, 'espaces' => $espaces, 'msg' => '']);
	}

}
