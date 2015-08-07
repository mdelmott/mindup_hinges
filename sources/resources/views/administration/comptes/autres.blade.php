@extends('administration.comptes.template')

@section('content2')
    <div class="row margin-top-50">

        <div class="col-md-8 col-sm-10 col-md-offset-2 col-sm-offset-1 margin-top-10">
            {!! Form::open(['url' => 'Comptes/Autres']) !!}

                {!! Form::label('', $msg, ['style' => 'color:darkred']) !!}
                <div class="clearfix"></div></br>
                <table class="table table-striped margin-top-15">
                    <thead>
                    <tr>
                        <th>Espace</th><th>Mot de passe </th>
                    </tr>
                    </thead>
                    {!! HTML::showComptesTable($comptes) !!}
                </table>

            <div class="col-md-6 col-sm-6 col-xs-8 col-md-offset-3 col-sm-offset-3 col-xs-offset-2">
                {!! Form::select('espace',$espaces, null, ['class' => 'form-control']) !!}
            </div>
            <div class="clearfix"></div>

            {!! Form::label('nouveaumdp', 'Entrer le nouveau mot de passe : ', ['class' => 'col-md-6 col-sm-6 col-xs-9 margin-top-10']) !!}
            <div class="col-md-6 col-sm-6">
                {!! Form::password('nouveaumdp', ['class' => "form-control margin-top-10"]) !!}
            </div>
            <div class="clearfix"></div>
            {!! Form::label('confnouveaumdp', 'Confirmer le nouveau mot de passe :', ['class' => 'col-md-6 col-sm-6 col-xs-11 margin-top-10']) !!}
            <div class="col-md-6 col-sm-6">
                {!! Form::password('confnouveaumdp', ['class' => "form-control margin-top-10"]) !!}
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
