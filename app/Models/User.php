<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'siswa_id',   // ← WAJIB TAMBAH INI
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi BENAR
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
