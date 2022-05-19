<?php

namespace Database\Factories;

use App\Models\Preguntas;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreguntasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Preguntas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'desPregunta' => $this->faker->text(255),
            'activo' => $this->faker->boolean,
            'idExamen' => \App\Models\Examenes::factory(),
        ];
    }
}
