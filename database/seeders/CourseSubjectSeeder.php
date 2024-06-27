<?php

namespace Database\Seeders;

use App\Models\CourseSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseSubject::factory()->count(198)->create();
    }
}
