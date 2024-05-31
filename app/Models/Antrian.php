<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pasien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Antrian extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien_id',
        'doctor_id',
        'name_pasien',
        'name_doctor',
        'nombor_antrian',
        'status',
        'tanggal_antrian',
    ];

    // Antrian.php
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

}
