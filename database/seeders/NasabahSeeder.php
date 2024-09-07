<?php

namespace Database\Seeders;

use App\Models\Nasabah;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NasabahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nasabah::factory()->count(10)->create();
    }
}
