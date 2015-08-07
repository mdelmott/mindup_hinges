@extends('administration.facturation.template')	

@section('content2')


    <div class="row margin-top-20">
        <div class="col-md-4 col-md-offset-1">
            <div class="span5 col-md-5 col-md-offset-4" id="sandbox-container"><div></div></div>

            <script>
                $('#sandbox-container div').datepicker({language:"fr"});
            </script>
        </div>

        <div class="col-md-10 col-md-offset-1 margin-top-10">
            {!! Form::open(['name' => 'form1', 'url' => 'Facturation/TAP']) !!}

            <div class="col-md-7 col-xs-6 col-md-offset-3 margin-top-10">
                {!! Form::select('groupe', $groupes, $oldGroupe, ['onChange' => 'document.form1.submit()','class' => 'form-control']) !!}
            </div>

            <div class="col-md-7 col-xs-6 col-md-offset-3 margin-top-10">
                {!! Form::select('mois', $mois, $oldMois, ['onChange' => 'document.form1.submit()' ,'class' => 'form-control']) !!}
            </div>

            <table class="table table-striped col-xs-12 margin-top-20" style="left:-125px">
                {!! HTML::showFacturationTable($facturation,$eleves,'tap') !!}
            </table>

            {!! Form::close() !!}
        
        <div class="clearfix"></div>
    </div>
@endsection
