<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GeneralKnowledge>
 */
class GeneralKnowledgeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::query()->where('status', 1)->inRandomOrder()->value('id'),
            'type' => $this->faker->randomElement(['static', 'current affairs']),
            'description' => $this->faker->paragraph,
            'order' => $this->faker->inrandomFloat(2, 1, 100),
            'status' => $this->faker->boolean,
        ];
    }
}
