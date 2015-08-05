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
		$this->showEspacesTable();
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

	private function showEspacesTable()
	{
		HtmlBuilder::macro('showEspacesTable', function($table, $type)
		{
			$show = "";
			foreach ($table as $t) {
				$show = $show . '<tr><td>
				<div class="col-md-3 col-sm-2">
					<span class="glyphicon glyphicon-question-sign remarque" role="button" tabindex="0" data-trigger="focus" data-toggle="popover" title="Remarques : '. $t['profil']->nom . ' ' . $t['profil']->prenom .'" data-content="'. $t['profil']->remarques .'" aria-hidden="true" onClick="popover();" data-original-title="Remarques : '. $t['profil']->nom . ' ' . $t['profil']->prenom .'"></span> 	
			    </div></td>
				<td>' . $t['profil']->nom . '</td><td>' . $t['profil']->prenom . '</td><td>
				<div class="col-md-5 col-sm-5">
					<a href ="/mindup_hinges/sources/public/'. $type .'/Check/'. $t['id'] .'/Present"><input type="button" value="Present"  class="btn btn-primary form-control"></a>
				</div>
				<div class="col-md-5 col-sm-5">
					<a href ="/mindup_hinges/sources/public/'. $type .'/Check/'. $t['id'] .'/Absent"><input type="button" value="Absent" class="btn btn-primary form-control"></a></td></tr>
				</div>';
			}
			return $show;
		});		
	}

}