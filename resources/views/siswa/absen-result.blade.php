@extends('layouts.siswa')

@section('title', 'Hasil Presensi')
@section('breadcrumb', 'Hasil Presensi')
@section('page-title', 'Hasil Presensi')

@section('content')
<div class="row">
  <div class="col-lg-6 col-md-8 mx-auto">
    <div class="card">
      <div class="card-body text-center">
        @if($status === 'H')
          <div class="alert alert-success">
            <h5 class="mb-1">Presensi Berhasil ✅</h5>
            <p class="mb-0">{{ $message ?? 'Data kehadiran kamu sudah tercatat.' }}</p>
          </div>
        @else
          <div class="alert alert-warning">
            <h5 class="mb-1">Presensi Diproses</h5>
            <p class="mb-0">{{ $message ?? 'Silakan cek kembali status presensi kamu.' }}</p>
          </div>
        @endif

        <a href="{{ route('siswa.dashboard') }}" class="btn bg-gradient-primary mt-3">
          Kembali ke Dashboard
        </a>
        <a href="{{ route('siswa.absen.scan') }}" class="btn btn-outline-secondary mt-3 ms-2">
          Scan Lagi
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
