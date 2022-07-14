<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            '
            CREATE TRIGGER before_insert_estado_clave BEFORE INSERT ON resultados
            FOR EACH ROW
            BEGIN
                UPDATE clave_alumnos SET estado_clave = "inhabil" WHERE idclave_alumno = NEW.idclave_alumno;
            END
            '
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER before_insert_estado_clave');
    }
};
