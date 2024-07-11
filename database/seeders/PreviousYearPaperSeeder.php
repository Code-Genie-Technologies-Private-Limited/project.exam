<?php

namespace Database\Seeders;

use App\Models\PreviousYearPaper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreviousYearPaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PreviousYearPaper::factory()->count(196)->create();
    }
}
