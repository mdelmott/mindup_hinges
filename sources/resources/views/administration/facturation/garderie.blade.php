@extends('administration.facturation.template')

@section('content2')


    <div class="row margin-top-20">
        <div class="col-md-4 col-md-offset-1">
            <div class="span5 col-md-5 col-md-offset-4" id="sandbox-container"><div></div></div>

            <script>
                $('#sandbox-container div').datepicker({language:"fr"});
            </script>
        </div>

        <div class="col-md-10  col-md-offset-1 margin-top-10">
            {!! Form::model(['class' => 'form-inline', 'url' => 'foo/bar']) !!}

            <div class="col-md-7 col-xs-6 col-md-offset-3 margin-top-10">
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

            <div class="col-md-7 col-xs-6 col-md-offset-3 margin-top-10">
                {!! Form::select('eleve',
                [
                "Mars 2015" => 'Mars 2015',
                'Avril 2015' => 'Avril 2015',
                'Mai 2015' => 'Mai 2015',
                'Juin 2015' => 'Juin 2015',
                'Juillet 2015' => 'Juillet 2015'
                ],
                null, ['class' => 'form-control']) !!}
            </div>



            <table class="table table-striped margin-top-20">
                <thead>
                <tr><th>Nom</th><th>Prenom</th><th>L1</th><th>Ma2</th><th>Me3</th><th>J4</th><th>V5</th><th>Total</th></tr>
                </thead>
                <tr>
                    <td>Jean</td><td>Paul</td><td>1.80€</td><td></td><td></td><td>1.80€</td><td></td><td>3.6€</td>
                </tr>
                <tr>
                    <td>Jean</td><td>Jacques</td><td></td><td>1.80€</td><td></td><td>1.80€</td><td>1.80€</td><td>3.6€</td>
                </tr>
            </table>


            {!! Form::close() !!}

            <div class="clearfix"></div>
        </div>
@endsection
