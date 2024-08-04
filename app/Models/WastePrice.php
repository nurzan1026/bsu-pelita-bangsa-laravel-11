<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WastePrice extends Model
{
    use HasFactory;

    protected $table = 'waste_prices';
    protected $primaryKey = 'id';
    protected $fillable = ['sampah_id', 'harga', 'tanggal'];

    public function waste()
    {
        return $this->belongsTo(DataSampah::class, 'sampah_id', 'sampah_id');
    }
}

