<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubcourseFactory extends Factory
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
            'course_id' => Course::factory(),
            'status' => $this->faker->boolean,
            'order' => $this->faker->randomFloat(2, 1, 100),
            'created_by' => User::factory(),
        ];
    }
}
