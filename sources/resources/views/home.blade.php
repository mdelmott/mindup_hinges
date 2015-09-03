@extends('app')

@section('content')
<div class="container vertical-center">
	<div class="row">
		<div class="jumbotron">
			<h1>Bienvenue ! </h1>
			<p>
				Choisissez le secteur que vous souhaitez administrer !
			</p>

			<span style="text-align:right;"><a  href="{{ url('/auth/logout') }}">Déconnexion</a></span>

			<h2> Administation </h2>
			<div class="col-md-10 col-md-offset-1">
				<div class="btn-group btn-group-justified" role="group" aria-label="BoutonAccueil">
					<a href="{{ route("Scolarite") }}" class="btn btn-default" role="button">Scolarité</a>
					<a href="{{ route("Inscription") }}" class="btn btn-default" role="button">Inscription</a>
					<a href="{{ route("Prevision")}}" class="btn btn-default" role="button">Prévision</a>
				</div>
				<hr>
				<div class="btn-group btn-group-justified" role="group" aria-label="BoutonAccueil">
					<a href="{{ route("Facturation")}}" class="btn btn-default" role="button">Facturation</a>
					<a href="{{ route("Tarifs")}}" class="btn btn-default" role="button">Tarifs</a>
					<a href="{{ route("Comptes")}}" class="btn btn-default" role="button">Comptes</a>
				</div>
				<hr>
			</div>

			<h2> Différents Espaces </h2>
			<div class="col-md-10 col-md-offset-1">
				<div class="btn-group btn-group-justified" role="group" aria-label="BoutonAccueil">
					<a href="{{ route("Cantine") }}" class="btn btn-default" role="button">Cantine</a>
					<a href="{{ route("TAP") }}" class="btn btn-default" role="button">TAP</a>
					<a href="{{ route("Garderie")}}" class="btn btn-default" role="button">Garderie</a>
					<a href="{{ route("Enseignants")}}" class="btn btn-default" role="button">Enseignants</a>
				</div>

			</div>

			<div class="clearfix"></div>
		</div>
	</div>
</div>
@endsection
