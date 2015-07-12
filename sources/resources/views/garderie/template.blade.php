<?php
    use Carbon\Carbon;
?>

@extends('app')

@section('content')
    <?php
        $matin = Route::currentRouteName() == "Garderie" || Route::currentRouteName() == "Garderie.Matin" ? "btn-primary" : "";
        $apresmidi = Route::currentRouteName() == "Garderie.ApresMidi" ? "btn-primary" : "";
    ?>
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-8 col-md-offset-1">
                        <div class="btn-group btn-group-justified" role="group" aria-label="ButtonRetour">
                            <a href="{{ route("Garderie.Matin") }}" class="btn btn-default {{ $matin }}" role="button">Matin</a>
                            <a href="{{ route("Garderie.ApresMidi") }}" class="btn btn-default {{ $apresmidi }}" role="button">Après-Midi</a>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-4 col-md-offset-5 col-sm-offset-4">
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
