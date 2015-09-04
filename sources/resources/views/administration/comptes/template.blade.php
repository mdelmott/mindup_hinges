@extends('app')

@section('content')
    <?php
    $administration = Route::currentRouteName() == "Comptes" || Route::currentRouteName() == "Comptes.Administration" ? "btn-primary" : "";
    $autres = Route::currentRouteName() == "Comptes.Autres" ? "btn-primary" : "";
    ?>
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-4 col-sm-7 col-xs-8 col-md-offset-1 ">
                        <div class="btn-group btn-group-justified" role="group" aria-label="Buttonbar">
                            <a href="{{ route("Comptes.Administration") }}" class="btn btn-default {{ $administration }}" role="button">Administration</a>
                        <a href="{{ route("Comptes.Autres") }}" class="btn btn-default {{ $autres }}" role="button">Autres</a>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-4 col-md-offset-4 col-sm-offset-1">
                        <div class="btn-group btn-group-justified" role="group" aria-label="ButtonRetour">
                            <a href="{{ route("administration") }}" class="btn btn-default" role="button">Retour</a>
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

