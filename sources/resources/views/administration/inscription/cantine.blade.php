@extends('administration.inscription.template')

@section('head')
    <script type="text/javascript" src="{{ asset("/js/bower_components/jquery/dist/jquery.js") }}"></script>
    <script type="text/javascript" src="{{ asset("/js/bower_components/moment/min/moment.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("/js/bower_components/bootstrap/dist/js/bootstrap.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("/js/bower_components/bootstrap/js/transition.js") }}"></script>
    <script type="text/javascript" src="{{ asset("/js/bower_components/bootstrap/js/collapse.js") }}"></script>
    <link rel="stylesheet" href="{{ asset("/js/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css") }}" />
    <link rel="stylesheet" href="{{ asset("/js/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker7.css") }}" />
    <script src="{{ asset("/js/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js") }}"></script>
    <script src="{{ asset("/js/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.fr.min.js") }}"></script>
    

@endsection


@section('content2')


    <div class="row margin-top-50">
        <div class="col-md-4 col-sm-4 col-xs-10 col-xs-offset-1 col-md-offset-1 margin-top-20">
            <div class="span5 col-md-5 col-md-offset-4" id="datepicker"></div>
            <script>
                $('#datepicker').datepicker({                
                    dateFormat: 'dd/mm/yy',
                    language: 'fr',
                    multidate: true,
                    multidateSeparator: ';',
                    daysOfWeekDisabled: [0,6],
                    beforeShowDay: function(date){
                        for(var i=0;i<Hinges.dates.length;i++){
                            var d = new Date(Hinges.dates[i]);
                            if(date.toDateString() === d.toDateString()){ 
                               return  {enabled: true,classes : "affected"}
                            }
                        }
                        for(var i=0;i<Hinges.dates_hd.length;i++){
                            var d = new Date(Hinges.dates_hd[i]);
                            if(date.toDateString() === d.toDateString()){ 
                               return  {enabled: true,classes : "horsDelai"}
                            }
                        }
                        return {enabled : true};
                    }
                });
                
                var datepicker = $('#datepicker');

                $("#datepicker").on("changeDate", function(event) {
                    var datesToReturn = datepicker.datepicker('getDates');
                    $("#datesToReturn").val(datesToReturn)
                });
            </script>
        </div>

        <div class="col-md-6 col-sm-8 col-xs-10 col-xs-offset-1 col-md-offset-1 margin-top-10">
            {!! Form::open(['url' => '/Inscription/Cantine/Create', 'name' => 'form1']) !!}
                {!! Form::hidden('datesToReturn',null,['id' => 'datesToReturn']) !!}
                <div class="col-md-8 col-sm-6 col-xs-11 col-md-offset-2 col-sm-offset-3">
                    {!! Form::select('eleve', $eleves, $oldeleve, ['onChange' => 'document.form1.submit()','class' => 'form-control']) !!}
                </div>
                <div class="clearfix"></div>

                <div class="col-md-10 col-sm-6 col-xs-10 col-xs-offset-1 col-md-offset-2 col-sm-offset-3 margin-top-15">
                    {!! Form::submit('Ajouter un repas', ['name'=>'action', 'class' => 'btn btn-primary col-md-5 col-xs-10 col-xs-offset-1'])!!}
                    <div class="col-md-7 col-sm-12 col-xs-10 col-xs-offset-1 margin-top-5 ">
                        {!! Form::checkbox("Horsdelai", null, null, ['class'=>"col-md-1"]) !!} {!! Form::label('Horsdelai', 'Hors delai') !!}
                    </div>
                    <div class="clearfix"></div>
                    {!! Form::submit('Supprimer un repas', ['name'=>'action', 'class' => 'btn btn-primary col-md-7 col-xs-10 col-xs-offset-1 margin-top-15'])!!}
                </div>
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
