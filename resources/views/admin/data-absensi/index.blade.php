@extends('layouts.admin')

@section('title', 'Data Absensi')

@section('content')
<div class="container-fluid py-4">
  <div class="row mb-3">
    <div class="col-12">
      <div class="card">
        <div class="card-header pb-0">
          <h6>Data Absensi Siswa</h6>
        </div>
        <div class="card-body">
          {{-- Filter --}}
          <form method="GET" action="{{ route('admin.absensi.index') }}" class="row g-3">
            <div class="col-md-3">
              <label class="form-label">Tanggal</label>
              <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}">
            </div>
            <div class="col-md-3">
              <label class="form-label">Kelas</label>
              <select name="kelas" class="form-control">
                <option value="">Semua Kelas</option>
                @foreach($listKelas as $k)
                  <option value="{{ $k }}" {{ $kelas == $k ? 'selected' : '' }}>{{ $k }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
              <button type="submit" class="btn bg-gradient-primary me-2">Filter</button>
              <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary">Reset</a>
            </div>
          </form>

          <hr>

          {{-- Alert --}}
          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          <style>
            .status-pill-group {
              display: inline-flex;
              gap: 6px;
            }
            .status-pill-form {
              display: inline-block;
            }
            .status-pill-btn {
              width: 32px;
              height: 32px;
              border-radius: 50%;
              border: 2px solid rgba(0,0,0,0.2);
              background: #fff;
              font-size: 13px;
              font-weight: 700;
              display: flex;
              align-items: center;
              justify-content: center;
              cursor: pointer;
              transition: all 0.15s ease-in-out;
              padding: 0;
            }
            .status-pill-btn:hover {
              transform: translateY(-1px);
              box-shadow: 0 2px 6px rgba(0,0,0,0.15);
            }
            .status-pill-btn.active-H {
              background: #4CAF50;
              color: #fff;
              border-color: #4CAF50;
            }
            .status-pill-btn.active-S {
              background: #2196F3;
              color: #fff;
              border-color: #2196F3;
            }
            .status-pill-btn.active-I {
              background: #FFC107;
              color: #fff;
              border-color: #FFC107;
            }
            .status-pill-btn.active-A {
              background: #F44336;
              color: #fff;
              border-color: #F44336;
            }
          </style>

          {{-- Tabel Absensi --}}
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Tanggal</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th>
                  
                </tr>
              </thead>
              <tbody>
                @forelse ($siswas as $siswa)
                  @php
                    $rowAbsensi = $absensi[$siswa->id] ?? null;
                    $currentStatus = $rowAbsensi->status ?? null;
                    $keterangan = $rowAbsensi->keterangan ?? null;
                  @endphp
                  <tr>
                    <td>
                      <span class="text-sm">{{ $siswa->nama }}</span>
                    </td>
                    <td>
                      <span class="text-sm">{{ $siswa->kelas }}</span>
                    </td>
                    <td class="text-center">
                      <span class="text-sm">{{ $tanggal }}</span>
                    </td>
                    <td class="text-center">
                      <div class="status-pill-group">
                        @foreach (['H' => 'H', 'S' => 'S', 'I' => 'I', 'A' => 'A'] as $kode => $label)
                          <form method="POST"
                                action="{{ route('admin.absensi.store') }}"
                                class="status-pill-form">
                            @csrf
                            <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                            <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                            <input type="hidden" name="status" value="{{ $kode }}">
                            <button type="submit"
                              class="status-pill-btn {{ $currentStatus === $kode ? 'active-'.$kode : '' }}"
                              title="{{ $label }}">
                              {{ $label }}
                            </button>
                          </form>
                        @endforeach
                      </div>
                    </td>
                    <td>
                      {{-- optional: tampilkan keterangan --}}
                      <span class="text-sm">{{ $keterangan ?? '-' }}</span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center text-muted">
                      Tidak ada siswa untuk filter ini.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
