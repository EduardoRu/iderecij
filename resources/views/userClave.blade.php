@extends('layouts.appUser')
@section('title', 'CIJ • IDERE')
@section('pp')
<a href="{{ route('login') }}" class="navbar-brand btn btn-light">
    ¿Eres administrador?
</a>
@endsection
@section('contenido')
    <div class="container">
        <div style="text-align: center; padding-top:4%">
            <h1> CENTROS DE INTEGRACIÓN JUVENIL A.C. <br> ZACATECAS, ZAC.</h1>
        </div>
        <div style="display: flex;justify-content: center;align-items: center; padding-top:3%;">
            <div class="row justify-content-center">
                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="border-header">
                    </div>
                    <div class="card-body">
                        <p> Favor de ingresar la clave proporcionada por CIJ para comenzar a contestar la encuesta</p>
                       <center>
                        <form action="{{route('getClave')}}" method="GET">
                            <div style="text-aling: center" class="input-group input-group-lg">
                                <input class="form-control rounded-4"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" type="text" placeholder="Ingrese su clave" id="clave" name="clave" value={{old('clave')}}>
                            </div>
                            <div class="" style="padding-top: 2%">
                                <button type="submit" class="btn btn-lg" style="background-color: #ed6f00; color:white">
                                    Ingresar
                                </button>
                            </div>
                        </form>
                       </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
