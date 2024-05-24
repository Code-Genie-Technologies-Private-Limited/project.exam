<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'course_id' => Course::class(),
            'status' => $this->faker->boolean,
            'order' => $this->faker->randomFloat(2, 1, 100),
            'created_by' => User::factory(),
        ];
    }
}
