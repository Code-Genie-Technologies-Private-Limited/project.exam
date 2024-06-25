<?php

namespace Database\Seeders;

use App\Models\SubCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCourse::factory()->count(201)->create();
    }
}
