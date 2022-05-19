<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Respuestas;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RespuestasControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_all_respuestas()
    {
        $allRespuestas = Respuestas::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-respuestas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_respuestas.index')
            ->assertViewHas('allRespuestas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_respuestas()
    {
        $response = $this->get(route('all-respuestas.create'));

        $response->assertOk()->assertViewIs('app.all_respuestas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_respuestas()
    {
        $data = Respuestas::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-respuestas.store'), $data);

        unset($data['idPregunta']);

        $this->assertDatabaseHas('tblrespuestas', $data);

        $respuestas = Respuestas::latest('id')->first();

        $response->assertRedirect(route('all-respuestas.edit', $respuestas));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_respuestas()
    {
        $respuestas = Respuestas::factory()->create();

        $response = $this->get(route('all-respuestas.show', $respuestas));

        $response
            ->assertOk()
            ->assertViewIs('app.all_respuestas.show')
            ->assertViewHas('respuestas');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_respuestas()
    {
        $respuestas = Respuestas::factory()->create();

        $response = $this->get(route('all-respuestas.edit', $respuestas));

        $response
            ->assertOk()
            ->assertViewIs('app.all_respuestas.edit')
            ->assertViewHas('respuestas');
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

        $response = $this->put(
            route('all-respuestas.update', $respuestas),
            $data
        );

        unset($data['idPregunta']);

        $data['id'] = $respuestas->id;

        $this->assertDatabaseHas('tblrespuestas', $data);

        $response->assertRedirect(route('all-respuestas.edit', $respuestas));
    }

    /**
     * @test
     */
    public function it_deletes_the_respuestas()
    {
        $respuestas = Respuestas::factory()->create();

        $response = $this->delete(route('all-respuestas.destroy', $respuestas));

        $response->assertRedirect(route('all-respuestas.index'));

        $this->assertSoftDeleted($respuestas);
    }
}
