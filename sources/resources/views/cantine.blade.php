<?php
    use Carbon\Carbon;
?>

@extends('app')

@section('head')
        <script src="{{ asset('/js/bower_components/jquery/dist/jquery.js') }}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
        
        <script type="text/javascript">
            function popover(){
                 $('.remarque').popover();
            }
        </script>
    @endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-4 col-md-offset-9 col-sm-offset-9 col-xs-offset-8">
                        <div class="btn-group btn-group-justified" role="group" aria-label="ButtonRetour">
                            <a href="{{ route("administration") }}" class="btn btn-default" role="button">Retour</a>
                        </div>

                        <div class="margin-top-15">
                            {{ date("d/m/Y", strtotime(str_replace("-","/",Carbon::now()))) }}
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>

                <div class="col-md-10 col-md-offset-1 margin-top-50">
                    {!! Form::open(['name' => 'form1', 'url' => '/Cantine']) !!}
                        <div class="col-md-6 col-sm-6 col-xs-7 col-sm-offset-3 col-xs-offset-3 col-md-offset-3">
                            {!! Form::select('classe',$classes,$oldClasse, ['onChange' => 'document.form1.submit()', 'class' => 'form-control']) !!}
                        </div>

                        <table class="table table-striped margin-top-15">
                            <thead>
                            <tr>
                                <th>Profils</th><th>Nom</th><th>Prenom</th><th>Présent / Absent</th>
                            </tr>
                            </thead>
                            {!! HTML::showEspacesTable($classe,'Cantine') !!}
                        </table>


                    {!! Form::close() !!}
                </div>
                <div class="clearfix"></div>


            </div>
        </div>
        <div class="clearfix"></div>
    </div>

@endsection

