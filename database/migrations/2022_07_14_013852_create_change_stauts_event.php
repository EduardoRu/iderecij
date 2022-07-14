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
        DB::statement('DROP EVENT IF EXISTS `change_status`');

        DB::statement('
        CREATE EVENT change_status ON SCHEDULE EVERY 24 HOUR
        DO 
            UPDATE clave_alumno c INNER JOIN grupos g ON c.idgrupo = g.idgrupos INNER JOIN encuesta e ON g.idencuesta = e.idencuesta
            SET c.estado_clave = (
                CASE 
                WHEN e.fecha_final > CURDATE() AND c.estado_clave = "Inhabil"
                    THEN "Inhabil"
                WHEN e.fecha_final < CURDATE() AND c.estado_clave = "Habil"
                    THEN "Inhabil"
                ELSE c.estado_clave
            END)
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP EVENT IF EXISTS `change_status`');
    }
};
