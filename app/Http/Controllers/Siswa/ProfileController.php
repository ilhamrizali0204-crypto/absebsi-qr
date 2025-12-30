<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Absensi;

class ProfileController extends Controller
{
    public function index()
{
    // Ambil user yang sedang login
    $user = auth()->user();

    // Pastikan user memiliki relasi siswa
    if (!$user || !$user->siswa) {
        return back()->with('error', 'Akun ini tidak memiliki data siswa.');
    }

    $siswa = $user->siswa;

    // Ringkasan absensi
    $totalHadir = Absensi::where('siswa_id', $siswa->id)->where('status', 'H')->count();
    $totalIzin  = Absensi::where('siswa_id', $siswa->id)->where('status', 'I')->count();
    $totalSakit = Absensi::where('siswa_id', $siswa->id)->where('status', 'S')->count();
    $totalAlfa  = Absensi::where('siswa_id', $siswa->id)->where('status', 'A')->count();

    return view('siswa.profile', compact(
        'siswa',
        'totalHadir',
        'totalIzin',
        'totalSakit',
        'totalAlfa'
    ));
}
}
