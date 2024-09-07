<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSampah extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'kategori', 'jenis', 'foto', 'poin', 'info'];

    public function getSaleUnitAttribute()
    {
        if ($this->kategori === 'Minyak') {
            return 'Sampah Ini di Jual dalam bentuk Per Liter';
        }
        return 'Sampah ini di Jual dalam bentuk Per Kilo (Kg)';
    }

    public function wastePrices()
    {
        return $this->hasMany(WastePrice::class, 'waste_id', 'id');
    }

    public function harga()
    {
        return $this->hasOne(HargaSampahUnit::class, 'waste_id', 'id');
    }

    public function detailSetoran()
    {
        return $this->hasMany(DetailSetoran::class, 'sampah_id', 'id');
    }

    public function detailDaurUlang()
    {
        return $this->hasMany(DetailDaurUlang::class, 'sampah_id', 'id');
    }
}
