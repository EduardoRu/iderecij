@extends('layouts.app')
@section('title', 'CIJ • Consultas')
@section('content')
<input type="text" value="{{$encuesta}}" id="encuestas" hidden>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="text-align: center">
                            Buscar un resultado
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route("consultas.show")}}" method="GET" onsubmit="return valValues()">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h4>Instituciones</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <label for="INE">Buscar por instituciones:</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="checkbox" class="form-check-input" id="INE" onclick="verINE()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <select name="INES" id="INES" onclick="getINES()" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option>---</option>
                                            @forelse ($encuesta as $e)
                                                <option value="{{$e->idencuesta}}">{{$e->nombre_institucion}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
    
    
                                <div class="row" style="padding-top: 1%">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h4>Grupos</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <label for="GRE">Buscar por grupos:</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="checkbox" class="form-check-input" id="GRE" onclick="verGRE()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <select name="GRES" id="GRES" onclick="getGRES()" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option>---</option>
                                        </select>
                                    </div>
                                </div>
    
    
                                <div class="row" style="padding-top: 1%">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h4>Alumnos</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <label for="ALE">Buscar por alumnos:</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="checkbox" class="form-check-input" id="ALE" onclick="verALE()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <select name="ALES" id="ALES" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option> --- </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn" style="background-color: #ed6f00; color:white">
                                    Buscar resultados
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container" style="padding-top: 2%">
        <div class="card">
            <div class="card-header">
                <div style="text-align: center">
                    Busquedas generales
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('consultas.showGeneral')}}" method="GET">
                    <div id="datosGenerales">
                        <input type="number" id="GIN" name="GIN" value="" hidden>
                        <input type="number" id="GGR" name="GGR" value="" hidden>
                        <input type="number" id="GAL" name="GAL" value="" hidden>
                    </div>
                    <div class="" id="fby">
                        <div class="row" id="fb"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="{{asset('js/loader.js')}}"></script>
    <script>
        var encuesta = <?php echo json_encode($encuesta);?>;
        var grupos = <?php echo json_encode($grupos);?>;
        var claveAlumnos = <?php echo json_encode($claveAlumno);?>;
        var resultados = <?php echo json_encode($resultado);?>;

        var GIN = <?php echo json_encode($GIN);?>;
        var GGR = <?php echo json_encode($GGR);?>;
        var GAL = <?php echo json_encode($GAL);?>;

    </script>
    <script type="text/javascript" src="{{asset('js/explore.js')}}"></script>

@endsection