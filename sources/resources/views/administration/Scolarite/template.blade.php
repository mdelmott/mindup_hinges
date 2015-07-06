@extends('app')

@section('content')
    <?php
        $profils = Route::currentRouteName() == "Scolarite" || Route::currentRouteName() == "Scolarite.Profils" || Route::currentRouteName() == "Scolarite.Profils.Supprimer" ? "btn-primary" : "";
        $classes = Route::currentRouteName() == "Scolarite.Classes" ? "btn-primary" : "";
        $groupes = Route::currentRouteName() == "Scolarite.Groupes" ? "btn-primary" : "";
    ?>
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        <div class="btn-group btn-group-justified" role="group" aria-label="Buttonbar">
                            <a href="{{ route("Scolarite.Profils") }}" class="btn btn-default {{ $profils }}" role="button">Profils</a>
                            <a href="{{ route("Scolarite.Classes") }}" class="btn btn-default {{ $classes }}" role="button">Classes</a>
                            <a href="{{ route("Scolarite.Groupes") }}" class="btn btn-default {{ $groupes }}" role="button">Groupes</a>
                        </div>
                    </div>

                    <div class="col-md-3 col-md-offset-5">

                        <div class="btn-group btn-group-justified" role="group" aria-label="ButtonRetour">
                            <a href="#" class="btn btn-default" role="button">Retour</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                @yield('content2')

            </div>
        </div>

    </div>
@endsection
