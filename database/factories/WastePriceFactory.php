<?php

// database/factories/WastePriceFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WastePrice;
use App\Models\DataSampah;

class WastePriceFactory extends Factory
{
    protected $model = WastePrice::class;

    public function definition(): array
    {
        return [
            'waste_id' => DataSampah::factory()->create()->sampah_id,
            'price' => $this->faker->numberBetween(500, 100000),
        ];
    }
}
