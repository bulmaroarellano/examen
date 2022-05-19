<?php

namespace Database\Factories;

use App\Models\Respuestas;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RespuestasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Respuestas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idPregunta' => $this->faker->randomNumber,
            'desRespuesta' => $this->faker->text(255),
            'correcta' => $this->faker->boolean,
            'activo' => $this->faker->boolean,
        ];
    }
}
