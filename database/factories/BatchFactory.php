<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\SubCourse;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Batch>
 */
class BatchFactory extends Factory
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
            'subCourse_id' => SubCourse::query()->where('status', 1)->inRandomOrder()->value('id'),
            'name' => $this->faker->sentence,
            'code' => $this->faker->sentence,
            'order' => $this->faker->randomFloat(2, 1, 100),
            'status' => $this->faker->boolean,
            'created_by' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
