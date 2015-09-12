<?php
use Carbon\Carbon;
?>

@extends('app')

@section('head')
    <script src="{{ asset('/js/bower_components/jquery/dist/jquery.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            ChargementEleve();

            $('select[name="class_groupe"]').change(function(){
                ChargementEleve();
            });
        });

        function ChargementEleve(){
            $.ajax({
                type:"get",
                data: { classe: $('select[name="class_groupe"]').val() },
                url: '{{ route("AjaxChargementProfilEnseignant") }}',
                success: function(data){
                    html = "";
                    if(data.length > 0){
                        for(i=0; i<data.length;i++){
                            html += "<tr>";
                            html += "<td><span class=\"glyphicon glyphicon-question-sign remarque\" role=\"button\" tabindex=\"0\" data-trigger=\"focus\"  data-toggle=\"popover\" title='Remarques : ' data-content=\""+ data[i].remarques +" \" aria-hidden=\"true\"></span> </td><td>" + data[i].nom +"</td><td>"+data[i].prenom + "</td>";
                            html += "</tr>";
                        }
                    }
                    else{
                        html = "<td colspan=4><h3 class='text-center'>Aucun élève</h3></td>"
                    }

                    html = " <thead>"+
                    "<tr>"+
                    "<th>Profils</th><th>Nom</th><th>Prenom</th>"+
                    "</tr>"+
                    "</thead>"+
                    html;

                    $("table.table").html(html);

                    $('.remarque').popover();
                }
            });
        }
    </script>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <div class="row">

                    <div class="col-md-3 col-sm-4 col-xs-4 col-md-offset-9 col-sm-offset-8">
                        <div class="btn-group btn-group-justified" role="group" aria-label="ButtonRetour">
                            @if(Auth::user()->login == "admin")
                                <a href="{{ route("administration") }}" class="btn btn-default" role="button">Retour</a>
                            @endif
                            <a  href="{{ url('/auth/logout') }}" class="btn btn-default" role="button">Déconnexion</a>
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
                        <?php
                        $classes = array();

                        foreach($groupe_class as $classe){
                            $classes[$classe['id']] = $classe['nom'];
                        }
                        ?>
                        {!! Form::select('class_groupe', $classes, null, ['class' => 'form-control']) !!}

                    </div>

                    <table class="table table-striped margin-top-15"></table>
                    {!! Form::close() !!}
                </div>
                <div class="clearfix"></div>


            </div>
        </div>
        <div class="clearfix"></div>
    </div>

@endsection

