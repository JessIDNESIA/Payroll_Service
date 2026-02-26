<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datakaryawan extends Model
{
    protected $table = 'datakaryawans';

    protected $fillable = [
        'nama',
        'nik',
        'email',
        'no_hp',
        'alamat',
        'jabatan',
        'tanggal_masuk',
        'gaji_pokok',
        'status',
    ];
}
