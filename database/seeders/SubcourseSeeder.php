<?php

namespace Database\Seeders;

use App\Models\Subcourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subcourse::factory()->count(25)->create();
    }
}
