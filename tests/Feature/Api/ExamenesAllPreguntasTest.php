<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Examenes;
use App\Models\Preguntas;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExamenesAllPreguntasTest extends TestCase
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
    public function it_gets_examenes_all_preguntas()
    {
        $examenes = Examenes::factory()->create();
        $allPreguntas = Preguntas::factory()
            ->count(2)
            ->create([
                'idExamen' => $examenes->id,
            ]);

        $response = $this->getJson(
            route('api.all-examenes.all-preguntas.index', $examenes)
        );

        $response->assertOk()->assertSee($allPreguntas[0]->desPregunta);
    }

    /**
     * @test
     */
    public function it_stores_the_examenes_all_preguntas()
    {
        $examenes = Examenes::factory()->create();
        $data = Preguntas::factory()
            ->make([
                'idExamen' => $examenes->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.all-examenes.all-preguntas.store', $examenes),
            $data
        );

        unset($data['idExamen']);

        $this->assertDatabaseHas('tbl_preguntas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $preguntas = Preguntas::latest('id')->first();

        $this->assertEquals($examenes->id, $preguntas->idExamen);
    }
}
