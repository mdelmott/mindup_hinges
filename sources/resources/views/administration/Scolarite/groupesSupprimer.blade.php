@extends('administration.scolarite.template')

@section('content2')


    <div class="row margin-top-50">
        <div class="col-md-4 col-sm-5 col-md-offset-1 margin-top-50">
            <div class="btn-group btn-group-justified margin-top-20" role="group" aria-label="Creer un groupe">
                <a href="{{ route("Scolarite.Groupes") }}" class="btn btn-default" role="button">Creer un nouveau groupe</a>
            </div>

            <div class="btn-group btn-group-justified margin-top-10" role="group" aria-label="modifer / Supprimer un groupe">
                <a href="{{ route("Scolarite.Groupes.ModifierOuSupprimer") }}" class="btn btn-default btn-primary" role="button">Modifier/Supprimer un groupe</a>
            </div>
        </div>

        <div class="col-md-6 col-sm-7 col-md-offset-1 margin-top-10">
            {!! Form::open(['url' => '/Scolarite/Groupes/UpdateOrDelete', 'name' => 'form1']) !!}
            <div class="col-md-6 col-sm-5 col-md-offset-3 col-sm-offset-3">
                {!! Form::select('groupe',$groupes, $oldgroupe, ['onChange' => 'document.form1.submit()','class' => 'form-control']) !!}
            </div>
            <table class="table table-striped margin-top-10">
                <thead>
                <tr><th>Nom</th><th>Prenom</th></tr>
                </thead>
                {!! HTML::showTable($groupe,'Groupes') !!}
            </table>

            <div class="col-md-7 col-sm-5 col-xs-6 col-md-offset-1">
                {!! Form::select('eleve', $eleves, null, ['class' => 'form-control']) !!}
            </div>

            <div class="col-md-3 col-sm-5 col-xs-5 col-md-offset-1">
                {!! Form::submit('Ajouter', ['name' => 'action', 'class' => 'btn btn-primary form-control'])!!}
            </div>

            </br></br>    
            <div class="col-md-5 col-sm-6 col-xs-7 col-md-offset-1">{!! Form::submit('Supprimer', ['name' =>'action','class' => 'btn btn-primary form-control'])!!}</div>
            <div class="col-md-5 col-sm-5 col-xs-5 col-md-offset-1">{!! Form::submit('Enregistrer', ['name' =>'action','class' => 'btn btn-primary form-control'])!!}</div>
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
