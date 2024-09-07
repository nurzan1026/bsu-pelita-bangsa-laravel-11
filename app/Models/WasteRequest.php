<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengelolah_id',
        'waste_data',
    ];

    protected $casts = [
        'waste_data' => 'array',
    ];
}
