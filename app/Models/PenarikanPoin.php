<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanPoin extends Model
{
    use HasFactory;

    protected $table = 'penarikan_poin'; // Nama tabel sesuai migration
    protected $fillable = [
        'nama', 'tanggal', 'opsi', 'jumlah', 'status',
    ];
}



