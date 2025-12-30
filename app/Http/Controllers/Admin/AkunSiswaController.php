<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AkunSiswaController extends Controller
{
    /**
     * Tampilkan daftar akun siswa + filter kelas
     */
    public function index(Request $request)
    {
        $query = User::with('siswa')
            ->where('role', 'siswa');

        // Filter tingkat (X, XI, XII)
        if ($request->tingkat) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('kelas', 'LIKE', $request->tingkat . '%');
            });
        }

        // Filter rombel (X-1, XI-3, dll)
        if ($request->kelas) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }

        $users = $query->orderBy('name')->get();

        return view('admin.akun-siswa.index', compact('users'));
    }

    /**
     * Export akun siswa ke PDF
     */
    public function exportPdf(Request $request)
    {
        $query = User::with('siswa')
            ->where('role', 'siswa');

        // filter ikut terbawa ke PDF
        if ($request->tingkat) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('kelas', 'LIKE', $request->tingkat . '%');
            });
        }

        if ($request->kelas) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }

        $users = $query->orderBy('name')->get();

        $pdf = Pdf::loadView('admin.akun-siswa.pdf', compact('users'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('akun-siswa.pdf');
    }
}
