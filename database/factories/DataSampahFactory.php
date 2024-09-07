<?php

// database/factories/SampahFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DataSampah;

class DataSampahFactory extends Factory
{
    protected $model = DataSampah::class;

    public function definition(): array
    {
        return [
            'sampah_id' => $this->faker->unique()->numerify('S###'),
            'kategori' => $this->faker->randomElement(['Plastik', 'Logam', 'Kertas', 'Botol Kaca', 'Minyak']),
            'jenis' => $this->faker->words(3, true),
            'foto' => $this->faker->imageUrl(200, 200, 'nature', true, 'Faker'),
            'poin' => $this->faker->numberBetween(1, 10),
        ];
    }
}
