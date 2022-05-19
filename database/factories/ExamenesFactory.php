<?php

namespace Database\Factories;

use App\Models\Examenes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamenesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Examenes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idUsuario' => $this->faker->randomNumber,
            'numPreguntas' => $this->faker->randomNumber(0),
            'idUsuario' => \App\Models\User::factory(),
        ];
    }
}
