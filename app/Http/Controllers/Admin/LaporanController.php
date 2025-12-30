<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;          // <- TAMBAH INI
use Maatwebsite\Excel\Facades\Excel;      // <- kalau mau Excel
use App\Exports\LaporanAbsensiExport;     // <- kita bikin sebentar di step 3

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari request
        $tanggal_mulai   = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');
        $kelas           = $request->input('kelas');

        // Query dasar
        $query = Absensi::with('siswa');

        if ($tanggal_mulai) {
            $query->whereDate('tanggal', '>=', $tanggal_mulai);
        }

        if ($tanggal_selesai) {
            $query->whereDate('tanggal', '<=', $tanggal_selesai);
        }

        if ($kelas) {
            $query->whereHas('siswa', function ($q) use ($kelas) {
                $q->where('kelas', $kelas);
            });
        }

        $dataAbsensi = $query->orderBy('tanggal', 'desc')->get();

        // daftar kelas unik buat pilihan di filter
        $daftarKelas = Siswa::select('kelas')
            ->whereNotNull('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        return view('admin.generateLaporan.index', [
            'dataAbsensi'     => $dataAbsensi,
            'daftarKelas'     => $daftarKelas,
            'tanggal_mulai'   => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'kelas'           => $kelas,
        ]);
    }

    public function exportPdf(Request $request)
    {
        // pakai filter yang sama dengan index
        $tanggal_mulai   = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');
        $kelas           = $request->input('kelas');

        $query = Absensi::with('siswa');

        if ($tanggal_mulai) {
            $query->whereDate('tanggal', '>=', $tanggal_mulai);
        }

        if ($tanggal_selesai) {
            $query->whereDate('tanggal', '<=', $tanggal_selesai);
        }

        if ($kelas) {
            $query->whereHas('siswa', function ($q) use ($kelas) {
                $q->where('kelas', $kelas);
            });
        }

        $dataAbsensi = $query->orderBy('tanggal', 'asc')->get();

        $pdf = Pdf::loadView('admin.generateLaporan.pdf', [
            'dataAbsensi'     => $dataAbsensi,
            'tanggal_mulai'   => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'kelas'           => $kelas,
        ])->setPaper('A4', 'portrait');

        $namaFile = 'laporan-absensi-' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($namaFile);
    }

    public function exportExcel(Request $request)
    {
        $tanggal_mulai   = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');
        $kelas           = $request->input('kelas');

        // lempar ke export class, biar rapi
        $export = new LaporanAbsensiExport($tanggal_mulai, $tanggal_selesai, $kelas);

        $namaFile = 'laporan-absensi-' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download($export, $namaFile);
    }
}
