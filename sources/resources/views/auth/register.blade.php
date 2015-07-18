@extends('app')

@section('content')
	<div class="container vertical-center">
		<div class="row">
			<div class="jumbotron">
				<h1 class="text-center">Inscription</h1>
				<div class="col-md-10 col-md-offset-1">
					{!! Form::model(['method'=>'POST', 'controller'=>  'AuthController@postRegister' ]) !!}
						{!! Form::text('login',"",['class'=>'form-control margin-top-15', 'placeholder'=>'Login']) !!}
						{!! Form::text('mdp',"",['class'=>'form-control margin-top-15', 'placeholder' => 'Mot de Passe']) !!}
						{!! Form::submit("S'inscrire",['class'=>'form-control btn-primary margin-top-15']) !!}
					{!! Form::close() !!}
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
@endsection
