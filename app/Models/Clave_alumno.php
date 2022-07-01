<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clave_alumno extends Model
{
    use HasFactory;

    /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'idclave_alumno';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clave_alumnos';

    public function grupo(){

        return $this->belongsTo('grupos\clave_alumnos');

    }

    public function result(){

        return $this->hasOne(Resultado::class);

    }


}
