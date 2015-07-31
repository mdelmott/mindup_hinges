<?php
    use Carbon\Carbon;
?>

@extends('app')

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

                @yield('content2')

            </div>
        </div>
        <div class="clearfix"></div>
    </div>

@endsection
