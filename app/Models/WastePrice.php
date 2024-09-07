<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WastePrice extends Model
{
    use HasFactory;

    protected $fillable = ['waste_id', 'price'];

    public function waste()
    {
        return $this->belongsTo(DataSampah::class, 'waste_id', 'id');
    }
}
