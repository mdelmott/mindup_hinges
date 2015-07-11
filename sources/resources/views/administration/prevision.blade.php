@extends('app')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-4 col-sm-7 col-xs-8 col-md-offset-1 ">
                        <div class="btn-group btn-group-justified" role="group" aria-label="Buttonbar">
                            <a href="#" onclick="javacript:window.print()" class="btn btn-default" role="button">Imprimer</a>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-4 col-md-offset-4 col-sm-offset-1">
                        <div class="btn-group btn-group-justified" role="group" aria-label="ButtonRetour">
                            <a href="{{ route("administration") }}" class="btn btn-default" role="button">Retour</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="col-md-10 col-sm-7  col-md-offset-1 margin-top-50">
                    {!! Form::model(['class' => 'form-inline', 'url' => 'foo/bar']) !!}
                         <div class="col-md-6 col-sm-5 col-xs-7 col-xs-offset-3 col-md-offset-3">
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

                        <table class="table table-striped margin-top-15">
                            <thead>
                                <tr>
                                    <th>Nom</th><th>Prenom</th><th>J12</th><th>V13</th><th>L16</th><th>Ma17</th><th>J19</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>Jean</td><td>Paul</td><td>X</td><td></td><td>X</td><td></td><td>X</td>
                            </tr>
                            <tr>
                                <td>Jean</td><td>Jacques</td><td></td><td>X</td><td></td><td>X</td><td></td>
                            </tr>
                        </table>
                    {!! Form::close() !!}
                </div>
        <div class="clearfix"></div>
    

            </div>
        </div>
        <div class="clearfix"></div>
    </div>

@endsection

