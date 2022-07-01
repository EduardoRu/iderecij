@extends('layouts.app')
@section('title', 'CIJ • Datos')
@section('content')
<div class="container-xl" id="todo">
    <div class="card">
        <div class="card-header" style="text-align: center">
            Alumno/Grupo que presenta mayor riesgo
        </div>
        <div class="card-body">
            <div class="row">
                <div style="text-align: center; padding-bottom:2%">
                    Presenta mayor riesgo en: 
                    <b><div id="mr"></div></b>
                </div>
                <div class="col-md-6">
                    <div id="columnchart_values"></div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="chart_div_PR"></div>
                        </div>
                        <div class="col-md-3">
                            <div id="chart_div_CS"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top: 2%">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <div style="padding-top: 1%">Resultados</div>
                </div>
                <div class="col-md-2">
                    <a href="{{route('consultas.excel')}}" class="btn btn-success" style="text-decoration: none">
                        Exportar a excel
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
           <div class="table-responsive">
            <table class="table table-sm" style="text-align: center">
                <thead>
                    <tr style="font-size: 80%;" id="titulosCA">
                    </tr>
                </thead>
                <tbody id="resultadoCA">
                </tbody>
            </table>
           </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/loader.js')}}"></script>
<script>
    var datos = <?php echo json_encode($DATOS);?>;
    
</script>
<script type="text/javascript" src="{{asset('js/datos.js')}}"></script>
@endsection