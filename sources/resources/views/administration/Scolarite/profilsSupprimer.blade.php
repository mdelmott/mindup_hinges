@extends('administration.scolarite.template')

@section('content2')

    <div class="row margin-top-50">
        <div class="col-md-4 col-sm-5 col-md-offset-1 margin-top-50">
            <div class="btn-group btn-group-justified margin-top-20" role="group" aria-label="Creer un profil">
                <a href="{{ route("Scolarite.Profils") }}" class="btn btn-default" role="button">Creer un nouveau profil</a>
            </div>

            <div class="btn-group btn-group-justified margin-top-10" role="group" aria-label="modifer / Supprimer un profil">
                <a href="{{ route("Scolarite.Profils.ModifierOuSupprimer") }}" class="btn btn-default btn-primary" role="button">Modifier/Supprimer un profil</a>
            </div>
        </div>

        <div class="col-md-6 col-sm-7 col-md-offset-1 margin-top-10">
            {!! Form::open(['url' => '/Scolarite/Profils/UpdateOrDelete', 'name' => 'form1']) !!}
            {!! Form::select('eleve', $eleves, $oldeleve, ['class' => 'form-control input-select center-block margin-bottom-15', 'onChange' => 'document.form1.submit()' ]) !!}
            {!! Form::label('nom', 'Nom', ['class' => 'col-md-3 col-sm-3 col-xs-3']) !!}{!! Form::text('nom', $nom, ['class' => "form-control input-text"]) !!}
            <div class="clearfix"></div>
            {!! Form::label('prenom', 'Prénom', ['class' => 'col-md-3 col-sm-3 col-xs-3']) !!}{!! Form::text('prenom', $prenom, ['class' => "form-control input-text"]) !!}
            <div class="clearfix"></div>
            {!! Form::label('tel', 'Numéro de telephone', ['class' => 'col-md-3 col-sm-3 col-xs-3']) !!} {!! Form::text('tel', $tel, ['class' => "form-control input-text "]) !!}
            <div class="clearfix"></div>
            {!! Form::label('adresse', 'Adresse', ['class' => 'col-md-3 col-sm-3 col-xs-3']) !!} {!! Form::text('adresse', $rue, ['class' => "form-control input-text"]) !!}
            <div class="clearfix"></div>
            {!! Form::label('cp', 'CP', ['class' => 'col-md-3 col-sm-3 col-xs-3 ']) !!} {!! Form::text('cp', $cp, ['class' => "form-control input-text"]) !!}
            {!! Form::label('ville', 'Ville', ['class' => 'col-md-3 col-sm-3 col-xs-3']) !!} {!! Form::text('ville', $ville, ['class' => "form-control input-text"]) !!}
            <div class="clearfix"></div>
            {!! Form::label('remarques', 'Remarques', ['class' => 'col-md-3 col-sm-3 col-xs-3']) !!} {!! Form::text('remarques', $remarques, ['class' => "form-control input-text"]) !!}
            <div class="clearfix"></div>
            </br>
            {!! Form::submit('Supprimer ce profil', ['name' => 'action','class' => 'btn btn-primary col-md-5 col-sm-5 col-xs-5 col-md-offset-1 col-sm-offset-1 col-xs-offset-1'])!!}
            {!! Form::submit('Enregistrer les modifications', ['name' => 'action','class' => 'btn btn-primary col-md-5 col-sm-5 col-xs-5 col-md-offset-1 col-sm-offset-1 col-xs-offset-1'])!!}
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
