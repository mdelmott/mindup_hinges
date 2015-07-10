@extends('administration.scolarite.template')

@section('content2')


    <div class="row margin-top-50">
        <div class="col-md-4 col-sm-5 col-md-offset-1 margin-top-50">
            <div class="btn-group btn-group-justified margin-top-20" role="group" aria-label="Creer une classe">
                <a href="{{ route("Scolarite.Classes") }}" class="btn btn-default btn-primary" role="button">Creer une nouvelle classe</a>
            </div>

            <div class="btn-group btn-group-justified margin-top-10" role="group" aria-label="modifer / Supprimer une classe">
                <a href="{{ route("Scolarite.Classes.Supprimer") }}" class="btn btn-default" role="button">Modifier/Supprimer une classe</a>
            </div>
        </div>

        <div class="col-md-6 col-sm-7 col-md-offset-1">


            {!! Form::model(['class' => 'form-inline', 'url' => 'foo/bar']) !!}
                    <div class="col-md-8 col-md-offset-2 margin-top-10">{!! Form::text('nom', null, ['class' => "form-control", 'placeholder' => "Nom de la classe", "style" => "text-align:center"]) !!}</div>

                    <table class="table table-striped margin-top-15">
                        <thead>
                        <tr><th>Nom</th><th>Prenom</th></tr>
                        </thead>
                        <tr><td>Jean</td><td>Paul</td></tr>
                        <tr><td>Jean</td><td>Jacques</td></tr>
                    </table>

                    <div class="col-md-7 col-sm-5 col-xs-6 col-md-offset-1">
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

                    <div class="col-md-3 col-sm-5 col-xs-5 col-md-offset-1">
                        {!! Form::submit('Ajouter', ['action'=>'ajouter', 'class' => 'btn btn-primary form-control'])!!}
                    </div>

                    {!! Form::submit('Enregistrer', ['action'=>'enregistrerClasse', 'class' => 'btn btn-primary form-control margin-top-20'])!!}

            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
