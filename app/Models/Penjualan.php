<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal_jual', 'pembeli', 'total_harga'];

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    public function getTotalHargaAttribute()
    {
        return $this->detailPenjualans->sum(function ($detail) {
            return $detail->berat * ($detail->sampah->wastePrices->first()->harga ?? 0);
        });
    }
}
