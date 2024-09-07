<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampahDetail extends Model
{
    use HasFactory;

    protected $fillable = ['permintaan_id', 'jenis', 'berat'];

    public function permintaan()
    {
        return $this->belongsTo(PermintaanPengangkutan::class, 'permintaan_id');
    }
}
