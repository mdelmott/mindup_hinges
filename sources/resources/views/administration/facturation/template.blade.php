<?php
    use Carbon\Carbon;
?>
@extends('app')

@section('content')
    <?php
    $cantine = Route::currentRouteName() == "Facturation" || Route::currentRouteName() == "Facturation.Cantine" ? "btn-primary" : "";
    $tap = Route::currentRouteName() == "Facturation.TAP" ? "btn-primary" : "";
		$garderie = Route::currentRouteName() == "Facturation.Garderie" ? "btn-primary" : ""
    ?>
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-4 col-sm-7 col-xs-8 col-md-offset-1 ">
                        <div class="btn-group btn-group-justified" role="group" aria-label="Buttonbar">
                            <a href="{{ route("Facturation.Cantine") }}" class="btn btn-default {{ $cantine }}" role="button">Cantine</a>
                            <a href="{{ route("Facturation.Garderie") }}" class="btn btn-default {{ $garderie}}" role="button">Garderie</a>
                            <a href="{{ route("Facturation.TAP") }}" class="btn btn-default {{ $tap }}" role="button">TAP</a>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-4 col-md-offset-4 col-sm-offset-1">
                        <div class="btn-group btn-group-justified" role="group" aria-label="ButtonRetour">
                            <a href="{{ route("administration") }}" class="btn btn-default" role="button">Retour</a>
                            <a  href="{{ url('/auth/logout') }}" class="btn btn-default" role="button">Déconnexion</a>
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

