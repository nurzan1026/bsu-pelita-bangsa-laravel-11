<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengelolahSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengelolahs')->insert([
            ['name' => 'Pengelolah 1', 'address' => 'Alamat 1', 'phone' => '08123456789'],
            ['name' => 'Pengelolah 2', 'address' => 'Alamat 2', 'phone' => '08123456780'],
            ['name' => 'Pengelolah 3', 'address' => 'Alamat 3', 'phone' => '08123456781'],
        ]);
    }
}
