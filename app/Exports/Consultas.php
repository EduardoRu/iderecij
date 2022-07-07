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
        return [
            'Nombre del alumno',
            'Genero',
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

    public function columnWidths(): array
    {
        return [
            'C' => 6,
            'D' => 6,
            'F' => 10,
            'G' => 10         
        ];
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
                DB::raw('grupos.grado'),
                DB::raw('grupos.grupo'),
                DB::raw('encuestas.nombre_institucion'),
                DB::raw('resultados.salud_mental'),
                DB::raw('resultados.sistema_familiar'),
                DB::raw('resultados.presion_padres'),
                DB::raw('resultados.disp_sustancias_expect_consumo'),
                DB::raw('resultados.persepcion_riesgo->"$.Tabaco"'),
                DB::raw('resultados.persepcion_riesgo->"$.Alcohol"'),
                DB::raw('resultados.persepcion_riesgo->"$.Otras_drogas"'),
                DB::raw('resultados.persepcion_riesgo->"$.total"'),
                DB::raw('resultados.desempeno_escolar'),
                DB::raw('resultados.violencia'),
                DB::raw('resultados.riesgo_inicio_incremento_consumo'),
                DB::raw('resultados.consumo_sustancias->"$.Tabaco"'),
                DB::raw('resultados.consumo_sustancias->"$.Alcohol"'),
                DB::raw('resultados.consumo_sustancias->"$.Otras_drogas"'),
                DB::raw('resultados.consumo_sustancias->"$.total"'),
                DB::raw('resultados.participacion_acciones_preventivas'),
                DB::raw('resultados.IVG'))
            ->join('grupos', 'clave_alumnos.idgrupo', '=', 'grupos.idgrupos')
            ->join('encuestas', 'grupos.idencuesta', '=', 'encuestas.idencuesta')
            ->join('resultados', 'clave_alumnos.idclave_alumno', '=', 'resultados.idclave_alumno')
            ->where('clave_alumnos.idclave_alumno', $this->idAlumno);

        }else if($this->idGrupo != 0 and $this->idEscuela != 0){
            return Grupo::query()->where('idgrupos', $this->idGrupo);
        }else if($this->idEscuela != 0){
            return Encuest::query()->where('idencuesta', $this->idEscuela);
        }
    }
}
