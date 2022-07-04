<?php

namespace App\Exports;

use App\Models\Clave_alumno;
use Maatwebsite\Excel\Concerns\FromCollection;

class Consultas implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $DATOS = Clave_alumno::where('sexo', '<>', 'null')->get();

        return Clave_alumno::all();
    }
}
