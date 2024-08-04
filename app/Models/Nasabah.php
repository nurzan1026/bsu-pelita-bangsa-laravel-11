<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $table = 'nasabahs';

    protected $fillable = [
        'nama', 'nomor_induk', 'username', 'email', 'password', 'alamat', 'foto',
    ];

    public function setoran()
    {
        return $this->hasMany(Setoran::class);
    }
}
