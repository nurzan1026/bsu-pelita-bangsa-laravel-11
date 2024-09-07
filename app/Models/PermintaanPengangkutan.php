<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanPengangkutan extends Model
{
    use HasFactory;

    protected $table = 'permintaan_pengangkutan';
    protected $fillable = [
        'account_id',
        'account_name',
        'id',
        'sampah',
        'total_berat',
        'total_harga',
        'status',
    ];

    protected $casts = [
        'sampah' => 'array',
    ];

    public function account()
    {
        return $this->belongsTo(BankSampahUnitAccounts::class, 'account_id');
    }
}

