<?php

namespace Database\Seeders;

use App\Models\SubCourse;
use Illuminate\Database\Seeder;

class SubCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCourse::factory()->count(11)->create();
    }
}
