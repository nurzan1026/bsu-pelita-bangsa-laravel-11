<?php

// App\Models\DetailSetoran.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSetoran extends Model
{
    use HasFactory;

    protected $table = 'detail_setorans';

    protected $fillable = ['setoran_id', 'sampah_id', 'berat', 'poin'];

    public function setoran()
    {
        return $this->belongsTo(Setoran::class);
    }

    public function sampah()
    {
        return $this->belongsTo(DataSampah::class, 'sampah_id', 'sampah_id');
    }
}
