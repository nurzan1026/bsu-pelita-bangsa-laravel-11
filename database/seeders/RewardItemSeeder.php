<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RewardItem;

class RewardItemSeeder extends Seeder
{
    public function run()
    {
        $rewardItems = [
            [
                'name' => 'Sabun Mandi',
                'poin' => 20,
            ],
            [
                'name' => 'Sabun Cuci Piring',
                'poin' => 15,
            ],
            [
                'name' => 'Detergen',
                'poin' => 25,
            ],
            [
                'name' => 'Pasta Gigi',
                'poin' => 10,
            ],
        ];

        foreach ($rewardItems as $item) {
            RewardItem::create($item);
        }
    }
}
