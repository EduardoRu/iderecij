<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\Consultas;
use Maatwebsite\Excel\Facades\Excel;


class genExcel extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genExcelD(Request $request)
    {

        return Excel::download(new Consultas, 'Clave_Alumnos.xlsx');
    }
}
