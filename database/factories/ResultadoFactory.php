<?php

namespace Database\Factories;

use App\Models\Resultado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resultado>
 */
class ResultadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Resultado::class;
     
    public function definition()
    {
        return [
            //
        ];
    }
}
