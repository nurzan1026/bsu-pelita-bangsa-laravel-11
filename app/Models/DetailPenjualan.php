<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $fillable = ['penjualan_id', 'sampah_id', 'berat'];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function sampah()
    {
        return $this->belongsTo(DataSampah::class, 'sampah_id', 'sampah_id');
    }
}
