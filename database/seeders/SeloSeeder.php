<?php

namespace Database\Seeders;

use App\Models\Selo;
use Illuminate\Database\Seeder;

class SeloSeeder extends Seeder
{
    public function run(): void
    {
        // Criar 100 selos
        for ($i = 1; $i <= 100; $i++) {
            Selo::create(['numero' => $i]);
        }
    }
}
