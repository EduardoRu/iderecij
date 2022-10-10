@extends('layouts.app')
@section('title', 'CIJ • Programar test')
@section('content')
<script src="{{asset('js/edit.js')}}"></script>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2>Historial de encuestas</h2>
        </div>
        <div class="col-md-2">
            <a class="btn btn-primary border-0" href="{{route('pencuesta.create')}}">
                Agregar encuesta
            </a>
        </div>
    </div>
    <hr>
    <div class="container">
        @foreach ($encuestas as $e)
        <div class="card" style="margin-top: 1%">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <h5>Nombre de la institución</h5>{{$e->nombre_institucion}}
                    </div>
                    <div class="col-md-3">
                        <h5>Periodo de evaluación</h5>Del: {{$e->fecha_inicio}} al {{$e->fecha_final}}
                    </div>
                    <div class="col-md-3" style="text-align: center">
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Alumnos</h5> {{$e->total_alumnos_escuela}}
                            </div>
                            <div class="col-md-4">
                                <h5>Grupos</h5> {{$e->total_grupos}}
                            </div>
                            <div class="col-md-4">
                                <h5> Turno </h5> {{$e->turno}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8" style="padding-top: 3%">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{route('pencuesta.genpdf', $e->idencuesta)}}" style=" text-decoration:none; color:black">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="padding-left: 8%">
                                        <a href="{{route('pencuesta.show', $e->idencuesta)}}" style="padding-right: 7%;  text-decoration:none; color:black">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </a>
                                    </div>
                                   <div class="col-md-4">
                                    <form action="{{route('pencuesta.destroy', $e->idencuesta)}}" method="POST" onsubmit="return borrarEncuesta()">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="border-0" style="text-decoration:none; color:black; background-color:transparent ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                              </svg>
                                        </button>
                                    </form>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <br>
        <center>
            {{$encuestas->links()}}
        </center>
    </div>
</div>
@endsection