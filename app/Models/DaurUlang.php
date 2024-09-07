<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaurUlang extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal_daur_ulang'];

    public function detailDaurUlangs()
    {
        return $this->hasMany(DetailDaurUlang::class, 'daur_ulang_id', 'id');
    }
}
