<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\HargaSampahUnit;
use App\Models\DataSampah;

class HargaSampahFactory extends Factory
{
    protected $model = HargaSampahUnit::class;

    public function definition(): array
    {
        return [
            'sampah_id' => DataSampah::factory()->create()->sampah_id,
            'harga' => $this->faker->numberBetween(500, 100000)
        ];
    }
}
