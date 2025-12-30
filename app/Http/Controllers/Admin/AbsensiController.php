<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // TAMPIL LIST ABSENSI + FILTER
    public function index(Request $request)
{
    $tanggal = $request->input('tanggal', date('Y-m-d'));
    $kelas   = $request->input('kelas');

    // ambil semua kelas unik
    $listKelas = Siswa::select('kelas')->distinct()->orderBy('kelas')->pluck('kelas');

    // query siswa
    $querySiswa = Siswa::query();

    if ($kelas) {
        $querySiswa->where('kelas', $kelas);
    }

    $siswas = $querySiswa->orderBy('kelas')->orderBy('nama')->get();

    // ambil absensi untuk tanggal tsb
    $absensi = Absensi::where('tanggal', $tanggal)->get()->keyBy('siswa_id');
   

    return view('admin.data-absensi.index', compact('siswas', 'absensi', 'tanggal', 'kelas', 'listKelas'));
}

    // FORM INPUT / UPDATE ABSENSI PER SISWA (nanti kita bisa modif)
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal'  => 'required|date',
            'status'   => 'required|in:H,S,I,A',
        ]);

        // updateOrCreate: kalau sudah ada absensi hari itu, diupdate aja
        Absensi::updateOrCreate(
            [
                'siswa_id' => $request->siswa_id,
                'tanggal'  => $request->tanggal,
            ],
            [
                'status'     => $request->status,
                'keterangan' => $request->keterangan,
                'sumber'     => 'admin',   
            ]
        );

        return back()->with('success', 'Absensi berhasil disimpan.');
    }
}
