<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QrController extends Controller
{
    public function index()
    {
        // halaman form generate QR
        return view('admin.generateQr.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'kelas'   => 'required|string',
            'tanggal' => 'required|date',
        ]);

        // URL yang akan ditanam di QR (nanti ini route untuk scan absen siswa)
        $url = route('siswa.absen.scan', [
            'kelas'   => $request->kelas,
            'tanggal' => $request->tanggal,
        ]);

        return view('admin.generateQr.index', [
            'kelas'   => $request->kelas,
            'tanggal' => $request->tanggal,
            'url'     => $url,
        ]);
    }
}
