<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tasks;
use App\Models\TaskList;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tasks>
 */
class TasksFactory extends Factory
{
    protected $model = Tasks::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tasklist = TaskList::factory()->create();

        return [
            'title' => $this->faker->name,
            'status' => 0,
            'user_id' => $tasklist['user_id'],
            'list_id' => $tasklist['id'],

        ];
    }
}
