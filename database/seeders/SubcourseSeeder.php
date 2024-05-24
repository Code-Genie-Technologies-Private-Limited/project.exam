<?php

namespace Database\Seeders;

use App\Models\Subcourse;
use Illuminate\Database\Seeder;

class SubcourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcourse::factory()->count(10)->create();
    }
}
