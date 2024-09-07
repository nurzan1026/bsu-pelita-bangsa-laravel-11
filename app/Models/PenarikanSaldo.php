<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanSaldo extends Model
{
    use HasFactory;

    protected $fillable = ['nasabah_id', 'tanggal', 'jumlah', 'status'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
