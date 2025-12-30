@extends('layouts.admin')

@section('title', 'Generate QR Absensi')
@section('breadcrumb', 'Generate QR')
@section('page-title', 'Generate QR Absensi')

@section('content')
<div class="row">
  <div class="col-lg-5">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Form Generate QR</h6>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.qr.generate') }}" method="POST">
          @csrf

          {{-- PILIH KELAS (dropdown) --}}
          <div class="mb-3">
            <label class="form-label">Kelas</label>
            <select name="kelas"
                    class="form-control @error('kelas') is-invalid @enderror">
              <option value="">Pilih Kelas</option>

              {{-- X --}}
              <option value="X-1"  {{ old('kelas', $kelas ?? '') == 'X-1'  ? 'selected' : '' }}>X-1</option>
              <option value="X-2"  {{ old('kelas', $kelas ?? '') == 'X-2'  ? 'selected' : '' }}>X-2</option>
              <option value="X-3"  {{ old('kelas', $kelas ?? '') == 'X-3'  ? 'selected' : '' }}>X-3</option>

              {{-- XI --}}
              <option value="XI-1" {{ old('kelas', $kelas ?? '') == 'XI-1' ? 'selected' : '' }}>XI-1</option>
              <option value="XI-2" {{ old('kelas', $kelas ?? '') == 'XI-2' ? 'selected' : '' }}>XI-2</option>
              <option value="XI-3" {{ old('kelas', $kelas ?? '') == 'XI-3' ? 'selected' : '' }}>XI-3</option>

              {{-- XII --}}
              <option value="XII-1" {{ old('kelas', $kelas ?? '') == 'XII-1' ? 'selected' : '' }}>XII-1</option>
              <option value="XII-2" {{ old('kelas', $kelas ?? '') == 'XII-2' ? 'selected' : '' }}>XII-2</option>
              <option value="XII-3" {{ old('kelas', $kelas ?? '') == 'XII-3' ? 'selected' : '' }}>XII-3</option>
            </select>
            @error('kelas')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- TANGGAL --}}
          <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal"
                   class="form-control @error('tanggal') is-invalid @enderror"
                   value="{{ old('tanggal', $tanggal ?? now()->toDateString()) }}">
            @error('tanggal')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- JENIS ABSEN: MASUK / PULANG --}}
          <div class="mb-3">
            <label class="form-label">Jenis Absen</label>
            <div class="d-flex gap-3">

              <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="jenis"
                       id="jenis_masuk"
                       value="masuk"
                       {{ old('jenis', $jenis ?? 'masuk') == 'masuk' ? 'checked' : '' }}>
                <label class="form-check-label" for="jenis_masuk">
                  Absen Masuk
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="jenis"
                       id="jenis_pulang"
                       value="pulang"
                       {{ old('jenis', $jenis ?? '') == 'pulang' ? 'checked' : '' }}>
                <label class="form-check-label" for="jenis_pulang">
                  Absen Pulang
                </label>
              </div>

            </div>
            @error('jenis')
              <div class="text-danger text-xs">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn bg-gradient-primary">
            Generate QR
          </button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-7">
    @isset($url)
      <div class="card ">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
          <div>
            <h6>QR Code Absensi</h6>
            <p class="text-sm mb-0">
              Kelas: <strong>{{ $kelas }}</strong><br>
              Tanggal: <strong>{{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</strong>
            </p>
          </div>
        </div>
        <div class="card-body text-center">
          {!! QrCode::size(250)->generate($url) !!}

          <p class="text-xs mt-3">
            Scan QR ini menggunakan aplikasi scanner / kamera HP siswa.
          </p>

          <div class="mt-2">
            <small>URL: {{ $url }}</small>
          </div>
        </div>
      </div>
    @endisset
  </div>
</div>
@endsection
