<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Respuestas;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RespuestasTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_all_respuestas_list()
    {
        $allRespuestas = Respuestas::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-respuestas.index'));

        $response->assertOk()->assertSee($allRespuestas[0]->desRespuesta);
    }

    /**
     * @test
     */
    public function it_stores_the_respuestas()
    {
        $data = Respuestas::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-respuestas.store'), $data);

        unset($data['idPregunta']);

        $this->assertDatabaseHas('tblrespuestas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_respuestas()
    {
        $respuestas = Respuestas::factory()->create();

        $data = [
            'idPregunta' => $this->faker->randomNumber,
            'desRespuesta' => $this->faker->text(255),
            'correcta' => $this->faker->boolean,
            'activo' => $this->faker->boolean,
        ];

        $response = $this->putJson(
            route('api.all-respuestas.update', $respuestas),
            $data
        );

        unset($data['idPregunta']);

        $data['id'] = $respuestas->id;

        $this->assertDatabaseHas('tblrespuestas', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_respuestas()
    {
        $respuestas = Respuestas::factory()->create();

        $response = $this->deleteJson(
            route('api.all-respuestas.destroy', $respuestas)
        );

        $this->assertSoftDeleted($respuestas);

        $response->assertNoContent();
    }
}
