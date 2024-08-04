<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSampah extends Model
{
    use HasFactory;

    protected $table = 'data_sampahs';

    protected $fillable = ['sampah_id', 'kategori', 'jenis', 'foto', 'poin'];

    public function detailSetoran()
    {
        return $this->hasMany(DetailSetoran::class, 'sampah_id', 'sampah_id');
    }

    public function harga()
    {
        return $this->hasOne(HargaSampahUnit::class, 'sampah_id', 'sampah_id');
    }

    public function wastePrices()
    {
        return $this->hasMany(WastePrice::class, 'sampah_id', 'sampah_id');
    }

    public function detailDaurUlang()
    {
        return $this->hasMany(DetailDaurUlang::class, 'sampah_id', 'sampah_id');
    }
}
