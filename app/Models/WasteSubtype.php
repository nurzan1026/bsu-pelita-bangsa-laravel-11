<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteSubtype extends Model
{
    use HasFactory;

    protected $fillable = ['waste_type_id', 'name'];

    public function type()
    {
        return $this->belongsTo(WasteType::class);
    }
}
