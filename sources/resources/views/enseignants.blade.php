<?php
use Carbon\Carbon;
?>

@extends('app')

@section('head')
    <script src="{{ asset('/js/bower_components/jquery/dist/jquery.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            //Activation des boutons (deviennent bleu) et modification de la value (0 ou 1)
            $('.button').click(function(){
                test = $(this).attr('class').match(/btn-primary/g);


                if( test == null){
                    $(this).attr('class', $(this).attr('class') + " btn-primary" );
                    $(this).val('1');
                }else{
                    $(this).attr('class', $(this).attr('class').replace('btn-primary', ''));
                    $(this).val('0');
                }
            })
        });
    </script>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <div class="row">

                    <div class="col-md-3 col-sm-4 col-xs-4 col-md-offset-9 col-sm-offset-8">
                        <div class="btn-group btn-group-justified" role="group" aria-label="ButtonRetour">
                            <a href="{{ route("administration") }}" class="btn btn-default" role="button">Retour</a>
                        </div>

                        <div class="margin-top-15">
                            {{ date("d/m/Y", strtotime(str_replace("-","/",Carbon::now()))) }}
                        </div>
                    </div>


                    <div class="clearfix"></div>
                </div>

                <div class="col-md-8 col-md-offset-2 margin-top-50">
                    {!! Form::model(['class' => 'form-inline', 'url' => 'foo/bar']) !!}
                    <div class="col-md-6 col-sm-5 col-xs-7 col-xs-offset-3 col-md-offset-3">
                        {!! Form::select('eleve',
                        [
                        "M. Dupont" => "M. Dupont",
                        "Mme. Dupont" => "Mme. Dupont",
                        ],
                        null, ['class' => 'form-control']) !!}
                    </div>

                    <table class="table table-striped margin-top-15">
                        <thead>
                        <tr>
                            <th>Profils</th><th>Nom</th><th>Prenom</th>
                        </tr>
                        </thead>
                        <tr>
                            <td><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> </td><td>Jean</td><td>Paul</td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> </td><td>Jean</td><td>Jacques</td>
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
