<?php

namespace App\Http\Controllers;

use App\Models\Clave_alumno;
use Illuminate\Http\Request;
use App\Models\Encuest;
use App\Models\Grupo;
use App\Models\Resultado;
use Illuminate\Support\Facades\DB;

class consultaData extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $encuesta = Encuest::all();
        $grupos = Grupo::all();
        $claveAlumno = Clave_alumno::all();
        $resultado = Resultado::all();

        $GIN = DB::table('encuestas')
        ->select(
            DB::raw('encuestas.nombre_institucion AS "nomEscuela"'),
            DB::raw('SUM(resultados.salud_mental) AS "SM"'),
            DB::raw('SUM(resultados.sistema_familiar) AS "SF"'),
            DB::raw('SUM(resultados.presion_padres) AS "PP"'),
            DB::raw('SUM(resultados.disp_sustancias_expect_consumo) AS "DSEC"'),
            DB::raw('SUM(resultados.persepcion_riesgo->"$.total") AS "PR"'),
            DB::raw('SUM(resultados.desempeno_escolar) AS "DE"'),
            DB::raw('SUM(resultados.violencia) AS "VI"'),
            DB::raw('SUM(resultados.riesgo_inicio_incremento_consumo) AS "RIIC"'),
            DB::raw('SUM(resultados.consumo_sustancias->"$.total") AS "CS"'),
            DB::raw('SUM(resultados.participacion_acciones_preventivas) AS "PAP"'),
            DB::raw('SUM(resultados.IVG) AS "IVG"'),
            DB::raw('encuestas.idencuesta AS "idEncuesta"')
        )
        ->join('grupos', 'encuestas.idencuesta', '=', 'grupos.idencuesta')
        ->join('clave_alumnos', 'grupos.idgrupos', '=' ,'clave_alumnos.idgrupo')
        ->join('resultados', 'clave_alumnos.idclave_alumno','=' ,'resultados.idclave_alumno')
        ->groupBy('encuestas.idencuesta')
        ->orderByDesc(DB::raw('MAX(resultados.IVG)'))
        ->limit(6)
        ->get();

        $GGR = DB::table('encuestas')
        ->select(
            DB::raw('grupos.grado AS "grado"'),
            DB::raw('grupos.grupo AS "grupo"'),
            DB::raw('SUM(resultados.salud_mental) AS "SM"'),
            DB::raw('SUM(resultados.sistema_familiar) AS "SF"'),
            DB::raw('SUM(resultados.presion_padres) AS "PP"'),
            DB::raw('SUM(resultados.disp_sustancias_expect_consumo) AS "DSEC"'),
            DB::raw('SUM(resultados.persepcion_riesgo->"$.total") AS "PR"'),
            DB::raw('SUM(resultados.desempeno_escolar) AS "DE"'),
            DB::raw('SUM(resultados.violencia) AS "VI"'),
            DB::raw('SUM(resultados.riesgo_inicio_incremento_consumo) AS "RIIC"'),
            DB::raw('SUM(resultados.consumo_sustancias->"$.total") AS "CS"'),
            DB::raw('SUM(resultados.participacion_acciones_preventivas) AS "PAP"'),
            DB::raw('SUM(resultados.IVG) AS "IVG"'),
            DB::raw('encuestas.idencuesta AS "idEncuesta"'),
            DB::raw('grupos.idgrupos AS "idgrupo"')
        )
        ->join('grupos', 'encuestas.idencuesta', '=', 'grupos.idencuesta')
        ->join('clave_alumnos', 'grupos.idgrupos', '=' ,'clave_alumnos.idgrupo')
        ->join('resultados', 'clave_alumnos.idclave_alumno','=' ,'resultados.idclave_alumno')
        ->groupBy('grupos.idgrupos')
        ->orderByDesc(DB::raw('MAX(resultados.IVG)'))
        ->limit(6)
        ->get();

        $GAL = DB::table('encuestas')
        ->select(
            DB::raw('clave_alumnos.nombre_alumno AS "nomAlumno"'),
            DB::raw('resultados.salud_mental AS "SM"'),
            DB::raw('resultados.sistema_familiar AS "SF"'),
            DB::raw('resultados.presion_padres AS "PP"'),
            DB::raw('resultados.disp_sustancias_expect_consumo AS "DSEC"'),
            DB::raw('resultados.persepcion_riesgo->"$.total" AS "PR"'),
            DB::raw('resultados.desempeno_escolar AS "DE"'),
            DB::raw('resultados.violencia AS "VI"'),
            DB::raw('resultados.riesgo_inicio_incremento_consumo AS "RIIC"'),
            DB::raw('resultados.consumo_sustancias->"$.total" AS "CS"'),
            DB::raw('resultados.participacion_acciones_preventivas AS "PAP"'),
            DB::raw('resultados.IVG AS "IVG"'),
            DB::raw('clave_alumnos.idclave_alumno AS "idClaveAlumno"'),
            DB::raw('grupos.idgrupos AS "idgrupo"'),
            DB::raw('encuestas.idencuesta AS "idEncuesta"')
        )
        ->join('grupos', 'encuestas.idencuesta', '=', 'grupos.idencuesta')
        ->join('clave_alumnos', 'grupos.idgrupos', '=' ,'clave_alumnos.idgrupo')
        ->join('resultados', 'clave_alumnos.idclave_alumno','=' ,'resultados.idclave_alumno')
        ->groupBy('clave_alumnos.idclave_alumno')
        ->orderByDesc('resultados.IVG')
        ->limit(6)
        ->get();

        return view('admin.consulta', compact('encuesta', 'grupos', 'claveAlumno', 'resultado', 'GIN', 'GGR', 'GAL'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        if((Grupo::where('idgrupos', $request->input('GRES'))->first()) != null){

            if((Clave_alumno::where('idclave_alumno', $request->input('ALES'))->first()) != null){

                $DATOS = DB::table('clave_alumnos')
                ->select(
                    DB::raw('clave_alumnos.idclave_alumno AS "idAlumno"'),
                    DB::raw('clave_alumnos.nombre_alumno AS "Nombre"'),
                    DB::raw('clave_alumnos.sexo AS "Sexo"'),
                    DB::raw('grupos.grado AS "grado"'),
                    DB::raw('grupos.grupo AS grupo'),
                    DB::raw('encuestas.nombre_institucion AS nomEscuela'),
                    DB::raw('resultados.IVG AS "IVG"'),
                    DB::raw('resultados.salud_mental AS "SM"'), 
                    DB::raw('resultados.sistema_familiar AS "SF"'), 
                    DB::raw('resultados.presion_padres AS "PP"'), 
                    DB::raw('resultados.disp_sustancias_expect_consumo AS "DSEC"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.total") AS "PR"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.Tabaco") AS "PRT"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.Alcohol") AS "PRA"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.Otras_drogas") AS "PRO"'),
                    DB::raw('resultados.desempeno_escolar AS "DE"'), 
                    DB::raw('resultados.violencia AS "VI"'), 
                    DB::raw('resultados.riesgo_inicio_incremento_consumo AS "RIIC"'),
                    DB::raw('(resultados.consumo_sustancias->"$.total") AS "CS"'),
                    DB::raw('(resultados.consumo_sustancias->"$.Tabaco") AS "CST"'),
                    DB::raw('(resultados.consumo_sustancias->"$.Alcohol") AS "CSA"'),
                    DB::raw('(resultados.consumo_sustancias->"$.Otras_drogas") AS "CSO"'),
                    DB::raw('resultados.participacion_acciones_preventivas AS "PAP"'),
                )
                ->join('resultados','resultados.idclave_alumno','=','clave_alumnos.idclave_alumno')
                ->join('grupos','clave_alumnos.idgrupo','=','grupos.idgrupos')
                ->join('encuestas','grupos.idencuesta','=','encuestas.idencuesta')
                ->where('clave_alumnos.idclave_alumno', $request->input('ALES'))
                ->get();

                return view('admin.query.mostrarData', compact('DATOS'));

            } else{

                $DATOS = DB::table('clave_alumnos')
                ->select(
                    DB::raw('clave_alumnos.idclave_alumno AS "idAlumno"'),
                    DB::raw('clave_alumnos.nombre_alumno AS "Nombre"'),
                    DB::raw('clave_alumnos.sexo AS "Sexo"'),
                    DB::raw('grupos.grado AS "grado"'),
                    DB::raw('grupos.grupo AS grupo'),
                    DB::raw('resultados.IVG AS "IVG"'),
                    DB::raw('encuestas.nombre_institucion AS nomEscuela'),
                    DB::raw('resultados.salud_mental AS "SM"'), 
                    DB::raw('resultados.sistema_familiar AS "SF"'), 
                    DB::raw('resultados.presion_padres AS "PP"'), 
                    DB::raw('resultados.disp_sustancias_expect_consumo AS "DSEC"'),
                    DB::raw('(resultados.persepcion_riesgo->"$.total") AS "PR"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.Tabaco") AS "PRT"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.Alcohol") AS "PRA"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.Otras_drogas") AS "PRO"'), 
                    DB::raw('resultados.desempeno_escolar AS "DE"'), 
                    DB::raw('resultados.violencia AS "VI"'), 
                    DB::raw('resultados.riesgo_inicio_incremento_consumo AS "RIIC"'),
                    DB::raw('(resultados.consumo_sustancias->"$.total") AS "CS"'),
                    DB::raw('(resultados.consumo_sustancias->"$.Tabaco") AS "CST"'),
                    DB::raw('(resultados.consumo_sustancias->"$.Alcohol") AS "CSA"'),
                    DB::raw('(resultados.consumo_sustancias->"$.Otras_drogas") AS "CSO"'), 
                    DB::raw('resultados.participacion_acciones_preventivas AS "PAP"'),
                )
                ->join('resultados','resultados.idclave_alumno','=','clave_alumnos.idclave_alumno')
                ->join('grupos','clave_alumnos.idgrupo','=','grupos.idgrupos')
                ->join('encuestas','grupos.idencuesta','=','encuestas.idencuesta')
                ->where('grupos.idgrupos',  $request->input('GRES'))
                ->groupBy('clave_alumnos.idclave_alumno')
                ->get();

                return view('admin.query.mostrarData', compact('DATOS'));
            }
        }else{

            $DATOS = DB::table('resultados')
            ->select(
                DB::raw('grupos.idgrupos AS "idGrupo"'),
                DB::raw('grupos.grado AS "grado"'),
                DB::raw('grupos.grupo AS "grupo"'),
                DB::raw('encuestas.nombre_institucion AS nomEscuela'),
                DB::raw('SUM(resultados.IVG) AS "IVG"'),
                DB::raw('SUM(resultados.salud_mental) AS "SM"'), 
                DB::raw('SUM(resultados.sistema_familiar) AS "SF"'), 
                DB::raw('SUM(resultados.presion_padres) AS "PP"'), 
                DB::raw('SUM(resultados.disp_sustancias_expect_consumo) AS "DSEC"'), 
                DB::raw('SUM(resultados.persepcion_riesgo->"$.total") AS "PR"'),
                DB::raw('SUM(resultados.persepcion_riesgo->"$.Tabaco") AS "PRT"'), 
                DB::raw('SUM(resultados.persepcion_riesgo->"$.Alcohol") AS "PRA"'), 
                DB::raw('SUM(resultados.persepcion_riesgo->"$.Otras_drogas") AS "PRO"'),
                DB::raw('SUM(resultados.desempeno_escolar) AS "DE"'), 
                DB::raw('SUM(resultados.violencia) AS "VI"'), 
                DB::raw('SUM(resultados.riesgo_inicio_incremento_consumo) AS "RIIC"'),
                DB::raw('SUM(resultados.consumo_sustancias->"$.total") AS "CS"'),
                DB::raw('SUM(resultados.consumo_sustancias->"$.Tabaco") AS "CST"'),
                DB::raw('SUM(resultados.consumo_sustancias->"$.Alcohol") AS "CSA"'),
                DB::raw('SUM(resultados.consumo_sustancias->"$.Otras_drogas") AS "CSO"'),
                DB::raw('SUM(resultados.participacion_acciones_preventivas) AS "PAP"'))
            ->join('clave_alumnos','resultados.idclave_alumno','=','clave_alumnos.idclave_alumno')
            ->join('grupos','clave_alumnos.idgrupo','=','grupos.idgrupos')
            ->join('encuestas','grupos.idencuesta','=','encuestas.idencuesta')
            ->where('encuestas.idencuesta', $request->input('INES'))
            ->groupBy('grupos.idgrupos')
            ->get();

            return view('admin.query.mostrarData', compact('DATOS'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showGeneral(Request $request)
    {
        if((Grupo::where('idgrupos', $request->input('GGR'))->first()) != null){

            if((Clave_alumno::where('idclave_alumno', $request->input('GAL'))->first()) != null){

                $DATOS = DB::table('clave_alumnos')
                ->select(
                    DB::raw('clave_alumnos.idclave_alumno AS "idAlumno"'),
                    DB::raw('clave_alumnos.nombre_alumno AS "Nombre"'),
                    DB::raw('clave_alumnos.sexo AS "Sexo"'),
                    DB::raw('grupos.grado AS "grado"'),
                    DB::raw('grupos.grupo AS grupo'),
                    DB::raw('encuestas.nombre_institucion AS nomEscuela'),
                    DB::raw('resultados.IVG AS "IVG"'),
                    DB::raw('resultados.salud_mental AS "SM"'), 
                    DB::raw('resultados.sistema_familiar AS "SF"'), 
                    DB::raw('resultados.presion_padres AS "PP"'), 
                    DB::raw('resultados.disp_sustancias_expect_consumo AS "DSEC"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.total") AS "PR"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.Tabaco") AS "PRT"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.Alcohol") AS "PRA"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.Otras_drogas") AS "PRO"'),
                    DB::raw('resultados.desempeno_escolar AS "DE"'), 
                    DB::raw('resultados.violencia AS "VI"'), 
                    DB::raw('resultados.riesgo_inicio_incremento_consumo AS "RIIC"'),
                    DB::raw('(resultados.consumo_sustancias->"$.total") AS "CS"'),
                    DB::raw('(resultados.consumo_sustancias->"$.Tabaco") AS "CST"'),
                    DB::raw('(resultados.consumo_sustancias->"$.Alcohol") AS "CSA"'),
                    DB::raw('(resultados.consumo_sustancias->"$.Otras_drogas") AS "CSO"'),
                    DB::raw('resultados.participacion_acciones_preventivas AS "PAP"'),
                )
                ->join('resultados','resultados.idclave_alumno','=','clave_alumnos.idclave_alumno')
                ->join('grupos','clave_alumnos.idgrupo','=','grupos.idgrupos')
                ->join('encuestas','grupos.idencuesta','=','encuestas.idencuesta')
                ->where('clave_alumnos.idclave_alumno', $request->input('GAL'))
                ->get();

                return view('admin.query.mostrarData', compact('DATOS'));

            } else{

                $DATOS = DB::table('clave_alumnos')
                ->select(
                    DB::raw('clave_alumnos.idclave_alumno AS "idAlumno"'),
                    DB::raw('clave_alumnos.nombre_alumno AS "Nombre"'),
                    DB::raw('clave_alumnos.sexo AS "Sexo"'),
                    DB::raw('grupos.grado AS "grado"'),
                    DB::raw('grupos.grupo AS grupo'),
                    DB::raw('resultados.IVG AS "IVG"'),
                    DB::raw('encuestas.nombre_institucion AS nomEscuela'),
                    DB::raw('resultados.salud_mental AS "SM"'), 
                    DB::raw('resultados.sistema_familiar AS "SF"'), 
                    DB::raw('resultados.presion_padres AS "PP"'), 
                    DB::raw('resultados.disp_sustancias_expect_consumo AS "DSEC"'),
                    DB::raw('(resultados.persepcion_riesgo->"$.total") AS "PR"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.Tabaco") AS "PRT"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.Alcohol") AS "PRA"'), 
                    DB::raw('(resultados.persepcion_riesgo->"$.Otras_drogas") AS "PRO"'), 
                    DB::raw('resultados.desempeno_escolar AS "DE"'), 
                    DB::raw('resultados.violencia AS "VI"'), 
                    DB::raw('resultados.riesgo_inicio_incremento_consumo AS "RIIC"'),
                    DB::raw('(resultados.consumo_sustancias->"$.total") AS "CS"'),
                    DB::raw('(resultados.consumo_sustancias->"$.Tabaco") AS "CST"'),
                    DB::raw('(resultados.consumo_sustancias->"$.Alcohol") AS "CSA"'),
                    DB::raw('(resultados.consumo_sustancias->"$.Otras_drogas") AS "CSO"'), 
                    DB::raw('resultados.participacion_acciones_preventivas AS "PAP"'),
                )
                ->join('resultados','resultados.idclave_alumno','=','clave_alumnos.idclave_alumno')
                ->join('grupos','clave_alumnos.idgrupo','=','grupos.idgrupos')
                ->join('encuestas','grupos.idencuesta','=','encuestas.idencuesta')
                ->where('grupos.idgrupos',  $request->input('GGR'))
                ->groupBy('clave_alumnos.idclave_alumno')
                ->get();

                return view('admin.query.mostrarData', compact('DATOS'));
            }
        }else{

            $DATOS = DB::table('resultados')
            ->select(
                DB::raw('grupos.idgrupos AS "idGrupo"'),
                DB::raw('grupos.grado AS "grado"'),
                DB::raw('grupos.grupo AS "grupo"'),
                DB::raw('encuestas.nombre_institucion AS nomEscuela'),
                DB::raw('SUM(resultados.IVG) AS "IVG"'),
                DB::raw('SUM(resultados.salud_mental) AS "SM"'), 
                DB::raw('SUM(resultados.sistema_familiar) AS "SF"'), 
                DB::raw('SUM(resultados.presion_padres) AS "PP"'), 
                DB::raw('SUM(resultados.disp_sustancias_expect_consumo) AS "DSEC"'), 
                DB::raw('SUM(resultados.persepcion_riesgo->"$.total") AS "PR"'),
                DB::raw('SUM(resultados.persepcion_riesgo->"$.Tabaco") AS "PRT"'), 
                DB::raw('SUM(resultados.persepcion_riesgo->"$.Alcohol") AS "PRA"'), 
                DB::raw('SUM(resultados.persepcion_riesgo->"$.Otras_drogas") AS "PRO"'),
                DB::raw('SUM(resultados.desempeno_escolar) AS "DE"'), 
                DB::raw('SUM(resultados.violencia) AS "VI"'), 
                DB::raw('SUM(resultados.riesgo_inicio_incremento_consumo) AS "RIIC"'),
                DB::raw('SUM(resultados.consumo_sustancias->"$.total") AS "CS"'),
                DB::raw('SUM(resultados.consumo_sustancias->"$.Tabaco") AS "CST"'),
                DB::raw('SUM(resultados.consumo_sustancias->"$.Alcohol") AS "CSA"'),
                DB::raw('SUM(resultados.consumo_sustancias->"$.Otras_drogas") AS "CSO"'),
                DB::raw('SUM(resultados.participacion_acciones_preventivas) AS "PAP"'))
            ->join('clave_alumnos','resultados.idclave_alumno','=','clave_alumnos.idclave_alumno')
            ->join('grupos','clave_alumnos.idgrupo','=','grupos.idgrupos')
            ->join('encuestas','grupos.idencuesta','=','encuestas.idencuesta')
            ->where('encuestas.idencuesta', $request->input('GIN'))
            ->groupBy('grupos.idgrupos')
            ->get();

            return view('admin.query.mostrarData', compact('DATOS'));
        }

        return view('admin.query.mostrarData', compact('DATOS'));
    }

     
}
