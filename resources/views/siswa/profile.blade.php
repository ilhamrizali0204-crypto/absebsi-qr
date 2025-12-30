{{-- resources/views/siswa/profile.blade.php --}}
@extends('layouts.siswa')

@section('title', 'Profil Siswa')
@section('breadcrumb', 'Profil')
@section('page-title', 'Profil Siswa')

@section('content')
<div class="row">
  {{-- Kartu Profile --}}
  <div class="col-lg-4 col-md-5 mb-4">
    <div class="card">
      <div class="card-header p-3 pb-0">
        <div class="d-flex align-items-center">
          <div class="avatar avatar-xl bg-gradient-primary border-radius-xl d-flex align-items-center justify-content-center">
            <i class="material-icons text-white">person</i>
          </div>
          <div class="ms-3">
            <h5 class="mb-0">{{ $siswa->nama ?? '-' }}</h5>
            <p class="text-sm mb-0 text-secondary">
              NIS: {{ $siswa->nis ?? '-' }}
            </p>
            <p class="text-sm mb-0 text-secondary">
              Kelas: {{ $siswa->kelas ?? '-' }}
            </p>
            @if(!empty($siswa->jurusan))
              <p class="text-sm mb-0 text-secondary">
                Jurusan: {{ $siswa->jurusan }}
              </p>
            @endif
          </div>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-body p-3">
        <h6 class="text-sm text-secondary">Informasi Akun</h6>
        <ul class="list-group">
          <li class="list-group-item border-0 px-0 d-flex justify-content-between">
            <span class="text-sm text-secondary">Status</span>
            <span class="text-sm text-dark">Aktif</span>
          </li>
          <li class="list-group-item border-0 px-0 d-flex justify-content-between">
            <span class="text-sm text-secondary">Terdaftar Sejak</span>
            <span class="text-sm text-dark">
              {{ $siswa->created_at ? $siswa->created_at->format('d M Y') : '-' }}
            </span>
          </li>
        </ul>
      </div>
    </div>
  </div>

  {{-- Ringkasan Absensi --}}
  <div class="col-lg-8 col-md-7 mb-4">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between">
          <div>
            <h6>Ringkasan Absensi</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-info-circle text-info" aria-hidden="true"></i>
              <span class="font-weight-bold ms-1">Rekap</span> selama periode berjalan
            </p>
          </div>
          <a href="{{ route('siswa.absen.riwayat') }}" class="btn btn-sm bg-gradient-primary">
            Lihat Riwayat Lengkap
          </a>
        </div>
      </div>
      <div class="card-body px-3 py-3">
        <div class="row">
          <div class="col-md-3 col-6 mb-3">
            <div class="border-radius-lg border p-3 text-center">
              <p class="text-sm text-secondary mb-1">Hadir</p>
              <h4 class="mb-0 text-success">{{ $totalHadir }}</h4>
            </div>
          </div>
          <div class="col-md-3 col-6 mb-3">
            <div class="border-radius-lg border p-3 text-center">
              <p class="text-sm text-secondary mb-1">Izin</p>
              <h4 class="mb-0 text-info">{{ $totalIzin }}</h4>
            </div>
          </div>
          <div class="col-md-3 col-6 mb-3">
            <div class="border-radius-lg border p-3 text-center">
              <p class="text-sm text-secondary mb-1">Sakit</p>
              <h4 class="mb-0 text-warning">{{ $totalSakit }}</h4>
            </div>
          </div>
          <div class="col-md-3 col-6 mb-3">
            <div class="border-radius-lg border p-3 text-center">
              <p class="text-sm text-secondary mb-1">Alfa</p>
              <h4 class="mb-0 text-danger">{{ $totalAlfa }}</h4>
            </div>
          </div>
        </div>

        <hr class="dark horizontal">

        <p class="text-sm text-secondary mb-1">
          Catatan:
        </p>
        <ul class="text-sm text-secondary ps-3 mb-0">
          <li>Data di atas diambil dari log absensi kamu.</li>
          <li>Jika ada ketidaksesuaian, hubungi wali kelas atau admin sekolah.</li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
