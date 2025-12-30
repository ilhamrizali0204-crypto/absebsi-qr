<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua siswa
        $siswas = Siswa::all();

        foreach ($siswas as $siswa) {

            // Cek: sudah punya user atau belum
            $existing = User::where('siswa_id', $siswa->id)->first();

            if ($existing) {
                // skip kalau sudah ada
                continue;
            }

            // bikin email default (silakan sesuaikan kebutuhan)
            // contoh: nis@sman11bdg.sch.id
            $email = $siswa->nis.'@sman11bdg.sch.id';

            // Kalau mau aman, pastikan tidak tabrakan dengan user lain:
            if (User::where('email', $email)->exists()) {
                // kalau tabrakan, tambahin suffix
                $email = $siswa->nis.'+'.uniqid().'@sman11bdg.sch.id';
            }

            // password default, misal: nis
            $passwordDefault = $siswa->nis;

            User::create([
                'name'      => $siswa->nama,
                'email'     => $email,
                'password'  => Hash::make($passwordDefault),
                'role'      => 'siswa',
                'siswa_id'  => $siswa->id,
            ]);
        }
    }
}
