@extends('garderie.template')

@section('head')
    <script src="{{ asset('/js/bower_components/jquery/dist/jquery.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            //Activation des boutons (deviennent bleu) et modification de la value (0 ou 1)
            $('.button').click(function(){
                test = $(this).attr('class').match(/btn-primary/g);


                if( test == null){
                    $(this).attr('class', $(this).attr('class') + " btn-primary" );
                    $(this).val('1');
                }else{
                    $(this).attr('class', $(this).attr('class').replace('btn-primary', ''));
                    $(this).val('0');
                }
            })
        });
    </script>
@endsection

@section('content2')
                <div class="col-md-10 col-md-offset-1 margin-top-50">
                    {!! Form::model(['class' => 'form-inline', 'url' => 'foo/bar']) !!}
                    <div class="col-md-6 col-sm-5 col-xs-8 col-xs-offset-2 col-md-offset-3">
                        {!! Form::select('eleve',
                        [
                        "Groupe garderie 1" => "Groupe garderie 1",
                        "Groupe garderie 2" => "Groupe garderie 2"
                        ],
                        null, ['class' => 'form-control']) !!}
                    </div>

                    <table class="table table-striped margin-top-15">
                        <thead>
                        <tr>
                            <th>Profils</th><th>Nom</th><th>Prenom</th><th>Pointage</th>
                        </tr>
                        </thead>
                        <tr>
                            <td><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> </td><td>Jean</td><td>Paul</td>
                            <td>
                                <div class="col-md-5 col-sm-5">
                                    {!! Form::button('Avant 8h15', ['class' => 'button form-control btn-xs']) !!}
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    {!! Form::button('Après 8h15', ['class' => 'button form-control btn-xs']) !!}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> </td><td>Jean</td><td>Jacques</td>
                            <td>
                                <div class="col-md-5 col-sm-5">
                                    {!! Form::button('Avant 8h15', ['class' => 'button form-control btn-xs']) !!}
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    {!! Form::button('Après 8h15', ['class' => 'button form-control btn-xs']) !!}
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class="col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4">
                        {!! Form::submit('Enregistrer', ['class' => 'button form-control btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="clearfix"></div>



@endsection

