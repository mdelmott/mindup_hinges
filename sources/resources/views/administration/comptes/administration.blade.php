@extends('administration.comptes.template')

@section('content2')
    <div class="row margin-top-50">

        <div class="col-md-8 col-sm-10 col-md-offset-2 col-sm-offset-1 margin-top-10">
            {!! Form::open(['url' => 'Comptes/Administration']) !!}

                {!! Form::label('', $msg, ['style' => 'color:darkred']) !!}
                <div class="clearfix"></div></br>
                {!! Form::label('ancienmdp', 'Ancien mot de passe : ', ['class' => 'col-md-3 col-sm-4 col-xs-8']) !!}
                <div class="col-md-9 col-sm-8">
                    {!! Form::text('ancienmdp', null, ['class' => "form-control"]) !!}
                </div>
                <div class="clearfix"></div>
                {!! Form::label('nouveaumdp', 'Entrer le nouveau mot de passe :', ['class' => 'col-md-4 col-sm-6 col-xs-9 margin-top-10']) !!}
                <div class="col-md-8 col-sm-6">
                    {!! Form::password('nouveaumdp', ['class' => "form-control margin-top-10"]) !!}
                </div>
                <div class="clearfix"></div>
                {!! Form::label('confirmmdp', 'Comfirmer le nouveau mot de passe :', ['class' => 'col-md-5 col-sm-6 col-xs-10 margin-top-10']) !!}
                <div class="col-md-7 col-sm-6">
                    {!! Form::password('confirmmdp', ['class' => "form-control margin-top-10"]) !!}
                </div>
                <div class="clearfix"></div>

                <div class="col-md-6 col-md-offset-3">
                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary form-control margin-top-10'])!!}
                </div>
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
