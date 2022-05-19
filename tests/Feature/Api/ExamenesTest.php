<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Examenes;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExamenesTest extends TestCase
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
    public function it_gets_all_examenes_list()
    {
        $allExamenes = Examenes::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-examenes.index'));

        $response->assertOk()->assertSee($allExamenes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_examenes()
    {
        $data = Examenes::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-examenes.store'), $data);

        $this->assertDatabaseHas('tblexamenes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_examenes()
    {
        $examenes = Examenes::factory()->create();

        $user = User::factory()->create();

        $data = [
            'idUsuario' => $this->faker->randomNumber,
            'numPreguntas' => $this->faker->randomNumber(0),
            'idUsuario' => $user->id,
        ];

        $response = $this->putJson(
            route('api.all-examenes.update', $examenes),
            $data
        );

        $data['id'] = $examenes->id;

        $this->assertDatabaseHas('tblexamenes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_examenes()
    {
        $examenes = Examenes::factory()->create();

        $response = $this->deleteJson(
            route('api.all-examenes.destroy', $examenes)
        );

        $this->assertModelMissing($examenes);

        $response->assertNoContent();
    }
}
