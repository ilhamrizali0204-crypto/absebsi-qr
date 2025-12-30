<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    protected $kelas;

    public function __construct($kelas)
    {
        $this->kelas = $kelas;
    }

    public function model(array $row)
    {
        // skip kalau nis kosong
        if (empty($row['nis'])) {
            return null;
        }

        // simpan siswa
        $siswa = Siswa::create([
            'nis'            => $row['nis'],
            'nisn'           => $row['nisn'] ?? null,
            'nama'           => $row['nama'],
            'jenis_kelamin'  => strtoupper($row['jenis_kelamin']),
            'kelas'          => $this->kelas,
        ]);

        // buat akun login otomatis
        User::create([
            'name'     => $row['nama'],
            'email'    => $row['nis'] . '@sman11bdg.sch.id',
            'password' => Hash::make('12345678'),
            'role'     => 'siswa',
            'siswa_id' => $siswa->id,
        ]);

        return $siswa;
    }
}
