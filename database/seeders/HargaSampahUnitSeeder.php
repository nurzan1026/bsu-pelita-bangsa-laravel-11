<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HargaSampahUnit;

class HargaSampahUnitSeeder extends Seeder
{
    public function run(): void
    {
        $hargaSampahs = [
            ['sampah_id' => 'P01B', 'harga' => 5000],
            ['sampah_id' => 'P02B', 'harga' => 4000],
            ['sampah_id' => 'P03W', 'harga' => 3500],
            ['sampah_id' => 'P04C', 'harga' => 2500],
            ['sampah_id' => 'P05B', 'harga' => 6000],
            ['sampah_id' => 'P06B', 'harga' => 5500],
            ['sampah_id' => 'P07K', 'harga' => 5000],
            ['sampah_id' => 'P08W', 'harga' => 4500],
            ['sampah_id' => 'P09C', 'harga' => 4000],
            ['sampah_id' => 'P10C', 'harga' => 3500],
            ['sampah_id' => 'P11C', 'harga' => 3000],
            ['sampah_id' => 'P12T', 'harga' => 2500],
            ['sampah_id' => 'P13T', 'harga' => 2500],
            ['sampah_id' => 'P14D', 'harga' => 1000],
            ['sampah_id' => 'P15C', 'harga' => 4500],
            ['sampah_id' => 'P16C', 'harga' => 3000],
            ['sampah_id' => 'L01T', 'harga' => 7000],
            ['sampah_id' => 'L02T', 'harga' => 6000],
            ['sampah_id' => 'L03K', 'harga' => 5000],
            ['sampah_id' => 'L04K', 'harga' => 8000],
            ['sampah_id' => 'L05T', 'harga' => 9000],
            ['sampah_id' => 'L06A', 'harga' => 6000],
            ['sampah_id' => 'L07A', 'harga' => 5000],
            ['sampah_id' => 'L08A', 'harga' => 6000],
            ['sampah_id' => 'L09A', 'harga' => 5000],
            ['sampah_id' => 'L10S', 'harga' => 4000],
            ['sampah_id' => 'L11P', 'harga' => 8000],
            ['sampah_id' => 'K01P', 'harga' => 3500],
            ['sampah_id' => 'K02C', 'harga' => 3000],
            ['sampah_id' => 'K03B', 'harga' => 3500],
            ['sampah_id' => 'K04K', 'harga' => 4500],
            ['sampah_id' => 'K05S', 'harga' => 3500],
            ['sampah_id' => 'K06M', 'harga' => 2500],
            ['sampah_id' => 'K07C', 'harga' => 2500],
            ['sampah_id' => 'B01M', 'harga' => 6000],
            ['sampah_id' => 'B02K', 'harga' => 5000],
            ['sampah_id' => 'B03M', 'harga' => 5000],
            ['sampah_id' => 'B04S', 'harga' => 6000],
            ['sampah_id' => 'B05B', 'harga' => 7000],
            ['sampah_id' => 'M01J', 'harga' => 3000],
        ];

        foreach ($hargaSampahs as $hargaSampah) {
            HargaSampahUnit::create($hargaSampah);
        }
    }
}
