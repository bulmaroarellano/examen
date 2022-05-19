<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Preguntas;
use App\Models\Respuestas;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RespuestasAllPreguntasTest extends TestCase
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
    public function it_gets_respuestas_all_preguntas()
    {
        $respuestas = Respuestas::factory()->create();
        $preguntas = Preguntas::factory()->create();

        $respuestas->allPreguntas()->attach($preguntas);

        $response = $this->getJson(
            route('api.all-respuestas.all-preguntas.index', $respuestas)
        );

        $response->assertOk()->assertSee($preguntas->desPregunta);
    }

    /**
     * @test
     */
    public function it_can_attach_all_preguntas_to_respuestas()
    {
        $respuestas = Respuestas::factory()->create();
        $preguntas = Preguntas::factory()->create();

        $response = $this->postJson(
            route('api.all-respuestas.all-preguntas.store', [
                $respuestas,
                $preguntas,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $respuestas
                ->allPreguntas()
                ->where('tbl_preguntas.id', $preguntas->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_all_preguntas_from_respuestas()
    {
        $respuestas = Respuestas::factory()->create();
        $preguntas = Preguntas::factory()->create();

        $response = $this->deleteJson(
            route('api.all-respuestas.all-preguntas.store', [
                $respuestas,
                $preguntas,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $respuestas
                ->allPreguntas()
                ->where('tbl_preguntas.id', $preguntas->id)
                ->exists()
        );
    }
}
