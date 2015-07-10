@extends('administration.scolarite.template')

@section('content2')


    <div class="row margin-top-50">
        <div class="col-md-4 col-sm-5 col-md-offset-1 margin-top-50">
            <div class="btn-group btn-group-justified margin-top-20" role="group" aria-label="Creer un groupe">
                <a href="{{ route("Scolarite.Groupes") }}" class="btn btn-default" role="button">Creer un nouveau groupe</a>
            </div>

            <div class="btn-group btn-group-justified margin-top-10" role="group" aria-label="modifer / Supprimer un groupe">
                <a href="{{ route("Scolarite.Groupes.Supprimer") }}" class="btn btn-default btn-primary" role="button">Modifier/Supprimer un groupe</a>
            </div>
        </div>

        <div class="col-md-6 col-sm-7 col-md-offset-1 margin-top-10">
            {!! Form::model(['class' => 'form-inline', 'url' => 'foo/bar']) !!}
            <div class="col-md-6 col-sm-5 col-md-offset-3 col-sm-offset-3">
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


            <div class="col-md-5 col-sm-6 col-xs-7 col-md-offset-1">{!! Form::submit('Supprimer le groupe', ['action' =>'SupprimerGroupe','class' => 'btn btn-primary form-control'])!!}</div>
            <div class="col-md-5 col-sm-5 col-xs-5 col-md-offset-1">{!! Form::submit('Enregistrer', ['action' =>'EnregistrerGroupe','class' => 'btn btn-primary form-control'])!!}</div>
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
