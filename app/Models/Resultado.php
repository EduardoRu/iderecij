<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;
     /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'idresultado';

    public function claveAlumno(){

        return $this->hasOne(Clave_alumno::class);

    }
}
