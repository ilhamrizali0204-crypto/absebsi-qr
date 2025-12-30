<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresensiSetting extends Model
{
    protected $fillable = [
        'aktif',
        'mode',
        'jam_mulai',
        'jam_selesai',
        'token',
    ];
}
