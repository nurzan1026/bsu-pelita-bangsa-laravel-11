<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nasabah>
 */
class NasabahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nomor_induk' => $this->faker->unique()->numerify('##################'),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'alamat' => $this->faker->address(),
            'foto' => $this->faker->imageUrl(200, 200, 'people', true, 'Faker'),
        ];
    }
}
