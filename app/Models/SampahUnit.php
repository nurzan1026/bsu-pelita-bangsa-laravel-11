<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampahUnit extends Model
{
    use HasFactory;

    protected $table = 'sampah_unit';

    protected $fillable = [
        'account_id',
        'jenis_sampah',
    ];

    public function account()
    {
        return $this->belongsTo(BankSampahUnitAccount::class, 'account_id');
    }
}
