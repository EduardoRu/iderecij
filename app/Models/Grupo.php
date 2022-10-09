<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'idgrupos';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grupos';

    public function encuestas(){

        return $this->belongsTo(Encuest::class, 'idencuesta', 'idencuesta');

    }

    public function claves(){

        return $this->hasMany('clave_alumnos\grupos');

    }
}
