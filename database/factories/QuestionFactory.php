<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject_id' => Subject::factory(),
            'topic_id' => Topic::factory(),
            'difficulty_level' => $this->faker->sentence,
            'keyword' => $this->faker->sentence,
            'options' => $this->faker->sentence,
            'answer' => $this->faker->sentence,
            'order' => $this->faker->randomFloat(2, 1, 100),
            'status' => $this->faker->boolean,
            'created' => User::factory()
        ];
    }
}
