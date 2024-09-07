<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatSetoranSampah extends Model
{
    use HasFactory;

    protected $table = 'riwayat_setoran_sampah';

    protected $fillable = ['nasabah_id', 'tanggal_setor', 'jumlah_setoran'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function detailSetoran()
    {
        return $this->hasMany(DetailSetoran::class, 'setoran_id', 'id');
    }
}
