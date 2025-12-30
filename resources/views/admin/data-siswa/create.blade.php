@extends('layouts.admin')

@section('title', 'Tambah Siswa')
@section('breadcrumb', 'Data Siswa')
@section('page-title', 'Tambah Siswa')

@section('content')
<div class="row justify-content-center">
  <div class="col-lg-7 col-md-9 col-12">

    <div class="card shadow-sm">
      {{-- HEADER --}}
      <div class="card-header bg-white pb-0">
        <h6 class="mb-1">Form Tambah Siswa</h6>
        <p class="text-sm text-secondary mb-0">
          Lengkapi data siswa sesuai dengan data resmi sekolah.
        </p>
      </div>

      {{-- BODY --}}
      <div class="card-body">
        <form action="{{ route('admin.data-siswa.store') }}" method="POST">
          @csrf

          {{-- NIS --}}
          <div class="mb-3">
            <label class="form-label">NIS</label>
            <input type="text"
                   name="nis"
                   value="{{ old('nis') }}"
                   class="form-control @error('nis') is-invalid @enderror"
                   placeholder="Masukkan NIS siswa">
            @error('nis')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- NISN --}}
          <div class="mb-3">
            <label class="form-label">NISN</label>
            <input type="text"
                   name="nisn"
                   value="{{ old('nisn') }}"
                   class="form-control @error('nisn') is-invalid @enderror"
                   placeholder="Masukkan NISN siswa">
            @error('nisn')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Nama --}}
          <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text"
                   name="nama"
                   value="{{ old('nama') }}"
                   class="form-control @error('nama') is-invalid @enderror"
                   placeholder="Masukkan nama lengkap siswa">
            @error('nama')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Jenis Kelamin --}}
          <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin"
                    class="form-select @error('jenis_kelamin') is-invalid @enderror">
              <option value="">-- Pilih --</option>
              <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
              <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Kelas --}}
          <div class="mb-4">
            <label class="form-label">Kelas</label>
            <select name="kelas"
                    class="form-select @error('kelas') is-invalid @enderror">
              <option value="">-- Pilih Kelas --</option>

              @php
                $levels = ['X' => 12, 'XI' => 12, 'XII' => 11];
              @endphp

              @foreach ($levels as $tingkat => $jumlah)
                <optgroup label="Kelas {{ $tingkat }}">
                  @for ($i = 1; $i <= $jumlah; $i++)
                    <option value="{{ $tingkat }}-{{ $i }}"
                      {{ old('kelas') == $tingkat.'-'.$i ? 'selected' : '' }}>
                      {{ $tingkat }}-{{ $i }}
                    </option>
                  @endfor
                </optgroup>
              @endforeach
            </select>
            @error('kelas')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <hr class="my-4">

          {{-- AKUN LOGIN --}}
          <h6 class="mb-1">Akun Login Siswa</h6>
          <p class="text-xs text-secondary mb-3">
            Digunakan siswa untuk login ke sistem.
          </p>

          {{-- Email --}}
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="contoh: 12345@siswa.sch.id">
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Password --}}
          <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Minimal 6 karakter">
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- ACTION --}}
          <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.data-siswa.index') }}"
               class="btn btn-light border">
              Batal
            </a>
            <button type="submit" class="btn bg-gradient-primary">
              Simpan
            </button>
          </div>

        </form>
      </div>
    </div>

  </div>
</div>
@endsection
