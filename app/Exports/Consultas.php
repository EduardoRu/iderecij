<?php

namespace App\Exports;

use App\Models\Clave_alumno;
use App\Models\Encuest;
use App\Models\Grupo;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Consultas implements FromQuery, WithHeadings, WithColumnWidths, ShouldAutoSize, WithStyles
{

    use Exportable;

    public function __construct(int $idAlumno, int $idGrupo, int $idEscuela)
    {
        $this->idAlumno = $idAlumno;
        $this->idGrupo = $idGrupo;
        $this->idEscuela = $idEscuela;
    }

    public function headings(): array
    {
        if ($this->idAlumno != 0 and $this->idGrupo != 0 and $this->idEscuela != 0) {
            return [
                'Nombre del alumno',
                'Genero',
                'Edad',
                'Grado',
                'Grupo',
                'Institución',
                'Salud mental',
                'Sistema familiar',
                'Presión de pares',
                'Disponibiliad de sustancias y espectativas sobre el consumo',
                'Persepción de riesgo (Tabaco)',
                'Persepción de riesgo (Alcohol)',
                'Persepción de riesgo (Otras drogas)',
                'Persepción de riesgo (Total)',
                'Desempeño escolar',
                'Violencia',
                'Riesgo de inicio o incremento de consumo',
                'Consumo de sustancias (Tabaco)',
                'Consumo de sustancias (Alcohol)',
                'Consumo de sustancias (Otras drogas)',
                'Consumo de sustancias (Total)',
                'Participación en acciones preventivas',
                'IVG'
            ];
        }else if($this->idGrupo != 0 and $this->idEscuela != 0){
            return [
                'Nombre del alumno',
                'Genero',
                'Edad',
                'Grado',
                'Grupo',
                'Institución',
                'Salud mental',
                'Sistema familiar',
                'Presión de pares',
                'Disponibiliad de sustancias y espectativas sobre el consumo',
                'Persepción de riesgo (Tabaco)',
                'Persepción de riesgo (Alcohol)',
                'Persepción de riesgo (Otras drogas)',
                'Persepción de riesgo (Total)',
                'Desempeño escolar',
                'Violencia',
                'Riesgo de inicio o incremento de consumo',
                'Consumo de sustancias (Tabaco)',
                'Consumo de sustancias (Alcohol)',
                'Consumo de sustancias (Otras drogas)',
                'Consumo de sustancias (Total)',
                'Participación en acciones preventivas',
                'IVG'
            ];
        }else if($this->idEscuela != 0){
            return [
                'Grado',
                'Grupo',
                'Institución',
                'Salud mental',
                'Sistema familiar',
                'Presión de pares',
                'Disponibiliad de sustancias y espectativas sobre el consumo',
                'Persepción de riesgo (Tabaco)',
                'Persepción de riesgo (Alcohol)',
                'Persepción de riesgo (Otras drogas)',
                'Persepción de riesgo (Total)',
                'Desempeño escolar',
                'Violencia',
                'Riesgo de inicio o incremento de consumo',
                'Consumo de sustancias (Tabaco)',
                'Consumo de sustancias (Alcohol)',
                'Consumo de sustancias (Otras drogas)',
                'Consumo de sustancias (Total)',
                'Participación en acciones preventivas',
                'IVG'
            ];
        }
    }

    public function columnWidths(): array
    {
        if ($this->idAlumno != 0 and $this->idGrupo != 0 and $this->idEscuela != 0) {
            return [
                'C' => 7,
                'D' => 7,
                'E' => 7,
                'F' => 10,
                'G' => 10,
                'H' => 10,
                'I' => 31,
                'J' => 15,
                'K' => 15,
                'L' => 20,
                'M' => 15,
                'N' => 10,
                'O' => 10,
                'P' => 25,
                'Q' => 20,
                'R' => 20,
                'S' => 20,
                'T' => 20,
                'U' => 20
            ];
        }else if($this->idGrupo != 0 and $this->idEscuela != 0){
            return [
                'C' => 7,
                'D' => 7,
                'E' => 7,
                'F' => 10,
                'G' => 10,
                'H' => 10,
                'I' => 31,
                'J' => 15,
                'K' => 15,
                'L' => 20,
                'M' => 15,
                'N' => 10,
                'O' => 10,
                'P' => 25,
                'Q' => 20,
                'R' => 20,
                'S' => 20,
                'T' => 20,
                'U' => 20
            ];
        }else if($this->idEscuela != 0){
            return [
                'A' => 7,
                'B' => 7,
                'D' => 7,
                'E' => 10,
                'F' => 10,
                'G' => 31,
                'H' => 15,
                'I' => 15,
                'J' => 20,
                'K' => 15,
                'L' => 10,
                'M' => 10,
                'N' => 25,
                'O' => 20,
                'P' => 20,
                'Q' => 20,
                'R' => 20,
                'S' => 20,
                'T' => 20,
            ];
        }
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true], 'alignment' => ['wrapText' => true]],
        ];
    }

    public function query()
    {
        if($this->idAlumno != 0 and $this->idGrupo != 0 and $this->idEscuela != 0){
            return Clave_alumno::query()
            ->select(
                DB::raw('nombre_alumno'),
                DB::raw('sexo'),
                DB::raw('edad'),
                DB::raw('grupos.grado'),
                DB::raw('grupos.grupo'),
                DB::raw('encuestas.nombre_institucion'),
                DB::raw('CAST(resultados.salud_mental AS CHAR)'),
                DB::raw('CAST(resultados.sistema_familiar AS CHAR)'),
                DB::raw('CAST(resultados.presion_padres AS CHAR)'),
                DB::raw('CAST(resultados.disp_sustancias_expect_consumo AS CHAR)'),
                DB::raw('resultados.persepcion_riesgo->"$.Tabaco"'),
                DB::raw('resultados.persepcion_riesgo->"$.Alcohol"'),
                DB::raw('resultados.persepcion_riesgo->"$.Otras_drogas"'),
                DB::raw('resultados.persepcion_riesgo->"$.total"'),
                DB::raw('CAST(resultados.desempeno_escolar AS CHAR)'),
                DB::raw('CAST(resultados.violencia AS CHAR)'),
                DB::raw('CAST(resultados.riesgo_inicio_incremento_consumo AS CHAR)'),
                DB::raw('resultados.consumo_sustancias->"$.Tabaco"'),
                DB::raw('resultados.consumo_sustancias->"$.Alcohol"'),
                DB::raw('resultados.consumo_sustancias->"$.Otras_drogas"'),
                DB::raw('resultados.consumo_sustancias->"$.total"'),
                DB::raw('CAST(resultados.participacion_acciones_preventivas AS CHAR)'),
                DB::raw('CAST(resultados.IVG AS CHAR)'))
            ->join('grupos', 'clave_alumnos.idgrupo', '=', 'grupos.idgrupos')
            ->join('encuestas', 'grupos.idencuesta', '=', 'encuestas.idencuesta')
            ->join('resultados', 'clave_alumnos.idclave_alumno', '=', 'resultados.idclave_alumno')
            ->where('clave_alumnos.idclave_alumno', $this->idAlumno);

        }else if($this->idGrupo != 0 and $this->idEscuela != 0){
            return Grupo::query()
            ->select(
                DB::raw('nombre_alumno'),
                DB::raw('sexo'),
                DB::raw('edad'),
                DB::raw('grupos.grado'),
                DB::raw('grupos.grupo'),
                DB::raw('encuestas.nombre_institucion'),
                DB::raw('CAST(resultados.salud_mental AS CHAR)'),
                DB::raw('CAST(resultados.sistema_familiar AS CHAR)'),
                DB::raw('CAST(resultados.presion_padres AS CHAR)'),
                DB::raw('CAST(resultados.disp_sustancias_expect_consumo AS CHAR)'),
                DB::raw('resultados.persepcion_riesgo->"$.Tabaco"'),
                DB::raw('resultados.persepcion_riesgo->"$.Alcohol"'),
                DB::raw('resultados.persepcion_riesgo->"$.Otras_drogas"'),
                DB::raw('resultados.persepcion_riesgo->"$.total"'),
                DB::raw('CAST(resultados.desempeno_escolar AS CHAR)'),
                DB::raw('CAST(resultados.violencia AS CHAR)'),
                DB::raw('CAST(resultados.riesgo_inicio_incremento_consumo AS CHAR)'),
                DB::raw('resultados.consumo_sustancias->"$.Tabaco"'),
                DB::raw('resultados.consumo_sustancias->"$.Alcohol"'),
                DB::raw('resultados.consumo_sustancias->"$.Otras_drogas"'),
                DB::raw('resultados.consumo_sustancias->"$.total"'),
                DB::raw('CAST(resultados.participacion_acciones_preventivas AS CHAR)'),
                DB::raw('CAST(resultados.IVG AS CHAR)'))
            ->join('clave_alumnos', 'grupos.idgrupos', '=', 'clave_alumnos.idgrupo')
            ->join('encuestas', 'grupos.idencuesta', '=', 'encuestas.idencuesta')
            ->join('resultados', 'clave_alumnos.idclave_alumno', '=', 'resultados.idclave_alumno')
            ->where('grupos.idgrupos', $this->idGrupo)
            ->orderByDesc('resultados.IVG');

        }else if($this->idEscuela != 0){
            return Grupo::query()
            ->select(
                DB::raw('grupos.grado'),
                DB::raw('grupos.grupo'),
                DB::raw('encuestas.nombre_institucion'),
                DB::raw('CAST(SUM(resultados.salud_mental) AS CHAR)'), 
                DB::raw('CAST(SUM(resultados.sistema_familiar) AS CHAR)'), 
                DB::raw('CAST(SUM(resultados.presion_padres) AS CHAR)'), 
                DB::raw('CAST(SUM(resultados.disp_sustancias_expect_consumo) AS CHAR)'), 
                DB::raw('SUM(resultados.persepcion_riesgo->"$.total")'),
                DB::raw('SUM(resultados.persepcion_riesgo->"$.Tabaco") '), 
                DB::raw('SUM(resultados.persepcion_riesgo->"$.Alcohol") '), 
                DB::raw('SUM(resultados.persepcion_riesgo->"$.Otras_drogas") '),
                DB::raw('CAST(SUM(resultados.desempeno_escolar) AS CHAR)'), 
                DB::raw('CAST(SUM(resultados.violencia) AS CHAR)'), 
                DB::raw('CAST(SUM(resultados.riesgo_inicio_incremento_consumo) AS CHAR)'),
                DB::raw('SUM(resultados.consumo_sustancias->"$.total")'),
                DB::raw('SUM(resultados.consumo_sustancias->"$.Tabaco")'),
                DB::raw('SUM(resultados.consumo_sustancias->"$.Alcohol")'),
                DB::raw('SUM(resultados.consumo_sustancias->"$.Otras_drogas")'),
                DB::raw('CAST(SUM(resultados.participacion_acciones_preventivas) AS CHAR)'),
                DB::raw('CAST(SUM(resultados.IVG) AS CHAR)'))
            ->join('clave_alumnos', 'grupos.idgrupos', '=', 'clave_alumnos.idgrupo')
            ->join('encuestas', 'grupos.idencuesta', '=', 'encuestas.idencuesta')
            ->join('resultados', 'clave_alumnos.idclave_alumno', '=', 'resultados.idclave_alumno')          
            ->where('grupos.idencuesta', $this->idEscuela)
            ->groupBy('grupos.idgrupos')
            ->orderByDesc('resultados.IVG');
        }
    }
}
