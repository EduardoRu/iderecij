@extends('layouts.app')
@section('title', 'Agregar encuesta')
@section('content')
<script src="{{asset('js/edit.js')}}"></script>
<div class="container">
    <div>
        <h1>Ingrese los datos referentes a la institución</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{route('pencuesta.update', $encuesta)}}" method="POST" onsubmit="return valGroup()">
                @method('put')
                @csrf
                <div class="">
                    <label for="nombre_institucion"><h4>Nombre de la institución</h4></label><br>
                    <input class="form-control rounded-4"  value="{{$encuesta->nombre_institucion}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" type="text" id="nombre_institucion" name="nombre_institucion" placeholder="Nombre de la escuela" required>
                </div>
                <div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4" style="text-align: center">
                            <h4>Periodo de aplicaión del test</h4>
                        </div>
                        <div class="col-md-4" style="text-align: center">
                            <h4>Turno</h4>
                        </div>
                        <div class="col-md-3" style="text-align: center;">
                            <label for="ng">Numero de grupos: </label>
                            <div id="ngtotal">{{$encuesta->total_grupos}}</div>
                            <input type="text" id="ng" name="ng" value="{{$encuesta->total_grupos}}" hidden>
                            <input type="number" id="ngn" name="ngn" value="0" hidden>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2">
                            <label for="fi"><h5>Periodo inicial</h5></label>
                            <input class="form-control" type="date" name="fi" id="fi" value="{{$encuesta->fecha_inicio}}" required>
                        </div> 
                        <div class="col-md-2">
                            <label for="fi"><h5>Periodo final</h5></label>
                            <input class="form-control" type="date" name="ff" id="ff" value="{{$encuesta->fecha_final}}" required>
                        </div>
                        <div class="col-md-4">
                            <div class="row" style="padding-left: 30%">
                            @if ($encuesta->turno === 'matutino')
                            <div class=" form-check">
                                <label class="form-check-label" for="turnM"> <h5>Turno matutino</h5> </label>
                                <input type="radio" class="form-check-input" name="turno" value="matutino" id="turnM" checked="checked" required>
                            </div>
                            <div class=" form-check">
                                <input type="radio" class="form-check-input" name="turno" value="vespertino" id="turnV" required>
                                <label class="form-check-label" for="turnV"> <h5>Turno vespertino</h5> </label>
                            </div>
                            @elseif ($encuesta->turno === 'vespertino')
                            <div class=" form-check">
                                <label class="form-check-label" for="turnM"> <h5>Turno matutino</h5> </label>
                                <input type="radio" class="form-check-input" name="turno" value="matutino" id="turnM" required>
                            </div>
                            <div class=" form-check">
                                <input type="radio" class="form-check-input" name="turno" value="vespertino" id="turnV" checked="checked" required>
                                <label class="form-check-label" for="turnV"> <h5>Turno vespertino</h5> </label>
                            </div>
                            @else
                            <div class=" form-check">
                                <label class="form-check-label" for="turnM"> <h5>Turno matutino</h5> </label>
                                <input type="radio" class="form-check-input" name="turno" value="matutino" id="turnM" required>
                            </div>
                            <div class=" form-check">
                                <input type="radio" class="form-check-input" name="turno" value="vespertino" id="turnV" required>
                                <label class="form-check-label" for="turnV"> <h5>Turno vespertino</h5> </label>
                            </div>
                            @endif  
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-top: 2%">
                                <div class="row">
                                    <div class="col-md-5">
                                        <input href="" class="btn" onclick="addGroup()" value="Agregar grupo" style="background-color: #36c786; color:white; width: 100%;">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="button" class="btn" value="Eliminar grupo" style="background-color: #cb1d12; width: 100%; color:white" onclick="delGroup()">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div hidden>{{$x=0;}}</div>
                <div class="container">
                    <div id="grupos">
                        @foreach ($grupos as $g)
                        <div class="row" style="margin-top:1%;margin-left:1%">
                            <div class="col card" style="padding-left:5%">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div style="padding-top:6%" id="{{$x++}}">Grupo registrado</div>
                                            </div>
                                            <div class="col-md-3" style="padding-top:5px; padding-bottom:5px">
                                                <label for="gr1">Grado: </label>
                                                <input type="number" style="width: 40%" placeholder="Ej. 1-9" id="gre{{$x}}" name="gre{{$x}}" min="0" value="{{$g->grado}}" required>
                                            </div>
                                            <div class="col-md-3" style="padding-top:5px; padding-bottom:5px">
                                                <label for="gu1">Grupo: </label>
                                                <input type="text" style="width: 40%" placeholder="Ej. A-Z" maxlength="1" id="gue{{$x}}" name="gue{{$x}}" value="{{$g->grupo}}"required>
                                            </div>
                                            <div class="col-md-3" style="padding-top:5px; padding-bottom:5px">
                                                <label for="ta1">Alumnos: </label>
                                                <input type="number" style="width: 40%" placeholder="Ej. 30" min="0" id="tae{{$x}}" name="tae{{$x}}" value="{{$g->total_alumnos_grupo}}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <input type="number" id="grid" name="grid" value="{{$x}}" hidden>
                <hr>
                <input type="text" hidden value="" id="grupostotal" name="grupostotal">
                <div class="row" style="padding-left: 7%">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <a href="{{route('pencuesta')}}" class="btn btn-lg" style="background-color: #cb1d12;color:white;" class="form-control rounded-4"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">Cancelar</a>
                        <button type="submit" class="btn btn-lg" style="background-color: #36c786; color:white;" class="form-control rounded-4"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"> Guardar cambios </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection