@extends('app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-4 col-md-offset-8 col-sm-offset-8">
                        <div class="btn-group btn-group-justified" role="group" aria-label="ButtonRetour">
                            <a href="{{ route("administration") }}" class="btn btn-default" role="button">Retour</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="margin-top-50">
                    {!! Form::open(['url' => '/Tarifs/Update']) !!}
                        <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2">
                            <table class="table table-striped margin-top-15">
                                <thead>
                                    <tr>
                                        <th>Garderie</th><th>Période</th><th>Tarifs</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>Matin</td><td>Avant 8h15</td><td>{!! Form::text("Garderieav8h15", $Garderieav8h15 . ' €',["class"=>"form-control"]) !!}</td>
                                </tr>
                                <tr>
                                    <td></td><td>Après 8h15</td><td>{!! Form::text("Garderieap8h15", $Garderieap8h15 . ' €',["class"=>"form-control"]) !!}</td>
                                </tr>
                                <tr>
                                    <td>Après Midi</td><td>1 heure</td><td>{!! Form::text("Garderie1h", $Garderie1h . ' €',["class"=>"form-control"]) !!}</td>
                                </tr>
                                <tr>
                                    <td></td><td>2 heures</td><td>{!! Form::text("Garderie2h", $Garderie2h . ' €',["class"=>"form-control"]) !!}</td>
                                </tr>
                                <tr>
                                    <td></td><td>3 heures</td><td>{!! Form::text("Garderie3h", $Garderie3h . ' €',["class"=>"form-control"]) !!}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-4 col-sm-6 col-md-offset-1">
                            <table class="table table-striped margin-top-15">
                                <thead>
                                    <tr>
                                        <th>TAP</th><th>Présent</th><th>Absent</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>Hingeois</td>
                                    <td>{!! Form::text("TAPhingeoisPres", $TAPhingeoisPres . ' €',["class"=>"form-control"]) !!}</td>
                                    <td>{!! Form::text("TAPhingeoisAbs", $TAPhingeoisAbs . ' €',["class"=>"form-control"]) !!}</td>
                                </tr>
                                <tr>
                                    <td>Extérieur</td>
                                    <td>{!! Form::text("TAPextPres", $TAPextPres . ' €',["class"=>"form-control"]) !!}</td>
                                    <td>{!! Form::text("TAPextAbs", $TAPextAbs . ' €',["class"=>"form-control"]) !!}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-4 col-sm-6 col-md-offset-2">
                            <table class="table table-striped margin-top-15">
                                <thead>
                                    <tr>
                                        <th>Repas</th><th>Prix</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>Standard</td><td>{!! Form::text("RepasStd", $RepasStd . ' €',["class"=>"form-control"]) !!}</td>
                                </tr>
                                <tr>
                                    <td>Hors délai</td><td>{!! Form::text("RepasHD", $RepasHD . ' €',["class"=>"form-control"]) !!}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4 margin-top-10">
                            {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary form-control'])!!}
                        </div>
                    {!! Form::close() !!}
                </div>
        <div class="clearfix"></div>


            </div>
        </div>
        <div class="clearfix"></div>
    </div>

@endsection