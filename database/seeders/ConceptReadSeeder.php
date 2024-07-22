<?php

namespace Database\Seeders;

use App\Models\ConceptRead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConceptReadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConceptRead::factory()->count(189)->create();
    }
}
