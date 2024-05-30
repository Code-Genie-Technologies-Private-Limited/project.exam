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
            'subject_id' => Subject::factory()->create()->id,
            'topic_id' => Topic::factory()->create()->name,
            // 'difficulty_level' => $this->faker,
            'keyword' => $this->faker->sentence,
            'options' => $this->faker->sentence,
            'answer' => $this->faker->sentence,
            'order' => $this->faker->randomfloat(2, 1, 100),
            'status' => $this->faker->boolean,
            'created_by' => User::factory(),
        ];
    }
}
