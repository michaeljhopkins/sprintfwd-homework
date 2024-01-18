<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_new_project()
    {
        $this->actingAs(User::factory()->create());
        $this->post('/api/projects', ['name' => 'Test Project']);

        $this->assertNotNull(Project::whereName('Test Project')->first()->id);
    }

    /** @test */
    public function it_can_delete_a_project()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->hasAttached(auth()->user())->create();

        $this->delete('/api/projects/'.$project->id);

        $this->assertNull(Project::find($project->id));
    }

    /** @test */
    public function it_can_update_a_project()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->hasAttached(auth()->user())->create();

        $this->put('/api/projects/'.$project->id, [
            'name' => 'asdf'
        ]);

        $this->assertNotNull(Project::whereName('asdf')->first());
    }

    /** @test */
    public function it_can_add_a_user_to_a_project()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->hasAttached(auth()->user())->create();

        $this->post('/api/projects/'.$project->id.'/users', [
            'user_id' => auth()->id(),
        ]);

        $this->assertTrue($project->fresh()->load('users')->users->contains(function ($u) {
            return $u->id === auth()->id();
        }));
    }

    /** @test */
    public function it_can_remove_a_user_from_a_project()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->hasAttached(auth()->user())->create();

        $project->users()->attach(auth()->id());

        $this->delete('/api/projects/'.$project->id.'/users/'.auth()->id());

        $this->assertFalse($project->fresh()->load('users')->users->doesntContain(function ($u) {
            return $u->id === auth()->id();
        }));
    }
}
