<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'branch_code' => $this->faker->unique()->numberBetween(1000, 9999),
            'name' => $this->faker->company,
            'start_date' => $this->faker->date,
            'status' => $this->faker->boolean,
            'order' => $this->faker->randomFloat(2, 0, 99.99),
            'created_by' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}