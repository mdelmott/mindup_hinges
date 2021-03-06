@extends('app')

@section('content')
	<div class="container vertical-center">
		<div class="row">
			<div class="jumbotron">
				<h1 class="text-center">Connexion</h1>

				@if (count($errors) > 0)
					<div class="alert alert-danger">
						<p>Il y a eu un problème de connexion !</p>
						<p>Vérifier que les identifiants sont correctes !</p>
					</div>
				@endif

				<div class="col-md-10 col-md-offset-1">
					{!! Form::model([]) !!}
						{!! Form::text('login',"",['class'=>'form-control margin-top-15', 'placeholder'=>'Login']) !!}
						{!! Form::password('password',['class'=>'form-control margin-top-15', 'placeholder' => 'Mot de Passe']) !!}
						{!! Form::submit("Se Connecter",['class'=>'form-control btn-primary margin-top-15']) !!}
					{!! Form::close() !!}
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
@endsection
