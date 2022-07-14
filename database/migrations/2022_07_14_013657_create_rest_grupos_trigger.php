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
        CREATE TRIGGER grupos_AFTER_DELETE AFTER DELETE ON grupos
        FOR EACH ROW
        BEGIN
            UPDATE encuestas SET total_grupos = (SELECT COUNT(grupos.idgrupos) FROM grupos WHERE grupos.idencuesta = encuestas.idencuesta);
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
        DB::unprepared('DROP TRIGGER grupos_AFTER_DELETE');
    }
};
