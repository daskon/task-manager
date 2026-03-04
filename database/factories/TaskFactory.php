<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'is_done' => fake()->boolean(),
            'due_date' => fake()->optional()->dateTimeBetween('now', '+1 month'),
        ];
    }

    public function done()
    {
        return $this->state(fn() => [
            'is_done' => true
        ]);
    }

    public function pending()
    {
        return $this->state(fn() => [
            'is_done' => false
        ]);
    }
}
