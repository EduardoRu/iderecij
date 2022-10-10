<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clave_alumno;
use App\Models\Grupo;
use App\Models\Encuest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class genpdf extends Controller
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
    
    public function index($id)
    {
        $encuesta = Encuest::find($id);
        $TG = $encuesta->total_grupos;

        $grupos = Grupo::where('idencuesta', $encuesta->idencuesta)->get();

        for($i = 0; $i < $TG; $i++){
            $ID = $grupos[$i]['idgrupos'];
            $TA = $grupos[$i]['total_alumnos_grupo'];
            $GR = $grupos[$i]['grado'];
            $GU = $grupos[$i]['grupo'];
            $x = 0;

            

            $VCA = DB::select('SELECT * FROM clave_alumnos WHERE idgrupo = ?', [$ID]);
            $VCA = json_decode(json_encode($VCA), true);

            $val = DB::select('SELECT COUNT(idclave_alumno) FROM clave_alumnos WHERE idgrupo = ?', [$ID]);
            $val = json_decode(json_encode($val), true);
            $val = $val[0]["COUNT(idclave_alumno)"];

            if($VCA == null){
                while($TA > $x){
                    $CA = new Clave_alumno;
    
                    $clave = DB::select('
                    SELECT UCASE(CONCAT(LEFT(?,2), RIGHT(?,2),?,?,"'.($x+1).'_",LEFT(?,1),LEFT(?,4))) AS CLAVE FROM encuestas INNER JOIN grupos ON grupos.idencuesta = encuestas.idencuesta WHERE grupos.idgrupos = ? LIMIT 1',
                    [$encuesta->nombre_institucion, $encuesta->nombre_institucion, $GR, $GU,$encuesta->turno, $encuesta->fecha_final, $ID]);
                    $clave = json_decode(json_encode($clave), true);
                    $clave = $clave[0]['CLAVE'];
    
    
                    $CA->clave = $clave;
                    $CA->estado_clave = "habil";
                    $CA->idgrupo = $ID;
    
                    $CA->save();
    
                    $x++;
                }
            }
            else if($TA != $val && $TA > $val){
                while ($TA != $val) { 
                    $CA = new Clave_alumno;

                    $clave = DB::select('
                    SELECT UCASE(CONCAT(LEFT(?,2), RIGHT(?,2),?,?,"'.($val+1).'_",LEFT(?,1),LEFT(?,4))) AS CLAVE FROM encuestas INNER JOIN grupos ON grupos.idencuesta = encuestas.idencuesta WHERE grupos.idgrupos = ? LIMIT 1',
                    [$encuesta->nombre_institucion, $encuesta->nombre_institucion, $GR, $GU,$encuesta->turno, $encuesta->fecha_final, $ID]);
                    $clave = json_decode(json_encode($clave), true);
                    $clave = $clave[0]['CLAVE'];
        
                    $CA->clave = $clave;
                    $CA->estado_clave = "habil";
                    $CA->idgrupo = $ID;
            
                    $CA->save();
                    $val++;
                }
            }else if($VCA != null && $TA != $val){
                while($TA > $x){

                        $CA = Clave_alumno::find($VCA[$x]['idclave_alumno']);
    
                        $clave = DB::select('
                        SELECT UCASE(CONCAT(LEFT(?,2), RIGHT(?,2),?,?,"'.($x+1).'_",LEFT(?,1),LEFT(?,4))) AS CLAVE FROM encuestas INNER JOIN grupos ON grupos.idencuesta = encuestas.idencuesta WHERE grupos.idgrupos = ? LIMIT 1',
                        [$encuesta->nombre_institucion, $encuesta->nombre_institucion, $GR, $GU,$encuesta->turno, $encuesta->fecha_final, $ID]);
                        $clave = json_decode(json_encode($clave), true);
                        $clave = $clave[0]['CLAVE'];
        
                        $CA->clave = $clave;
                        $CA->estado_clave = "habil";
                        $CA->idgrupo = $ID;
        
                        $CA->save();
                    $x++;
                }
            }
        }

        $claves = DB::select('SELECT e.nombre_institucion, g.grado, g.grupo, g.total_alumnos_grupo, ca.clave FROM grupos g INNER JOIN clave_alumnos ca ON ca.idgrupo = g.idgrupos INNER JOIN encuestas e ON e.idencuesta = g.idencuesta WHERE g.idencuesta = ?;', [$id]);
        $nomInstitucion = $encuesta->nombre_institucion;
        $pdf = PDF::loadView('admin.test.genClaves', compact('claves'));
        return $pdf->download($nomInstitucion.'_claves.pdf');
    }

}
