@extends('administration.Scolarite.template')

@section('content2')


    <div class="row margin-top-50">
        <div class="col-md-4 col-sm-5 col-md-offset-1 margin-top-50">
            <div class="btn-group btn-group-justified margin-top-20" role="group" aria-label="Creer un groupe">
                <a href="{{ route("Scolarite.Groupes") }}" class="btn btn-default btn-primary" role="button">Creer un nouveau groupe</a>
            </div>

            <div class="btn-group btn-group-justified margin-top-10" role="group" aria-label="modifer / Supprimer un groupe">
                <a href="{{ route("Scolarite.Groupes.Supprimer") }}" class="btn btn-default" role="button">Modifier/Supprimer un groupe</a>
            </div>
        </div>

        <div class="col-md-6 col-sm-7 col-md-offset-1">


            {!! Form::model(['class' => 'form-inline', 'url' => 'foo/bar']) !!}
            <div class="col-md-8 col-md-offset-2">{!! Form::text('nom', null, ['class' => "form-control", 'placeholder' => "Nom du groupe", "style" => "text-align:center"]) !!}</div>

            <table class="table table-striped">
                <thead>
                <tr><th>Nom</th><th>Prenom</th></tr>
                </thead>
                <tr><td>Jean</td><td>Paul</td></tr>
                <tr><td>Jean</td><td>Jacques</td></tr>
            </table>

            <div class="col-md-7 col-sm-5 col-md-offset-1">
                {!! Form::select('eleve',
                [
                "Jean" => 'Jean',
                'Jean Pierre' => 'Jean Pierre',
                'Jean Jacques' => 'Jean Jacques',
                'Jean Paul' => 'Jean Paul',
                'Jean François' => 'Jean François'
                ],
                null, ['class' => 'form-control']) !!}
            </div>

            <div class="col-md-3 col-sm-5 col-md-offset-1">
                {!! Form::submit('Ajouter', ['class' => 'btn btn-primary form-control'])!!}
            </div>

            {!! Form::submit('Enregistrer', ['action'=>'enregistrerGroupe', 'class' => 'btn btn-primary form-control margin-top-20'])!!}

            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
