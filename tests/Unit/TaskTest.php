<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user can add task to own project
     */
    public function test_user_can_add_task_to_own_project()
    {
        $user = User::factory()->create();

        $project = Project::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        $response = $this->post("/projects/{$project->id}/tasks", [
            'title' => 'Test Task 01'
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task 01',
            'project_id' => $project->id
        ]);

        $response->assertRedirect("/projects/{$project->id}");
    }

    public function test_user_cannot_add_task_to_another_users_project()
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $projectB = Project::factory()->create([
            'user_id' => $userB->id,
        ]);

        $this->actingAs($userA);

        $response = $this->post("/projects/{$projectB->id}/tasks", [
            'title' => 'Hacked Task'
        ]);

        $response->assertStatus(403);
    }
}
