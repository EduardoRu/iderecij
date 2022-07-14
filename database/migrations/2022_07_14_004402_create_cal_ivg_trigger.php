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
        DB::statement(
            '
            CREATE TRIGGER after_insert_sum_avg BEFORE INSERT ON resultados FOR EACH ROW
            BEGIN
                IF NEW.IVG IS NULL THEN
                    SET NEW.IVG = NEW.salud_mental + NEW.sistema_familiar + NEW.presion_padres + NEW.disp_sustancias_expect_consumo + (NEW.persepcion_riesgo->"$.total") + NEW.desempeno_escolar + NEW.violencia + NEW.riesgo_inicio_incremento_consumo + (NEW.consumo_sustancias->"$.total") + NEW.participacion_acciones_preventivas;
                END IF;
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
        DB::statement('DROP TRIGGER `after_insert_sum_avg`');
    }
};
