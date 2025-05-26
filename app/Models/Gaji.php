<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Gaji extends Model
{
    protected $table = 'gajis';

    protected $fillable = [
        'user_id',
        'bulan',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'total_gaji',
        'status',
    ];

    // Relasi ke model User
    public function user()
    
    {
    return $this->belongsTo(User::class);
    }
}
