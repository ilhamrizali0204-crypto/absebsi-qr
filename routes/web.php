<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DataSiswaController;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensiController;
use App\Http\Controllers\Admin\QrController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginSiswaController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Admin\AkunSiswaController;
use App\Http\Controllers\Admin\AnnouncementController;



// SISWA
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\SiswaAbsenController;
use App\Http\Controllers\Siswa\ProfileController as SiswaProfileController;

/*
|--------------------------------------------------------------------------
| ROUTE LOGIN
|--------------------------------------------------------------------------
*/

// Login Admin
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/register-admin', [AdminRegisterController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/register-admin', [AdminRegisterController::class, 'register'])->name('admin.register.store');

// Login Siswa
Route::get('/siswa/login', [LoginSiswaController::class, 'showLoginForm'])
    ->name('siswa.login');
Route::post('/siswa/login', [LoginSiswaController::class, 'login'])
    ->name('siswa.login.form');

// Logout (dipakai keduanya)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| ROUTE SISWA
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')
    ->name('siswa.')
    ->middleware(['auth', 'role:siswa'])
    ->group(function () {

        Route::post('/siswa/presensi', [SiswaAbsenController::class, 'presensiMandiri'])
    ->name('siswa.absen.mandiri');


        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/scan-presensi', [SiswaAbsenController::class, 'scanPage'])
            ->name('scan.presensi');

        Route::get('/riwayat-absen', [SiswaAbsenController::class, 'riwayat'])
            ->name('absen.riwayat');

        Route::get('/profil', [SiswaProfileController::class, 'index'])
            ->name('profile');

        Route::get('/scan-absen', [SiswaAbsenController::class, 'handleScan'])
            ->name('absen.scan');
    });

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        // dashboard
        Route::get('dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // profile
        Route::get('profile', function () {
            return view('admin.profile');
        })->name('profile');

        // data siswa
        Route::resource('data-siswa', DataSiswaController::class)
            ->except(['show']);

        Route::post(
            'data-siswa/import',
            [DataSiswaController::class, 'import']
        )->name('data-siswa.import');

        // akun siswa
        Route::get('akun-siswa', [AkunSiswaController::class, 'index'])
        ->name('akun-siswa.index');

        Route::get('akun-siswa/export/pdf', [AkunSiswaController::class, 'exportPdf'])
        ->name('akun-siswa.export.pdf');


        // pengumuman
        Route::resource('pengumuman', AnnouncementController::class);

        // absensi
        Route::get('absensi', [AdminAbsensiController::class, 'index'])
            ->name('absensi.index');
        Route::post('absensi', [AdminAbsensiController::class, 'store'])
            ->name('absensi.store');

        // QR
        Route::get('qr', [QrController::class, 'index'])
            ->name('qr.index');
        Route::post('qr/generate', [QrController::class, 'generate'])
            ->name('qr.generate');
        Route::post('qr/tutup', [QrController::class, 'tutup']
            )->name('qr.tutup');
        

        // laporan
        Route::get('laporan', [LaporanController::class, 'index'])
            ->name('generateLaporan.index');
        Route::get('laporan/export-pdf', [LaporanController::class, 'exportPdf'])
            ->name('laporan.export.pdf');
        Route::get('laporan/export-excel', [LaporanController::class, 'exportExcel'])
            ->name('laporan.export.excel');
    });
/*
|--------------------------------------------------------------------------
| ROUTE UMUM
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
