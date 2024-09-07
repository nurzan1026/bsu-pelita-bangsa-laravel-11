<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanPoin extends Model
{
    use HasFactory;

    protected $fillable = ['nasabah_id', 'reward_item_id', 'tanggal', 'status'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function rewardItem()
    {
        return $this->belongsTo(RewardItem::class, 'reward_item_id');
    }
}
