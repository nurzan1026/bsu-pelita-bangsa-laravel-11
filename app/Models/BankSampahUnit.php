<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankSampahUnit extends Model
{
    use HasFactory;

    protected $table = 'bank_sampah_unit_accounts'; // Nama tabel di database
    protected $fillable = ['name', 'email', 'password', 'address', 'phone'];
    protected $hidden = ['password', 'remember_token'];
}
