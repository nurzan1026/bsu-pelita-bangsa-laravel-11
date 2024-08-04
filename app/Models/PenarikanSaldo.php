<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanSaldo extends Model
{
    use HasFactory;

    protected $table = 'penarikan_saldo'; // Pastikan nama tabel sesuai dengan migration
    protected $fillable = [
        'tanggal',
        'jumlah',
        'status',
    ];
}
