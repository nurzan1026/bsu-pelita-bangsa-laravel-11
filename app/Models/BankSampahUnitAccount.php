<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\UnitResetPasswordNotification;

class BankSampahUnitAccount extends Authenticatable
{
    use Notifiable;

    protected $guard = 'bank_sampah_unit_accounts';

    protected $fillable = [
        'name', 'email', 'password', 'address', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UnitResetPasswordNotification($token));
    }
}

