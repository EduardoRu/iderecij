<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;
use App\Models\Clave_alumno;
use App\Models\Encuest;
use App\Models\Grupo;
use App\Models\Resultado;

class UserTest extends TestCase
{
    public function test_example_auth()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/programarEncuesta');

        $response->assertStatus(200);
    }

    /*
    public function test_example__encuesta_grupo_clave(){
        $encuesta = Encuest::factory()->create([
            'idencuesta' => 30,
            'nombre_institucion' => 'UTZAC',
            'fecha_inicio' => '2022-07-25',
            'fecha_final' => '2022-07-30',
            'total_grupos' => 'null',
            'total_alumnos_escuela' => 0
        ]);
        $grupo = Grupo::factory()->create([
            'idgrupos' => 30,
            'grado' => 1,
            'grupo' => 'B',
            'total_alumnos_grupo' => 30,
            'idencuesta' => 30
        ]);
        $clave = Clave_alumno::factory()->create([
            'idclave_alumno' => 300,
            'clave' => 'ACIJPRUEBA3',
            'idgrupo' => 30
        ]);
        $this->assertDatabaseHas('encuestas', ['nombre_institucion' => 'UTZAC']);
        $this->assertDatabaseHas('grupos', ['idencuesta' => 30]);
        $this->assertDatabaseHas('clave_alumnos', ['clave' => 'ACIJPRUEBA1']);
    }
    */
    /*
    public function test_example_exist_encuesta_grupo_clave(){
        $this->assertDatabaseHas('encuestas', ['idencuesta' => 30]);
        $this->assertDatabaseHas('grupos', ['idencuesta' => 30]);
        $this->assertDatabaseHas('clave_alumnos', ['idclave_alumno' => 300]);
    }
    */
    /*

    public function test_example_student_join_test(){
        $clave = 'ACIJPRUEBA3';

        $view = $this->view('userClave', ['clave' => $clave]);
 
        $view->assertSee('Ingresar');
    }
    */

    public function test_example_create_resultado(){
        $resultado = Resultado::factory()->create([
            'salud_mental' => 1,
            'sistema_familiar' => 2,
            'presion_padres' => 2,
            'disp_sustancias_expect_consumo' => 1,
            'persepcion_riesgo' => '{"Alcohol": 2, "Tabaco": 2, "Otras_drogas": 2, "total": 6}',
            'desempeno_escolar' => 2,
            'violencia' => 1,
            'riesgo_inicio_incremento_consumo' => 2,
            'consumo_sustancias' => '{"Alcohol": 1, "Tabaco": 0, "Otras_drogas": 0, "total": 1}',
            'participacion_acciones_preventivas' => 1,
            'idclave_alumno' => 300
        ]);
        $this->assertDatabaseHas('resultados', ['idclave_alumno' => 300]);
    }

}
