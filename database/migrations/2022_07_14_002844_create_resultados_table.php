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
        Schema::create('resultados', function (Blueprint $table) {
            $table->id('idresultado');
            $table->integer('salud_mental');
            $table->integer('sistema_familiar');
            $table->integer('presion_padres');
            $table->integer('disp_sustancias_expect_consumo');
            $table->json('persepcion_riesgo')->nullable();
            $table->integer('desempeno_escolar');
            $table->integer('violencia');
            $table->integer('riesgo_inicio_incremento_consumo');
            $table->json('consumo_sustancias')->nullable();
            $table->integer('participacion_acciones_preventivas');
            $table->integer('IVG')->nullable();
            $table->foreignId('idclave_alumno')
            ->constrained('clave_alumnos', 'idclave_alumno')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultados');
    }
};
