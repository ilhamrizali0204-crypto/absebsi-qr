<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class DataSiswaController extends Controller
{
    /* ==================================================
     |  LIST & FILTER DATA SISWA
     ================================================== */
    public function index(Request $request)
    {
        $query = Siswa::with('user');

        // filter tingkat (X / XI / XII)
        if ($request->filled('tingkat')) {
            $query->where('kelas', 'LIKE', $request->tingkat . '%');
        }

        // filter rombel (X-1, XI-3, dst)
        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        $siswa = $query->orderBy('kelas')
                       ->orderBy('nama')
                       ->get();

        return view('admin.data-siswa.index', compact('siswa'));
    }

    /* ==================================================
     |  FORM TAMBAH SISWA (MANUAL)
     ================================================== */
    public function create()
    {
        return view('admin.data-siswa.create');
    }

    /* ==================================================
     |  SIMPAN SISWA + AKUN (MANUAL)
     ================================================== */
    public function store(Request $request)
    {
        $request->validate([
            'nis'      => 'required|unique:siswas,nis',
            'nisn'     => 'required|unique:siswas,nisn',
            'nama'     => 'required|string|max:255',
            'kelas'    => 'required|string|max:50',

            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // simpan siswa
        $siswa = Siswa::create([
            'nis'   => $request->nis,
            'nisn'  => $request->nisn,
            'nama'  => $request->nama,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        // simpan akun login siswa
        User::create([
            'name'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'siswa',
            'siswa_id' => $siswa->id,
        ]);

        return redirect()
            ->route('admin.data-siswa.index')
            ->with('success', 'Data siswa & akun login berhasil ditambahkan.');
    }

    /* ==================================================
     |  FORM EDIT SISWA
     ================================================== */
    public function edit(Siswa $data_siswa)
    {
        return view('admin.data-siswa.edit', [
            'siswa' => $data_siswa
        ]);
    }

    /* ==================================================
     |  UPDATE DATA SISWA
     ================================================== */
    public function update(Request $request, Siswa $data_siswa)
    {
        $request->validate([
            'nis'   => 'required|unique:siswas,nis,' . $data_siswa->id,
            'nisn'  => 'required|unique:siswas,nisn',
            'nama'  => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
        ]);

        $data_siswa->update([
            'nis'   => $request->nis,
            'nisn'  => $request->nisn,
            'nama'  => $request->nama,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request ->jenis_kelamin
        ]);

        return redirect()
            ->route('admin.data-siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /* ==================================================
     |  HAPUS SISWA + AKUN
     ================================================== */
    public function destroy(Siswa $data_siswa)
    {
        if ($data_siswa->user) {
            $data_siswa->user->delete();
        }

        $data_siswa->delete();

        return redirect()
            ->route('admin.data-siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    /* ==================================================
     |  IMPORT CSV / EXCEL (AUTO BUAT AKUN)
     ================================================== */
    public function import(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string',
            'file'  => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(
            new SiswaImport($request->kelas),
            $request->file('file')
        );

        return redirect()
            ->route('admin.data-siswa.index')
            ->with('success', 'Import siswa & akun berhasil.');
    }
}
