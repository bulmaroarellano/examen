<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Examenes;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExamenesControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_examenes()
    {
        $allExamenes = Examenes::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-examenes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_examenes.index')
            ->assertViewHas('allExamenes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_examenes()
    {
        $response = $this->get(route('all-examenes.create'));

        $response->assertOk()->assertViewIs('app.all_examenes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_examenes()
    {
        $data = Examenes::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-examenes.store'), $data);

        $this->assertDatabaseHas('tblexamenes', $data);

        $examenes = Examenes::latest('id')->first();

        $response->assertRedirect(route('all-examenes.edit', $examenes));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_examenes()
    {
        $examenes = Examenes::factory()->create();

        $response = $this->get(route('all-examenes.show', $examenes));

        $response
            ->assertOk()
            ->assertViewIs('app.all_examenes.show')
            ->assertViewHas('examenes');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_examenes()
    {
        $examenes = Examenes::factory()->create();

        $response = $this->get(route('all-examenes.edit', $examenes));

        $response
            ->assertOk()
            ->assertViewIs('app.all_examenes.edit')
            ->assertViewHas('examenes');
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

        $response = $this->put(route('all-examenes.update', $examenes), $data);

        $data['id'] = $examenes->id;

        $this->assertDatabaseHas('tblexamenes', $data);

        $response->assertRedirect(route('all-examenes.edit', $examenes));
    }

    /**
     * @test
     */
    public function it_deletes_the_examenes()
    {
        $examenes = Examenes::factory()->create();

        $response = $this->delete(route('all-examenes.destroy', $examenes));

        $response->assertRedirect(route('all-examenes.index'));

        $this->assertModelMissing($examenes);
    }
}
