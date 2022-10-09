@extends('layouts.app')
@section('title', 'Agregar encuesta')
@section('content')
<script src="{{asset('js/add.js')}}"></script>
<div class="container">
    <div>
        <h1>Ingrese los datos referentes a la institución</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{route('pencuesta.store')}}" method="POST" onsubmit="return valGroup()">
                @method('post')
                @csrf
                <div class="">
                    <label for="nombre_institucion"><h4>Nombre de la institución</h4></label><br>
                    <input class="form-control rounded-4"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" type="text" id="nombre_institucion" name="nombre_institucion" placeholder="Nombre de la escuela" required>
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
                            <div id="ngtotal">0</div>
                            <input type="text" id="ng" name="ng" value="0" style="width: 12%" hidden>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2" style="text-align: center">
                            <label for="fi"><h5>Periodo inicial</h5></label>
                            <input class="form-control" type="date" name="fi" id="fi" required>
                        </div> 
                        <div class="col-md-2" style="text-align: center">
                            <label for="fi"><h5>Periodo final</h5></label>
                            <input class="form-control" type="date" name="ff" id="ff" required>
                        </div>
                        <div class="col-md-4">
                            <div class="row" style="padding-left: 30%">
                                <div class=" form-check">
                                    <label class="form-check-label" for="turnM"> <h5>Turno matutino</h5> </label>
                                    <input type="radio" class="form-check-input" name="turno" value="matutino" id="turnM" required>
                                </div>
                                <div class=" form-check">
                                    <input type="radio" class="form-check-input" name="turno" value="vespertino" id="turnV" required>
                                    <label class="form-check-label" for="turnV"> <h5>Turno vespertino</h5> </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-top: 2%">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input href="" class="btn" onclick="addGroup()" value="Agregar grupo" style="background-color: #36c786; color:white; width: 100%;">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="button" class="btn" value="Eliminar grupo" style="background-color: #cb1d12; width: 100%; color:white" onclick="delGroup()">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="container">
                    <div id="grupos">
                    </div>
                </div>
                <hr>
                <input type="text" hidden value="" id="grupostotal" name="grupostotal">
                <div class="row" style="padding-left: 7%">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <a href="{{route('pencuesta')}}" class="btn btn-lg" style="background-color: #cb1d12;color:white;" class="form-control rounded-4"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">Cancelar</a>
                        <button type="submit" class="btn btn-lg" style="background-color: #36c786; color:white;" class="form-control rounded-4"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"> Agregar test </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection