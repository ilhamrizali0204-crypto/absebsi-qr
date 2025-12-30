<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'status',
        'keterangan',
        'sumber',
    ];

   
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    
    public function scopeLatestActivity($query, $limit = 5)
    {
        return $query->with('siswa')
                     ->latest()
                     ->limit($limit);
    }

  
    public function getWaktuDashboardAttribute()
    {
        return $this->created_at
            ? $this->created_at->translatedFormat('d M H:i')
            : '-';
    }
}
