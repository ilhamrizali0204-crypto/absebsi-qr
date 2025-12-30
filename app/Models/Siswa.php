<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'nisn',
        'nama',
        'jenis_kelamin',
        'kelas',
        'user_id',
    ];

    public function user()
{
    return $this->hasOne(User::class, 'siswa_id');
}
}
