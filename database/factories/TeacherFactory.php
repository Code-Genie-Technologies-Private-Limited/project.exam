<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
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
            'school_id' => School::factory(),
            'mobile_number' => $this->faker->phoneNumber,
            'address' => $this->faker->sentence,
            'order' => $this->faker->randomFloat(2, 1, 100),
            'status' => $this->faker->boolean,
            'created_by' => User::factory(),
        ];
    }
}
