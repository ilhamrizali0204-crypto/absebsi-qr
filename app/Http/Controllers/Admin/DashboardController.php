<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Absensi;
use Carbon\Carbon;  

class DashboardController extends Controller
{
    public function index()
    {
        $aktivitasAbsensi = Absensi::with('siswa')
        ->where('sumber','scan')
        ->latest()
        ->limit(5)
        ->get();
        
        // total kartu kecil
        $totalSiswa = Siswa::count();
        $totalKelas = Siswa::select('kelas')->distinct()->count();
        $totalHadirHariIni = Absensi::whereDate('tanggal', now())
            ->where('status', 'H')
            ->count();

        // DATA CHART 2: jumlah siswa per kelas
        // ==============================
        $perKelas = Siswa::selectRaw('kelas, COUNT(*) as total')
            ->groupBy('kelas')
            ->orderBy('kelas')
            ->get();

        $chartLabels = $perKelas->pluck('kelas');   // ["X-1","X-2",...]
        $chartData   = $perKelas->pluck('total');   // [30, 28, ...]

        // ==============================
        // DATA CHART 1: kehadiran 7 hari terakhir
        // ==============================
        $labelsMingguan = [];
        $dataMingguan   = [];

        // 7 hari ke belakang (termasuk hari ini)
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::today()->subDays($i);

            // label: Sen, Sel, dst
            $labelsMingguan[] = $tanggal->isoFormat('ddd'); // butuh locale id, tapi gapapa dulu

            // hitung jumlah hadir per hari
            $hadirHariItu = Absensi::whereDate('tanggal', $tanggal)
                ->where('status', 'H')
                ->count();

            $dataMingguan[] = $hadirHariItu;
        }

        return view('admin.dashboard', [
            'totalSiswa'        => $totalSiswa,
            'totalKelas'        => $totalKelas,
            'totalHadirHariIni' => $totalHadirHariIni,
            'chartLabels'       => $chartLabels,
            'chartData'         => $chartData,
            'labelsMingguan'    => $labelsMingguan,
            'dataMingguan'      => $dataMingguan,
            'aktivitasAbsensi'  => $aktivitasAbsensi
        ]);
    }
}
