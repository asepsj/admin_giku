<?php

namespace App\Models;

use App\Models\User;
use App\Models\KlinikPhotos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Klinik extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_klinik',
        'alamat_klinik',
        'deskripsi_klinik',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(KlinikPhotos::class);
    }
}
