<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $fillable = ['nasabah_id', 'tanggal_setor'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function detailSetoran()
    {
        return $this->hasMany(DetailSetoran::class);
    }
}
