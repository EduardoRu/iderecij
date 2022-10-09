<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuest extends Model
{
    use HasFactory;
     /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'idencuesta';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'encuestas';

    public function grupos(){

        return $this->hasMany(Grupo::class,'idencuesta','idencuesta');

    }

}
