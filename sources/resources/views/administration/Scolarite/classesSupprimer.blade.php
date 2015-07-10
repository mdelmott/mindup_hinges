@extends('administration.scolarite.template')

@section('content2')


    <div class="row margin-top-50">
        <div class="col-md-4 col-sm-5 col-md-offset-1 margin-top-50">
            <div class="btn-group btn-group-justified margin-top-20" role="group" aria-label="Creer une classe">
                <a href="{{ route("Scolarite.Classes") }}" class="btn btn-default" role="button">Creer une nouvelle classe</a>
            </div>

            <div class="btn-group btn-group-justified margin-top-10" role="group" aria-label="modifer / Supprimer une classe">
                <a href="{{ route("Scolarite.Classes.Supprimer") }}" class="btn btn-default btn-primary" role="button">Modifier/Supprimer une classe</a>
            </div>
        </div>

        <div class="col-md-6 col-sm-7 col-md-offset-1">
            {!! Form::model(['class' => 'form-inline', 'url' => 'foo/bar']) !!}
                <div class="col-md-6 col-sm-5 col-md-offset-3 col-sm-offset-3 margin-top-15">
                    {!! Form::select('prof',
                    [
                    "Mme Dupont" => 'Mme Dupont',
                    'Mme Dupond' => 'Mme Dupond'
                    ],
                    null, ['class' => 'form-control']) !!}
                </div>
                <table class="table table-striped margin-top-10">
                    <thead>
                    <tr><th>Nom</th><th>Prenom</th></tr>
                    </thead>
                    <tr><td>Jean</td><td>Paul</td><td>{!! Form::button('Supprimer', ['class' => 'btn btn-primary form-control'])!!}</td></tr>
                    <tr><td>Jean</td><td>Jacques</td><td>{!! Form::button('Supprimer', ['class' => 'btn btn-primary form-control'])!!}</td></tr>
                </table>


                <div class="col-md-5 col-sm-6 col-xs-7 col-md-offset-1">{!! Form::submit('Supprimer la classe', ['action' =>'SupprimerClasse','class' => 'btn btn-primary form-control'])!!}</div>
                <div class="col-md-5 col-sm-5 col-xs-5 col-md-offset-1">{!! Form::submit('Enregistrer', ['action' =>'EnregistrerClasse','class' => 'btn btn-primary form-control'])!!}</div>
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
