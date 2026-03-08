<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user can create a project
     */
    public function test_user_can_create_a_project()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/projects', [
            'name' => 'Test Project',
        ]);

        $this->assertDatabaseHas('projects', [
            'name' => 'Test Project',
            'user_id' => $user->id,
        ]);

        $response->assertRedirect('/projects');
    }

    public function test_user_cannot_view_another_users_project()
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $projectB = Project::factory()->create([
            'user_id' => $userB->id,
        ]);

        $this->actingAs($userA);

        $response = $this->get("/projects/{$projectB->id}");

        $response->assertStatus(403);
    }
}
