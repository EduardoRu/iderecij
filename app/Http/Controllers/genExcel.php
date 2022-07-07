<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\Consultas;
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

        //return [$idAlumno, $idGrupo, $idEscuela];

        return (new Consultas($idAlumno, $idGrupo, $idEscuela))->download('invoices.xlsx');

    }
}
