@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="jumbotron">
			<h1>Bienvenue ! </h1>
			<p>
				Choisissez le secteur que vous souhaitez administrer !
			</p>

			<div class="col-md-10 col-md-offset-1">
				<div class="btn-group btn-group-justified" role="group" aria-label="BoutonAccueil">
					<a href="{{ route("Scolarite") }}" class="btn btn-default" role="button">Scolarité</a>
					<a href="{{ route("Inscription") }}" class="btn btn-default" role="button">Inscription</a>
					<a href="#" class="btn btn-default" role="button">Prévision</a>
				</div>
				<hr>
				<div class="btn-group btn-group-justified" role="group" aria-label="BoutonAccueil">
					<a href="#" class="btn btn-default" role="button">Facturation</a>
					<a href="#" class="btn btn-default" role="button">Tarifs</a>
					<a href="#" class="btn btn-default" role="button">Comptes</a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
@endsection
