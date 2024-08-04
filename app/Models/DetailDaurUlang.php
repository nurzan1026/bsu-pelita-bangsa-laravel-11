<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDaurUlang extends Model
{
    use HasFactory;

    protected $fillable = ['daur_ulang_id', 'sampah_id', 'berat'];

    public function daurUlang()
    {
        return $this->belongsTo(DaurUlang::class, 'daur_ulang_id', 'id');
    }

    public function sampah()
    {
        return $this->belongsTo(DataSampah::class, 'sampah_id', 'id');
    }
}
