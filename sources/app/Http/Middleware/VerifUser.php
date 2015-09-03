<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class VerifUser {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$routeName = Route::getCurrentRoute()->getName();

		switch(Auth::user()->login) {
			case 'Cantine':
				//dd($routeName != 'Cantine' && $routeName != 'Cantine.Check');
				if ($routeName != 'Cantine' && $routeName != 'Cantine.Check'){
					return redirect()->route("Cantine");
				}
				break;
			case 'TAP':
				if($routeName != 'TAP' && $routeName != 'TAP.Check')
					return redirect()->route("TAP");
				break;

			case 'Enseignants' :
				if($routeName != 'Enseignants' && $routeName != 'AjaxChargementProfilEnseignant')
					return redirect()->route("Enseignants");
				break;
		}

		return $next($request);
	}

}
