<?php

namespace App\Providers;

use App\Http\Controllers\ClasseController;

use Illuminate\Support\ServiceProvider;
use Collective\Html\FormBuilder;
use Illuminate\Html\HtmlBuilder;

class HtmlMacrosServiceProvider extends ServiceProvider{

	public function register()
	{
		$this->showTable();
	}

	private function showTable()
	{
		HtmlBuilder::macro('showTable', function($table, $type)
		{
			$show = "";
			foreach ($table as $t) {
				$show = $show . '<tr><td>' . $t->nom . '</td><td>' . $t->prenom . '</td><td><a href ="/mindup_hinges/sources/public/Scolarite/'. $type .'/DeleteProfil/'. $t->id .'""><input type="button" value="Supprimer" class="btn btn-primary form-control"></a></td></tr>';
			}
			return $show;
		});		
	}

}