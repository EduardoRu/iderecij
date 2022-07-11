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
                    <div style="padding-top: 1%">
                        Resultados 
                        @if ($IDALUMNO == "0" && $IDGRUPO == "0")
                        || Seleccione el grado: 
                        <select name="SG" id="SG" onclick="getGrados()">
                            <option value=""></option>
                        </select>
                        @endif
                    </div>
                </div>
                @if ($IDALUMNO !="0" && $IDGRUPO !="0" && $IDESCUELA !="0")
                <div class="col-md-2">
                    <form action="{{route('consultas.excel')}}" method="GET">
                        <div>
                            <input type="number" id="IDA" name="IDA" value="{{$IDALUMNO}}" hidden>
                            <input type="number" id="IDG" name="IDG" value="{{$IDGRUPO}}" hidden>
                            <input type="number" id="IDE" name="IDE" value="{{$IDESCUELA}}" hidden>
                        </div>
                        <button type="submit" class="btn btn-success"> Exportar a excel </button>
                    </form>
                </div>
                @elseif ($IDGRUPO !="0" && $IDESCUELA !="0")
                <div class="col-md-2">
                    <form action="{{route('consultas.excel')}}" method="GET">
                        <div>
                            <input type="number" id="IDA" name="IDA" value="{{$IDALUMNO}}" hidden>
                            <input type="number" id="IDG" name="IDG" value="{{$IDGRUPO}}" hidden>
                            <input type="number" id="IDE" name="IDE" value="{{$IDESCUELA}}" hidden>
                        </div>
                        <button type="submit" class="btn btn-success"> Exportar a excel </button>
                    </form>
                </div>
                @else
                <div class="col-md-2">
                    <form action="{{route('consultas.excel')}}" method="GET">
                        <div>
                            <input type="number" id="IDA" name="IDA" value="{{$IDALUMNO}}" hidden>
                            <input type="number" id="IDG" name="IDG" value="{{$IDGRUPO}}" hidden>
                            <input type="number" id="IDE" name="IDE" value="{{$IDESCUELA}}" hidden>
                        </div>
                        <button type="submit" class="btn btn-success"> Exportar a excel </button>
                    </form>
                    
                </div>
                @endif
                
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
@if ($IDALUMNO !="0" && $IDGRUPO !="0" && $IDESCUELA !="0")
    <script type="text/javascript" src="{{asset('js/datos.js')}}"></script>
@elseif ($IDGRUPO !="0" && $IDESCUELA !="0")
    <script type="text/javascript" src="{{asset('js/datos.js')}}"></script>
@else
    <script type="text/javascript" src="{{asset('js/datosINS.js')}}"></script>
@endif
@endsection