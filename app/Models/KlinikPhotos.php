<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlinikPhotos extends Model
{
    use HasFactory;

    protected $fillable = [
        'klinik_id', 'photo_path'
    ];

    public function klinik()
    {
        return $this->belongsTo(Klinik::class);
    }
}
