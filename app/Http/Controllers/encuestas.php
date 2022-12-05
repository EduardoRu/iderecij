<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Encuest;
use App\Models\Grupo;
use Illuminate\Pagination\Paginator;
use App\Models\Clave_alumno;

class encuestas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $encuestas = Encuest::orderBy('idencuesta', 'DESC')->paginate(4);
        //$encuestas = DB::select('select * from encuestas;');

        return view('admin.pencuesta', compact('encuestas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.test.agregart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $TG = $request->input('ng');
        $x = 0;

        $escuela = new Encuest;

        $escuela->nombre_institucion = $request->nombre_institucion;
        $escuela->fecha_inicio = $request->fi;
        $escuela->fecha_final =  $request->ff;
        $escuela->turno = $request->turno;

        $escuela->save();

        $id = Encuest::where('nombre_institucion', $request->nombre_institucion)
            ->where('fecha_inicio', $request->fi)
            ->where('fecha_final', $request->ff)->first();

        $idescuela = (int)$id->idencuesta;

        while ($x != $TG) {

            $grupo = new Grupo;
            

            $gr = (int)$request->input('gr'.$x);
            $gu = strtoupper($request->input('gu'.$x));
            $ta = (int)$request->input('ta'.$x);
            
            $grupo->grado=$gr;
            $grupo->grupo=$gu;
            $grupo->total_alumnos_grupo=$ta;
            $grupo->idencuesta=$idescuela;


            $grupo->save();
            
            $x++;
        }

        return redirect()->route('pencuesta');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $encuesta = Encuest::findOrFail($id);
        $grupos = Grupo::where('idencuesta', $id)->get();

        return view('admin.test.editart', compact('encuesta', 'grupos'));
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
        $TG = $request->input('ngn');
        $TGR = $request->input('grid');
        $y = 1;

        $encuesta = Encuest::find($id);
        $grupos = DB::select('SELECT idgrupos,grado, grupo, total_alumnos_grupo FROM grupos INNER JOIN encuestas ON encuestas.idencuesta = grupos.idencuesta WHERE grupos.idencuesta = ?', [$id]);
        $grupos = json_decode(json_encode($grupos), true);
        $x = 0;

        if($encuesta->fecha_final <= $request->ff){

            DB::update(DB::raw('UPDATE clave_alumnos SET estado_clave = "habil" WHERE idgrupo ON  '));
        }


        if($encuesta->nombre_institucion != $request->nombre_institucion || $encuesta->fecha_final != $request->ff || $encuesta->fecha_inicio != $request->fi || $encuesta->turno != $request->turno){
            $encuesta->nombre_institucion = $request->nombre_institucion;
            $encuesta->fecha_inicio = $request->fi;
            $encuesta->fecha_final = $request->ff;
            $encuesta->turno = $request->turno;
            $encuesta->save();
        }

        for ($i=1; $i <= $TGR; $i++) {
            
            if($request->input('gre'.$i) == NULL 
            && $request->input('gue'.$i) == NULL 
            && $request->input('tae'.$i) == NULL){

                $grupo = Grupo::find($grupos[$x]['idgrupos']);
                
                $grupo->delete();
                

                #$claves = Clave_alumno::where('idgrupo', $grupo->idgrupo)->delete();

            }else if($grupos[$x]['grado']!=$request->input('gre'.$i) 
            || $grupos[$x]['grupo']!=$request->input('gue'.$i) 
            || $grupos[$x]['total_alumnos_grupo']!=$request->input('tae'.$i)){

                $grupo = Grupo::find($grupos[$x]['idgrupos']);

                $grupo->grado = $request->input('gre'.$i);
                $grupo->grupo = strtoupper($request->input('gue'.$i));
                $grupo->total_alumnos_grupo=$request->input('tae'.$i);

                $grupo->save();
            }
            $x++;
        }


        if($TG>0){
            while ($y <= $TG) {

                $grupo = new Grupo;
                
                $grupo->grado=$request->input('gr'.$y);
                $grupo->grupo=strtoupper($request->input('gu'.$y));
                $grupo->total_alumnos_grupo=$request->input('ta'.$y);;
                $grupo->idencuesta=$id;
    
                $grupo->save();
                
                $y++;
            }
        }

        return redirect()->route('pencuesta');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $encuesta = Encuest::find($id);

        $encuesta->delete();

        return redirect()->route('pencuesta');
    }
}
