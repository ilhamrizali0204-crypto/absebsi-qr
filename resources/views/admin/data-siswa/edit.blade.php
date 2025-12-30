@extends('layouts.admin')

@section('title', 'Edit Siswa')
@section('breadcrumb', 'Edit Siswa')
@section('page-title', 'Edit Siswa')

@section('content')
<div class="row">
  <div class="col-lg-6 col-md-8 col-12">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Form Edit Siswa</h6>
        <p class="text-sm text-secondary mb-0">
          Perbarui data siswa secara berkala agar sesuai dengan data sekolah.
        </p>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.data-siswa.update', $siswa->id) }}" method="POST">
          @csrf
          @method('PUT')
        
          {{-- NIS --}}
          <div class="mb-3">
            <label class="form-label">NIS</label>
            <input type="text"
                   name="nis"
                   value="{{ old('nis', $siswa->nis) }}"
                   class="form-control @error('nis') is-invalid @enderror">
            @error('nis')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        
          <div class="mb-3">
            <label class="form-label">NISN</label>
            <input type="text"
                   name="nis"
                   value="{{ old('nis', $siswa->nisn) }}"
                   class="form-control @error('nisn') is-invalid @enderror">
            @error('nisn')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Nama --}}
          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text"
                   name="nama"
                   value="{{ old('nama', $siswa->nama) }}"
                   class="form-control @error('nama') is-invalid @enderror">
            @error('nama')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        
          <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
              <option value="">-- Pilih --</option>
              <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
              <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>
          
          {{-- Kelas (pilihan kurmer) --}}
          <div class="mb-3">
            <label class="form-label">Kelas</label>
            <select name="kelas" class="form-control @error('kelas') is-invalid @enderror">
              <option value="">Pilih Kelas</option>
              {{-- X --}}
              <option value="X-1"  {{ old('kelas', $siswa->kelas) == 'X-1'  ? 'selected' : '' }}>X-1</option>
              <option value="X-2"  {{ old('kelas', $siswa->kelas) == 'X-2'  ? 'selected' : '' }}>X-2</option>
              <option value="X-3"  {{ old('kelas', $siswa->kelas) == 'X-3'  ? 'selected' : '' }}>X-3</option>
              {{-- XI --}}
              <option value="XI-1" {{ old('kelas', $siswa->kelas) == 'XI-1' ? 'selected' : '' }}>XI-1</option>
              <option value="XI-2" {{ old('kelas', $siswa->kelas) == 'XI-2' ? 'selected' : '' }}>XI-2</option>
              <option value="XI-3" {{ old('kelas', $siswa->kelas) == 'XI-3' ? 'selected' : '' }}>XI-3</option>
              {{-- XII --}}
              <option value="XII-1" {{ old('kelas', $siswa->kelas) == 'XII-1' ? 'selected' : '' }}>XII-1</option>
              <option value="XII-2" {{ old('kelas', $siswa->kelas) == 'XII-2' ? 'selected' : '' }}>XII-2</option>
              <option value="XII-3" {{ old('kelas', $siswa->kelas) == 'XII-3' ? 'selected' : '' }}>XII-3</option>
            </select>
            @error('kelas')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        
          <button type="submit" class="btn bg-gradient-primary">Update</button>
          <a href="{{ route('admin.data-siswa.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
        
      </div>
    </div>
  </div>
</div>
@endsection
