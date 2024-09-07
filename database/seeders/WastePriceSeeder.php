<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WastePrice;

class WastePriceSeeder extends Seeder
{
    public function run(): void
    {
        $wastePrices = [
            ['waste_id' => 'P01B', 'price' => '6000'],
            ['waste_id' => 'P02B', 'price' => '5000'],
            ['waste_id' => 'P03W', 'price' => '4000'],
            ['waste_id' => 'P04C', 'price' => '3000'],
            ['waste_id' => 'P05B', 'price' => '7000'],
            ['waste_id' => 'P06B', 'price' => '6500'],
            ['waste_id' => 'P07K', 'price' => '5500'],
            ['waste_id' => 'P08W', 'price' => '5000'],
            ['waste_id' => 'P09C', 'price' => '4500'],
            ['waste_id' => 'P10C', 'price' => '4000'],
            ['waste_id' => 'P11C', 'price' => '3500'],
            ['waste_id' => 'P12T', 'price' => '3000'],
            ['waste_id' => 'P13T', 'price' => '3000'],
            ['waste_id' => 'P14D', 'price' => '2000'],
            ['waste_id' => 'P15C', 'price' => '5000'],
            ['waste_id' => 'P16C', 'price' => '3500'],
            ['waste_id' => 'L01T', 'price' => '8000'],
            ['waste_id' => 'L02T', 'price' => '7000'],
            ['waste_id' => 'L03K', 'price' => '6000'],
            ['waste_id' => 'L04K', 'price' => '9000'],
            ['waste_id' => 'L05T', 'price' => '10000'],
            ['waste_id' => 'L06A', 'price' => '7000'],
            ['waste_id' => 'L07A', 'price' => '6000'],
            ['waste_id' => 'L08A', 'price' => '7000'],
            ['waste_id' => 'L09A', 'price' => '6000'],
            ['waste_id' => 'L10S', 'price' => '5000'],
            ['waste_id' => 'L11P', 'price' => '9000'],
            ['waste_id' => 'K01P', 'price' => '4000'],
            ['waste_id' => 'K02C', 'price' => '3500'],
            ['waste_id' => 'K03B', 'price' => '4000'],
            ['waste_id' => 'K04K', 'price' => '5000'],
            ['waste_id' => 'K05S', 'price' => '4000'],
            ['waste_id' => 'K06M', 'price' => '3000'],
            ['waste_id' => 'K07C', 'price' => '3000'],
            ['waste_id' => 'B01M', 'price' => '7000'],
            ['waste_id' => 'B02K', 'price' => '6000'],
            ['waste_id' => 'B03M', 'price' => '6000'],
            ['waste_id' => 'B04S', 'price' => '7000'],
            ['waste_id' => 'B05B', 'price' => '8000'],
            ['waste_id' => 'M01J', 'price' => '4000'],
        ];

        foreach ($wastePrices as $wastePrice) {
            WastePrice::create($wastePrice);
        }
    }
}
