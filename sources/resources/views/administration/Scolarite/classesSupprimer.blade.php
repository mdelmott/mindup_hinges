@extends('administration.scolarite.template')

@section('content2')


    <div class="row margin-top-50">
        <div class="col-md-4 col-sm-5 col-md-offset-1 margin-top-50">
            <div class="btn-group btn-group-justified margin-top-20" role="group" aria-label="Creer une classe">
                <a href="{{ route("Scolarite.Classes") }}" class="btn btn-default" role="button">Creer une nouvelle classe</a>
            </div>

            <div class="btn-group btn-group-justified margin-top-10" role="group" aria-label="modifer / Supprimer une classe">
                <a href="{{ route("Scolarite.Classes.ModifierOuSupprimer") }}" class="btn btn-default btn-primary" role="button">Modifier/Supprimer une classe</a>
            </div>
        </div>

        <div class="col-md-6 col-sm-7 col-md-offset-1">
            {!! Form::open(['url' => '/Scolarite/Classes/UpdateOrDelete', 'name' => 'form1']) !!}
                <div class="col-md-5 col-sm-5 col-xs-6 ">{!! Form::label('nom', 'Nouveau nom :', ['style' => 'font-size:18px']) !!}{!! Form::text('nom', $nom, ['class' => "form-control", 'placeholder' => "Nom de la classe", "style" => "text-align:center"]) !!}</div>
                <div class="col-md-5 col-sm-5 col-xs-6 col-md-offset-1">
                    {!! Form::label('classes', 'Liste des classes :', ['style' => 'font-size:18px']) !!}{!! Form::select('classe',$classes, $oldclasse, ['onChange' => 'document.form1.submit()','class' => 'form-control']) !!}
                </div>
                <div class="clearfix"></div>
                <table class="table table-striped margin-top-15">
                    <thead>
                    <tr><th>Nom</th><th>Prenom</th></tr>
                    </thead>
                    {!! HTML::showTable($classe,'Classes') !!}
                </table>

                <?php if(count($eleves) > 0){ ?>
                    <div class="col-md-7 col-sm-5 col-xs-6 col-md-offset-1">
                        {!! Form::select('eleve',$eleves, null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="col-md-3 col-sm-5 col-xs-5 col-md-offset-1">
                        {!! Form::submit('Ajouter', ['name'=>'action', 'class' => 'btn btn-primary form-control'])!!}
                    </div>
                <?php } ?>
                <div class="clearfix"></div>
                </br>
                <div class="col-md-5 col-sm-6 col-xs-7 col-md-offset-1">{!! Form::submit('Supprimer cette classe', ['name' =>'action','class' => 'btn btn-primary form-control'])!!}</div>
                <div class="col-md-6 col-sm-5 col-xs-5 ">{!! Form::submit('Enregistrer les modifications', ['name' => 'action','class' => 'btn btn-primary form-control'])!!}</div>
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
