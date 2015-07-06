@extends('administration.Scolarite.template')

@section('content2')


    <div class="row margin-top-50">
        <div class="col-md-3 col-md-offset-1">
            <div class="btn-group btn-group-justified margin-top-20" role="group" aria-label="Creer un profil">
                <a href="#" class="btn btn-default" role="button">Creer un nouvelle classe</a>
            </div>

            <div class="btn-group btn-group-justified margin-top-10" role="group" aria-label="modifer / Supprimer un profil">
                <a href="#" class="btn btn-default" role="button">Modifier/Supprimer une classe</a>
            </div>
        </div>

        <div class="col-md-7 col-md-offset-1">
            {!! Form::model(['url' => 'foo/bar']) !!}

            {!! Form::label('nom', 'Nom de la classe', ['class' => 'col-md-3 margin-bottom-30']) !!}{!! Form::text('nom', null, ['class' => "form-control", "id" => "input-nom-classe"]) !!}
            <div class="clearfix"></div>
            {!! Form::label('prenom', 'Prénom', ['class' => 'col-md-3']) !!}{!! Form::text('nom', null, ['class' => "form-control input-text"]) !!}
            <div class="clearfix"></div>
            {!! Form::label('tel', 'Numéro de telephone', ['class' => 'col-md-3']) !!} {!! Form::text('nom', null, ['class' => "form-control input-text "]) !!}
            <div class="clearfix"></div>
            {!! Form::label('adresse', 'Adresse', ['class' => 'col-md-3']) !!} {!! Form::text('nom', null, ['class' => "form-control input-text"]) !!}
            <div class="clearfix"></div>
            {!! Form::label('ville', 'Ville', ['class' => 'col-md-3']) !!} {!! Form::text('nom', null, ['class' => "form-control input-text"]) !!}
            <div class="clearfix"></div>
            {!! Form::label('remarques', 'Remarques', ['class' => 'col-md-3']) !!} {!! Form::text('nom', null, ['class' => "form-control input-text"]) !!}
            <div class="clearfix"></div>
            {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary form-control'])!!}
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
