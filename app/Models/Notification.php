<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Antrian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'antrian_id',
        // 'from_user_id',
        'pasien_id',
        'title',
        'message',
        'is_read',
    ];

    // public function antrian()
    // {
    //     return $this->belongsTo(Antrian::class);
    // }

    // public function fromUser()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function toPasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}
