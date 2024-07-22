<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_id' => Subject::query()->where('status', 1)->inRandomOrder()->value('id'),
            'topic_id' => Topic::query()->where('status', 1)->inRandomOrder()->value('id'),
            'difficulty_level' => $this->faker->randomElement(['easy', 'medium', 'hard']),
            'name' => $this->faker->sentence,
            'order' => $this->faker->randomFloat(2, 1, 100),
            'status' => $this->faker->boolean,
            'created_by' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
