<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();
        $siswa = $user->siswa;

        $today = now()->toDateString();

        // Status absensi hari ini
        $absenHariIni = Absensi::where('siswa_id', $siswa->id)
            ->where('tanggal', $today)
            ->first();

        $statusHariIni = $absenHariIni->status ?? null;

        // Hitung total kehadiran
        $totalHadir = Absensi::where('siswa_id', $siswa->id)->where('status', 'H')->count();
        $totalIzin  = Absensi::where('siswa_id', $siswa->id)->where('status', 'I')->count();
        $totalSakit = Absensi::where('siswa_id', $siswa->id)->where('status', 'S')->count();
        $totalAlfa  = Absensi::where('siswa_id', $siswa->id)->where('status', 'A')->count();

        // Riwayat absensi terbaru (5 terakhir)
        $riwayatAbsensi = Absensi::where('siswa_id', $siswa->id)
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        // 🔔 Ambil 5 pengumuman terbaru untuk dashboard
        $pengumuman = Announcement::latest()->take(5)->get();

        return view('siswa.dashboard', compact(
            'siswa',
            'statusHariIni',
            'totalHadir',
            'totalIzin',
            'totalSakit',
            'totalAlfa',
            'riwayatAbsensi',
            'pengumuman'
        ));
    }
}
