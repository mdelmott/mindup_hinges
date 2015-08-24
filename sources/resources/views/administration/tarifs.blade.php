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
                                    <td style="line-height:34px">Matin</td><td style="line-height:34px">Avant 8h15</td><td style="line-height:34px">{!! Form::text("Garderieav8h15", $Garderieav8h15, ['pattern' => '[0-9]+[.0-9]*', 'required' => true, "class"=>"form-control", "style" => "width:30%;display:inherit"]) !!} &nbsp €</td>
                                </tr>
                                <tr>
                                    <td></td><td style="line-height:34px">Après 8h15</td><td style="line-height:34px">{!! Form::text("Garderieap8h15", $Garderieap8h15,['pattern' => '[0-9]+[.0-9]*', 'required' => true, "class"=>"form-control", "style" => "width:30%;display:inherit"]) !!} &nbsp €</td>
                                </tr>
                                <tr>
                                    <td style="line-height:34px">Après Midi</td><td style="line-height:34px">1 heure</td><td style="line-height:34px">{!! Form::text("Garderie1h", $Garderie1h,['pattern' => '[0-9]+[.0-9]*', 'required' => true, "class"=>"form-control", "style" => "width:30%;display:inherit"]) !!} &nbsp €</td>
                                </tr>
                                <tr>
                                    <td></td><td style="line-height:34px">2 heures</td><td style="line-height:34px">{!! Form::text("Garderie2h", $Garderie2h,['pattern' => '[0-9]+[.0-9]*', 'required' => true, "class"=>"form-control", "style" => "width:30%;display:inherit"]) !!} &nbsp €</td>
                                </tr>
                                <tr>
                                    <td></td><td style="line-height:34px">3 heures</td><td style="line-height:34px">{!! Form::text("Garderie3h", $Garderie3h,['pattern' => '[0-9]+[.0-9]*', 'required' => true, "class"=>"form-control", "style" => "width:30%;display:inherit"]) !!} &nbsp €</td>
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
                                    <td style="line-height:34px">Hingeois</td>
                                    <td style="line-height:34px">{!! Form::text("TAPhingeoisPres", $TAPhingeoisPres,['pattern' => '[0-9]+[.0-9]*', 'required' => true, "class"=>"form-control", "style" => "width:60%;display:inherit"]) !!} &nbsp €</td>
                                    <td style="line-height:34px">{!! Form::text("TAPhingeoisAbs", $TAPhingeoisAbs,['pattern' => '[0-9]+[.0-9]*', 'required' => true, "class"=>"form-control", "style" => "width:60%;display:inherit"]) !!} &nbsp €</td>
                                </tr>
                                <tr>
                                    <td style="line-height:34px">Extérieur</td>
                                    <td style="line-height:34px">{!! Form::text("TAPextPres", $TAPextPres,['pattern' => '[0-9]+[.0-9]*', 'required' => true, "class"=>"form-control", "style" => "width:60%;display:inherit"]) !!} &nbsp €</td>
                                    <td style="line-height:34px">{!! Form::text("TAPextAbs", $TAPextAbs,['pattern' => '[0-9]+[.0-9]*', 'required' => true, "class"=>"form-control", "style" => "width:60%;display:inherit"]) !!} &nbsp €</td>
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
                                    <td style="line-height:34px">Standard</td><td style="line-height:34px">{!! Form::text("RepasStd", $RepasStd,['pattern' => '[0-9]+[.0-9]*', 'required' => true, "class"=>"form-control", "style" => "width:30%;display:inherit"]) !!} &nbsp €</td>
                                </tr>
                                <tr>
                                    <td style="line-height:34px">Hors délai</td><td style="line-height:34px">{!! Form::text("RepasHD", $RepasHD,['pattern' => '[0-9]+[.0-9]*', 'required' => true, "class"=>"form-control", "style" => "width:30%;display:inherit"]) !!} &nbsp €</td>
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