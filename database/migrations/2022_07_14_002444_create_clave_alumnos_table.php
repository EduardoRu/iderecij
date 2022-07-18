<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('clave_alumnos', function (Blueprint $table) {
            $table->id('idclave_alumno');
            $table->string('clave', 45)->nullable();
            $table->string('nombre_alumno', 70)->nullable();
            $table->integer('edad')->nullable();
            $table->string('sexo')->nullable();
            $table->string('estado_clave', 20)->nullable();
            $table->foreignId('idgrupo')
            ->constrained('grupos', 'idgrupos')
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
        Schema::dropIfExists('clave_alumnos');
    }
};
