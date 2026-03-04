<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userA = User::factory()->create([
                    'name' => 'User A',
                    'email' => 'usera@example.com',
                    'password' => bcrypt('password')
                ]);

        $userB = User::factory()->create([
                    'name' => 'User B',
                    'email' => 'userb@example.com',
                    'password' => bcrypt('password')
                ]);

        $this->seedUserProjects($userA);
        $this->seedUserProjects($userB);
    }

    private function seedUserProjects(User $user)
    {
        Project::factory()
            ->count(2)
            ->for($user)
            ->create()
            ->each( function ($project) {

                Task::factory()
                    ->count(3)
                    ->pending()
                    ->for($project)
                    ->create();

                Task::factory()
                    ->count(2)
                    ->done()
                    ->for($project)
                    ->create();
            });
    }
}
