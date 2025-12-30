@extends('layouts.admin')

@section('title', 'Laporan Absensi')
@section('breadcrumb', 'Laporan Absensi')
@section('page-title', 'Generate Laporan Absensi')

@section('content')
<div class="row">
  <div class="col-12">

    {{-- Alert success --}}
    @if (session('success'))
      <div class="alert alert-success alert-dismissible text-white" role="alert">
        <span class="text-sm">{{ session('success') }}</span>
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Filter Laporan Absensi</h6>
        <p class="text-sm text-secondary mb-0">
          Pilih rentang tanggal dan kelas untuk menampilkan serta mengekspor laporan.
        </p>
      </div>
      <div class="card-body">
        <form method="GET" action="{{ route('admin.generateLaporan.index') }}" class="row g-3">
          {{-- Tanggal Mulai --}}
          <div class="col-md-4">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date"
                   name="tanggal_mulai"
                   value="{{ $tanggal_mulai }}"
                   class="form-control">
          </div>

          {{-- Tanggal Selesai --}}
          <div class="col-md-4">
            <label class="form-label">Tanggal Selesai</label>
            <input type="date"
                   name="tanggal_selesai"
                   value="{{ $tanggal_selesai }}"
                   class="form-control">
          </div>

          {{-- Kelas --}}
          <div class="col-md-4">
            <label class="form-label">Kelas</label>
            <select name="kelas" class="form-control">
              <option value="">Semua Kelas</option>
              @foreach($daftarKelas as $k)
                <option value="{{ $k }}" {{ $kelas == $k ? 'selected' : '' }}>
                  {{ $k }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-12 d-flex justify-content-between align-items-center mt-3">
            <div>
              <button type="submit" class="btn bg-gradient-primary">
                Terapkan Filter
              </button>
              <a href="{{ route('admin.generateLaporan.index') }}" class="btn btn-outline-secondary btn-sm">
                Reset
              </a>
            </div>

            <div>
              {{-- Tombol Export --}}
              <a href="{{ route('admin.laporan.export.pdf', request()->query()) }}"
                 class="btn btn-sm bg-gradient-danger me-2">
                <i class="material-icons text-sm">picture_as_pdf</i> Export PDF
              </a>
              <a href="{{ route('admin.laporan.export.excel', request()->query()) }}"
                 class="btn btn-sm bg-gradient-success">
                <i class="material-icons text-sm">grid_on</i> Export Excel
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>

    {{-- Tabel Hasil --}}
    <div class="card">
      <div class="card-header pb-0">
        <h6>Hasil Laporan Absensi</h6>
        <p class="text-sm text-secondary mb-0">
          Menampilkan data absensi berdasarkan filter yang dipilih.
        </p>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIS</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($dataAbsensi as $index => $absen)
                <tr>
                  <td class="align-middle text-sm px-3">
                    {{ $index + 1 }}
                  </td>
                  <td class="align-middle text-sm">
                    {{ \Carbon\Carbon::parse($absen->tanggal)->format('d M Y') }}
                  </td>
                  <td class="align-middle text-sm">
                    {{ $absen->siswa->nis ?? '-' }}
                  </td>
                  <td class="align-middle text-sm">
                    {{ $absen->siswa->nama ?? '-' }}
                  </td>
                  <td class="align-middle text-sm">
                    {{ $absen->siswa->kelas ?? '-' }}
                  </td>
                  <td class="align-middle text-sm">
                    {{-- H / I / S / A bisa dikasih badge --}}
                    @php
                      $status = $absen->status;
                      $badgeClass = 'bg-secondary';
                      if ($status == 'H') $badgeClass = 'bg-success';
                      elseif ($status == 'I') $badgeClass = 'bg-info';
                      elseif ($status == 'S') $badgeClass = 'bg-warning';
                      elseif ($status == 'A') $badgeClass = 'bg-danger';
                    @endphp
                    <span class="badge badge-sm {{ $badgeClass }}">
                      {{ $status }}
                    </span>
                  </td>
                 
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center text-sm py-4">
                    Belum ada data absensi untuk filter tersebut.
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
@endsection
