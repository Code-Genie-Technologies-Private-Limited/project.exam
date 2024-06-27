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
            'course_id' => Course::query()->where('status', 1)->inRandomorder()->value('id'),
            'subject_id' => Subject::query()->where('status', 1)->inRandomorder()->value('id'),
            'created_by' => User::query()->inrandomOrder()->value('id'),
        ];
    }
}
