<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\Consultas;
use App\Models\Clave_alumno;
use App\Models\Grupo;
use App\Models\Encuest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class genExcel extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genExcelD(Request $request)
    {

        $idAlumno = intval($request->input('IDA'));
        $idGrupo = intval($request->input('IDG'));
        $idEscuela = intval($request->input('IDE'));

        $nomExcel = "";

        if ($idAlumno != 0 && $idGrupo != 0 && $idEscuela != 0) {
            $Alumno = Clave_alumno::find($idAlumno);
            $Grupo = Grupo::find($idGrupo);
            $Escuela = Encuest::find($idEscuela);

            $nomExcel = $Alumno->nombre_alumno."-".$Grupo->grado.$Grupo->grupo."-".$Escuela->nombre_institucion;

        }else if($idGrupo != 0 && $idEscuela != 0){
            $Grupo = Grupo::find($idGrupo);
            $Escuela = Encuest::find($idEscuela);

            $nomExcel = $Grupo->grado.$Grupo->grupo."-".$Escuela->nombre_institucion;
        }else if($idEscuela != 0){
            $Escuela = Encuest::find($idEscuela);
            $nomExcel = $Escuela->nombre_institucion;
        }
        return (new Consultas($idAlumno, $idGrupo, $idEscuela))->download($nomExcel.'.xlsx');

    }
}
