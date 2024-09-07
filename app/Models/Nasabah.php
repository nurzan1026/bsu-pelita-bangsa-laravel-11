<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Nasabah extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'nasabahs';

    protected $fillable = ['nama', 'nomor_induk', 'username', 'email', 'password', 'alamat', 'foto'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setoran()
{
    return $this->hasMany(Setoran::class, 'nasabah_id', 'id');
}

    public function penarikanPoin()
    {
        return $this->hasMany(PenarikanPoin::class);
    }

    public function penarikanSaldo()
    {
        return $this->hasMany(PenarikanSaldo::class);
    }
}
