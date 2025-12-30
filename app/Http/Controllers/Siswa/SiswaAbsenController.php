<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class SiswaAbsenController extends Controller
{
    // halaman scan
    public function scanPage()
    {
        return view('siswa.scan-presensi');
    }

    // dipanggil dari QR
    public function handleScan(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->siswa) {
            abort(403, 'Akun siswa tidak valid');
        }

        $siswaId = $user->siswa->id;
        $tanggal = now()->toDateString();
        $jam     = now()->format('H:i:s');

        // cek sudah absen atau belum
        $sudahAbsen = Absensi::where('siswa_id', $siswaId)
            ->where('tanggal', $tanggal)
            ->exists();

        if ($sudahAbsen) {
            return view('siswa.absen-result', [
                'status'  => 'warning',
                'message' => 'Kamu sudah melakukan presensi hari ini.',
            ]);
        }

        // simpan absensi
        Absensi::create([
            'siswa_id' => $siswaId,
            'tanggal'  => $tanggal,
            'jam_absen'=> $jam,       // 🔥 INI KUNCI UTAMA
            'status'   => 'H',
            'sumber'   => 'mandiri',
        ]);

        return view('siswa.absen-result', [
            'status'  => 'success',
            'message' => 'Presensi berhasil dicatat pada ' . $jam,
        ]);
    }

    // riwayat absensi siswa
    public function riwayat()
    {
        $siswaId = Auth::user()->siswa->id;

        $riwayat = Absensi::where('siswa_id', $siswaId)
            ->orderBy('tanggal', 'desc')
            ->limit(30)
            ->get();

        return view('siswa.riwayat-absen', compact('riwayat'));
    }
}
