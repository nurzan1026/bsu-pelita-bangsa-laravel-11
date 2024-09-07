<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class BankSampahPusatAccount extends Authenticatable
{
    use HasFactory, Notifiable;
    // use CanResetPasswordTrait;

    protected $guard = 'bank_sampah_pusat';

    protected $table = 'bank_sampah_pusat_accounts';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
