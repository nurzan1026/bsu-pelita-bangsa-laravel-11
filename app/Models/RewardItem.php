<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'poin'];

    public function penarikanPoin()
    {
        return $this->hasMany(PenarikanPoin::class);
    }
}
