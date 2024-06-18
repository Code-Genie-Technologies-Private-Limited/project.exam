<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseSubject>
 */
class CourseSubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => $this->faker->randomFloat(2, 1, 100),
            'subject_id' => $this->faker->randomFloat(2, 1, 100),
            'status' => $this->faker->boolean,
            'created_by' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
