<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\question>
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
            'subject_id'=> Subject::query()->inRandomOrder()->value('id'),
            'topic_id'=> Topic::query()->inRandomOrder()->value('id'),
            'difficulty_level'=> $this->faker->sentence,
            'name'=> $this->faker->sentence,
            'status'=> $this->faker->boolean,
            'order'=>$this->faker->randomFloat(2,1,100),
            'created_by'=>User::query()->inRandomOrder()->value('id'),
        ];
    }
}
