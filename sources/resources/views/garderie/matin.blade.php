@extends('garderie.template')

@section('head')
    <script src="{{ asset('/js/bower_components/jquery/dist/jquery.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            //Activation des boutons (deviennent bleu) et modification de la value (0 ou 1)


            ChargementEleve();

            $('select[name="gar_group"]').change(function(){
                ChargementEleve();
            });
        });

        function ChargementEleve(){
            $.ajax({
                type:"get",
                data: { groupe: $('select[name="gar_group"]').val() },
                url: '{{ route("AjaxChargementProfil") }}',
                success: function(data){

                    html = "";
                    for(i=0; i<data.length;i++){

                        EtatAv8 = data[i].matin1 ? "btn-primary" : "";
                        valeurAv8 = data[i].matin1 ? 1 : 0;

                        EtatAp8 = data[i].matin2 ? "btn-primary" : "";
                        valeurAp8 = data[i].matin2 ? 1 : 0;

                        html += "<tr>";
                        html += "<td><span class=\"glyphicon glyphicon-question-sign\" aria-hidden=\"true\"></span> </td><td>" + data[i].nom +"</td><td>"+data[i].prenom + "</td>";
                        html += "<td>";
                        html += "<div class=\"col-md-5 col-sm-5\">";
                        html += '<button type="button" class="button form-control btn-xs '+ EtatAv8 +'" value="'+ valeurAv8 +'" nom="'+data[i].nom+'" prenom="'+data[i].prenom+'">Avant 8h15</button>';
                        html += "</div>";
                        html += "<div class=\"col-md-5 col-sm-5\">";
                        html += '<button type="button" class="button form-control btn-xs '+ EtatAp8 +'" value="'+ valeurAp8 +'" nom="'+data[i].nom+'" prenom="'+data[i].prenom+'">Après 8h15</button>';
                        html += "</div>";
                        html += "</td>";
                        html += "</tr>";
                    }

                    html = " <thead>"+
                    "<tr>"+
                    "<th>Profils</th><th>Nom</th><th>Prenom</th><th>Pointage</th>"+
                    "</tr>"+
                    "</thead>"+
                    html;

                    $("table.table").html(html);

                    $('.button').click(function(){
                        test = $(this).attr('class').match(/btn-primary/g);

                        if( test == null){
                            $(this).attr('class', $(this).attr('class') + " btn-primary" );
                            $(this).val('1');
                        }else{
                            $(this).attr('class', $(this).attr('class').replace('btn-primary', ''));
                            $(this).val('0');
                        }

                        $.ajax({
                            type:"get",
                            data: { valeur : $(this).val(), groupe: $('select[name="gar_group"]').val(), horaire: $(this).text(), nom: $(this).attr('nom'), prenom: $(this).attr('prenom') },
                            url: '{{ route("AjaxAjoutHoraire") }}',
                            success: function(data) {
                               alert('Enfant Pointé !');
                            }
                        });
                    });
                }
            });
        }
    </script>
@endsection

@section('content2')
                <div class="col-md-10 col-md-offset-1 margin-top-50">
                    {!! Form::model(['class' => 'form-inline', 'url' => 'foo/bar']) !!}
                    <div class="col-md-6 col-sm-5 col-xs-8 col-xs-offset-2 col-md-offset-3">

                        <?php
                            $garderies = array();

                            foreach($group_gar as $garderie){
                                $garderies[$garderie['nom']]=$garderie['nom'];
                            }
                        ?>
                        {!! Form::select('gar_group', $garderies, null, ['class' => 'form-control']) !!}
                    </div>


                    <table class="table table-striped margin-top-15"></table>

                    <div class="col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4">
                        {!! Form::submit('Enregistrer', ['class' => 'button form-control btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="clearfix"></div>



@endsection

