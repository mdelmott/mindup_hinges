<?php

namespace App\Providers;

use App\Http\Controllers\ClasseController;

use Illuminate\Support\ServiceProvider;
use Collective\Html\FormBuilder;
use Illuminate\Html\HtmlBuilder;

use Carbon\Carbon;


class HtmlMacrosServiceProvider extends ServiceProvider{

	public function register()
	{
		$this->showTable();
		$this->showEspacesTable();
		$this->showPrevisionTable();
		$this->showFacturationTable();
		$this->showComptesTable();
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

	private function showComptesTable()
	{
		HtmlBuilder::macro('showComptesTable', function($table)
		{
			$show = "";
			foreach ($table as $t) {
				$show = $show . '<tr><td>' . $t->login . '</td><td>' . $t->password . '</td></tr>';
			}
			return $show;
		});		
	}

	private function showPrevisionTable()
	{
		HtmlBuilder::macro('showPrevisionTable', function($table, $eleves)
		{
			if(count($eleves)>0){
				$show = '<thead><tr><th>Nom</th><th>Prenom</th>';
			}else{
				$show = '<thead><tr><th>Jour</th>';
			}
			foreach ($table as $t) {
				setlocale(LC_ALL,'French');
				$d = Carbon::createFromFormat('Y-m-d',$t['date'])->formatLocalized('%a %d');
				$show = $show . '<th>'. $d .'</th>';
			}
			$show = $show . '</tr></thead>';
			foreach ($eleves as $e) {
				$show = $show . '<tr><td>' . $e->nom . '</td><td>' . $e->prenom . '</td>';   
				foreach ($table as $t) {
					$flag = false;
					foreach ($t['profils'] as $p) {
						if($p->id_profil == $e->id){
							$flag = true;break;
						}
					}
					if($flag == true){
						$show = $show . '<td>X</td>';
					}else{
						$show = $show . '<td></td>';
					}
				}
				$show = $show . '</tr>';
			}
			$show =  $show . "<tr><td>Nombre d'élèves</td>";
			if(count($eleves)>0){
				$show = $show . '<td></td>';
			}
			foreach ($table as $t) {
				$show = $show . '<td>'. $t['count'] .'</td>';
			}
			$show = $show . "</tr>";
			return $show;
		});		
	}

	private function showFacturationTable()
	{
		HtmlBuilder::macro('showFacturationTable', function($table, $eleves, $type)
		{
			if($type == 'tap'){
				$show = '<thead><tr><th>Nom</th><th>Prenom</th><th>Hingeois</th>';
			}else{
				$show = '<thead><tr><th>Nom</th><th>Prenom</th>';
			}
			foreach ($table as $t) {
				setlocale(LC_ALL,'French');
				$d = Carbon::createFromFormat('Y-m-d',$t['date'])->formatLocalized('%d');
				$show = $show . '<th>'. $d .'</th>';
			}
			$show = $show . '<th>Total</th></tr></thead>';
			
			foreach ($eleves as $e) {
				$show = $show . '<tr><td style="font-weight:bold">' . $e->nom . '</td><td style="font-weight:bold">' . $e->prenom . '</td>';   
				if($type == 'tap'){
					if($e->ville == 'Hinges'){
						$show = $show . '<td>X</td>';
					}else{
						$show = $show . '<td></td>';
					}
				}
				$total = 0;
				foreach ($table as $t) {
					$flag = false;
					foreach ($t['profils'] as $p) {
						if($p->id_profil == $e->id){
							$flag = true;
							$show = $show . '<td style="color:darkred">' . number_format($p->prix,1) . '</td>';
							$total = $total + $p->prix; 
							break;
						}
					}
					if($flag == false){
						$show = $show . '<td>0.0</td>';
					}
				}
				$show = $show . '<td style="font-weight:bold">'. number_format($total,1) .' €</td></tr>';
			}
			return $show;
		});		
	}

}