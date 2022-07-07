<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clave_alumno;
use Illuminate\Support\Facades\DB;


class ValidationKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clave = Clave_alumno::where('clave', $request->clave)->first();

        if($clave != null){
            if($clave['clave'] && $clave['nombre_alumno'] == null && $clave['sexo'] == null && $clave['estado_clave'] != 'inhabil'){
                return redirect()->route('datosPersonales', $request->clave);
            }elseif($clave['clave'] && $clave['nombre_alumno'] != null && $clave['sexo'] != null && $clave['estado_clave'] != 'inhabil'){
                return redirect()->route('encuesta', $request->clave);
            }else{
                return redirect()->route('clave');
            }
        }else{
            return redirect()->route('clave');
        }
    }
}
