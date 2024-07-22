<?php

namespace Database\Seeders;

use App\Models\GeneralKnowledge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralKnowledgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GeneralKnowledge::factory()->count(198)->create();
    }
}
