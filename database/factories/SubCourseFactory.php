<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Commands\CreateRole;

class SubCourseFactory extends Factory
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
            'order' => $this->faker->randomfloat(2, 1, 100),
            'created_by' => User::factory()
        ];
    }
}
