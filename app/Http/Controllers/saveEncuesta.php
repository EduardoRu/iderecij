<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clave_alumno;
use App\Models\Resultado;
use Illuminate\Support\Facades\DB;

class saveEncuesta extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clave = Clave_alumno::where('clave', $request->clave)->first();

        return view('test.idereTwo', compact('clave'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vr = Resultado::where('idclave_alumno', $request->idclave)->first();

        if($vr == null){
            $PRA = $request->PRA;
            $PRT = $request->PRT;
            $PRO = $request->PRO;

            $CSA = $request->CSA;
            $CST = $request->CST;
            $CSO = $request->CSO;

            $resultado = new Resultado;
        
            $resultado->salud_mental = $request->input('SM');
            $resultado->sistema_familiar = $request->input('SF');
            $resultado->presion_padres = $request->input('PP');
            $resultado->disp_sustancias_expect_consumo = $request->input('DSEC'); 

            $resultado->persepcion_riesgo = '{"Alcohol":'.$PRA.', "Tabaco": '.$PRT.', "Otras_drogas": '.$PRO.', "total": '.($PRO + $PRA + $PRT).'}';

            $resultado->desempeno_escolar = $request->input('DE');
            $resultado->violencia = $request->input('VI');
            $resultado->riesgo_inicio_incremento_consumo = $request->input('RIIC');

            $resultado->consumo_sustancias = '{"Alcohol": '.$CSA.', "Tabaco": '.$CST.', "Otras_drogas": '.$CSO.', "total": '.($CSA + $CST + $CSO).'}';

            $resultado->participacion_acciones_preventivas = $request->input('PAP');

            $resultado->idclave_alumno = $request->idclave;

            $resultado->save();

            return redirect()->route('clave');
        }else{
            return redirect()->route('clave');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
