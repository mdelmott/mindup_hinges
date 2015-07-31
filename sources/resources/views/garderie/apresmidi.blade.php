@extends('garderie.template')

@section('head')
    <script src="{{ asset('/js/bower_components/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('/js/bower_components/bootstrap/js/tooltip.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
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

                    console.log(data.length);
                    if(data.length > 0){
                        for(i=0; i<data.length;i++){
                            html += "<tr>";
                            html += "<td><span class=\"glyphicon glyphicon-question-sign remarque\" role=\"button\" tabindex=\"0\" data-trigger=\"focus\"  data-toggle=\"popover\" title='Remarques : " + data[i].nom + " " + data[i].prenom + " ' data-content=\""+ data[i].remarques +" \" aria-hidden=\"true\"></span> </td><td>" + data[i].nom +"</td><td>"+data[i].prenom + "</td>";
                            html += "<td>";
                            html += "<div class=\"col-md-4 col-sm-4\">";
                            html += '<button type="button" class="button form-control btn-xs " nom="'+data[i].nom+'"  ville="'+data[i].ville+'"  prenom="'+data[i].prenom+'">1h</button>';
                            html += "</div>";
                            html += "<div class=\"col-md-4 col-sm-4\">";
                            html += '<button type="button" class="button form-control btn-xs " nom="'+data[i].nom+'"  ville="'+data[i].ville+'"  prenom="'+data[i].prenom+'">2h</button>';
                            html += "</div>";
                            html += "<div class=\"col-md-4 col-sm-4\">";
                            html += '<button type="button" class="button form-control btn-xs " nom="'+data[i].nom+'"  ville="'+data[i].ville+'"  prenom="'+data[i].prenom+'">3h</button>';
                            html += "</div>";
                            html += "</td>";
                            html += "</tr>";
                        }
                    }
                    else{
                        html = "<td colspan=4><h3 class='text-center'>Aucun élève à pointer</h3></td>"
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
                            switch ($(this).text()) {
                                case "1h":
                                    $(this).val('1');
                                    break;
                                case "2h":
                                    $(this).val('2');
                                    break;
                                case "3h":
                                    $(this).val('3');
                                    break;
                            }
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

                    $('.remarque').popover();
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
        {!! Form::close() !!}
    </div>
    <div class="clearfix"></div>



@endsection

