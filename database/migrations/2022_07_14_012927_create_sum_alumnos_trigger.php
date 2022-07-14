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
        DB::unprepared('
        CREATE TRIGGER grupos_BEFORE_INSERT BEFORE INSERT ON grupos
        FOR EACH ROW
        BEGIN
            UPDATE encuestas SET total_alumnos_escuela = total_alumnos_escuela + NEW.total_alumnos_grupo WHERE idencuesta = NEW.idencuesta;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER grupos_BEFORE_INSERT');
    }
};
