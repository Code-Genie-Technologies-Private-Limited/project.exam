<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCourse>
 */
class SubCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'course_id' => Course::factory(),
            'order' => $this->faker->randomFloat(2, 1, 100),
            'status' => $this->faker->boolean,
            'created_by' => User::factory(),
        ];
    }
}
