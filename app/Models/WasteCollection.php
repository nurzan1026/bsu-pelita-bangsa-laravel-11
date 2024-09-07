<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteCollection extends Model
{
    use HasFactory;

    protected $fillable = ['waste_type_id', 'amount', 'collected_at', 'pengelolah_id'];
}
