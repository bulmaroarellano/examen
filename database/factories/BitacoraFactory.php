<?php

namespace Database\Factories;

use App\Models\Bitacora;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BitacoraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bitacora::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idAccion' => $this->faker->randomNumber,
            'observaciones' => $this->faker->text,
            'idUsuario' => \App\Models\User::factory(),
        ];
    }
}
