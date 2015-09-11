@extends('app')

@section('content')
    <?php
    $cantine = Route::currentRouteName() == "Inscription" || Route::currentRouteName() == "Inscription.Cantine" || Route::currentRouteName() == "Inscription.Cantine.Create" ? "btn-primary" : "";
    $tap = Route::currentRouteName() == "Inscription.TAP" || Route::currentRouteName() == "Inscription.TAP.Create" ? "btn-primary" : "";
    ?>
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-4 col-sm-7 col-xs-8 col-md-offset-1 ">
                        <div class="btn-group btn-group-justified" role="group" aria-label="Buttonbar">
                            <a href="{{ route("Inscription.Cantine") }}" class="btn btn-default {{ $cantine }}" role="button">Cantine</a>
                            <a href="{{ route("Inscription.TAP") }}" class="btn btn-default {{ $tap }}" role="button">TAP</a>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-4 col-md-offset-4 col-sm-offset-1">
                        <div class="btn-group btn-group-justified" role="group" aria-label="ButtonRetour">
                            @if(Auth::user()->login == "admin")
                                <a href="{{ route("administration") }}" class="btn btn-default" role="button">Retour</a>
                            @endif
                            <a  href="{{ url('/auth/logout') }}" class="btn btn-default" role="button">Déconnexion</a>
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

