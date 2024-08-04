<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaSampahUnit extends Model
{
    use HasFactory;

    protected $table = 'harga_sampah_units';
    protected $fillable = ['sampah_id', 'harga'];

    public function dataSampah()
    {
        return $this->belongsTo(DataSampah::class, 'sampah_id', 'sampah_id');
    }
}
