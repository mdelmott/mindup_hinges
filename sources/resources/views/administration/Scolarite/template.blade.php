@extends('app')

@section('content')
    <?php
    $profils = Route::currentRouteName() == "Scolarite" || Route::currentRouteName() == "Scolarite.Profils" || Route::currentRouteName() == "Scolarite.Profils.ModifierOuSupprimer" || Route::currentRouteName() == "Scolarite.Profils.Create" || Route::currentRouteName() == "Scolarite.Profils.UpdateOrDelete" ? "btn-primary" : "";
    $classes = Route::currentRouteName() == "Scolarite.Classes" || Route::currentRouteName() == "Scolarite.Classes.ModifierOuSupprimer" || Route::currentRouteName() == "Scolarite.Classes.Create" || Route::currentRouteName() == "Scolarite.Classes.DeleteProfil" || Route::currentRouteName() == "Scolarite.Classes.UpdateOrDelete" ? "btn-primary" : "";
    $groupes = Route::currentRouteName() == "Scolarite.Groupes" || Route::currentRouteName() == "Scolarite.Groupes.ModifierOuSupprimer" || Route::currentRouteName() == "Scolarite.Groupes.Create" || Route::currentRouteName() == "Scolarite.Groupes.DeleteProfil" || Route::currentRouteName() == "Scolarite.Groupes.UpdateOrDelete" ? "btn-primary" : "";
    ?>
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-4 col-sm-7 col-xs-8 col-md-offset-1 ">
                        <div class="btn-group btn-group-justified" role="group" aria-label="Buttonbar">
                            <a href="{{ route("Scolarite.Profils") }}" class="btn btn-default {{ $profils }}" role="button">Profils</a>
                            <a href="{{ route("Scolarite.Classes") }}" class="btn btn-default {{ $classes }}" role="button">Classes</a>
                            <a href="{{ route("Scolarite.Groupes") }}" class="btn btn-default {{ $groupes }}" role="button">Groupes</a>
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
