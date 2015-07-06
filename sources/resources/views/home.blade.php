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
				<div class="btn-group-md" role="group" aria-label="BoutonAccueil">
					<a href="{{ route("Scolarite") }}" class="btn btn-default col-md-4">Scolarité</a>
					<a href="#" class="btn btn-default col-md-4">Inscription</a>
					<a href="#" class="btn btn-default col-md-4">Prévision</a>
				</div>
				<hr>
				<div class="btn-group-md" role="group" aria-label="BoutonAccueil">
					<a href="#" class="btn btn-default col-md-4">Facturation</a>
					<a href="#" class="btn btn-default col-md-4">Tarifs</a>
					<a href="#" class="btn btn-default col-md-4">Comptes</a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

</div>
@endsection
