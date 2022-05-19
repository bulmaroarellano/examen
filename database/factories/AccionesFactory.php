<?php

namespace Database\Factories;

use App\Models\Acciones;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccionesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Acciones::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'desAccion' => $this->faker->text(255),
            'activo' => $this->faker->boolean,
            'bitacora_id' => \App\Models\Bitacora::factory(),
        ];
    }
}
