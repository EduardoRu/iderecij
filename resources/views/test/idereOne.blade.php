@extends('layouts.appUser')
@section('title', 'Datos personales')
@section('contenido')

<div class="" style="text-align: center; padding-top:3%">
    <h2>Favor de ingresar los siguientes datos</h2>
</div>

<div style="display: flex;justify-content: center;align-items: center; padding-top:3%; padding-bottom: 3%;">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{route('test.update', $clave->idclave_alumno)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="input-group-lg">
                        <label for="nombre"><h3>Nombre completo</h3></label>
                        <br>
                        <input 
                        class="form-control rounded-4"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                        type="text" placeholder="Ingresa tu nombre completo" name="nombre" id="nombre" required>
                    </div>
                    
                    <div class="" style="padding-top: 2%">
                        <div class="row">
                            
                            <div class="col-md-3">
                                <div>
                                    <label for="edad"><h3>Escribe tu edad</h3></label>
                                    <br>
                                    <input class="form-control rounded-4" type="number" id="edad" name="edad" placeholder="Escribe tu edad" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h3>Por favor selecciona tu genero</h3>
                                <p>
                                    <input type="radio" name="sexo" id="sexoUno" value="masculino" required>
                                    <label for="sexoUno" style="font-size: 20px"> Masculino </label>
                    
                                    <input type="radio" name="sexo" id="sexoDos" value="femenino" required>
                                    <label for="sexoDos" style="font-size: 20px"> Femenino </label>
                                </p>
                            </div>
                            <div class="col" style="padding-left: 15%; padding-top:2%">
                                <input class="btn btn-lg" type="submit" value="Enviar datos" style="background-color: #ed6f00; color:white">
                            </div>
                        </div>

                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection