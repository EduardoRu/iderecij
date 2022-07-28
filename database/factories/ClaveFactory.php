<?php

namespace Database\Factories;

use App\Models\Clave_alumno;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Clave_alumno::class;
    
    public function definition()
    {
        return [
            //
        ];
    }
}
