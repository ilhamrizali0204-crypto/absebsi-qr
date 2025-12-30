{{-- resources/views/siswa/dashboard.blade.php --}}
@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')
@section('breadcrumb', 'Dashboard')
@section('page-title', 'Dashboard Siswa')

@section('content')
  {{-- ROW 1: Kartu ringkasan atas --}}
  <div class="row">
    {{-- Kartu: Nama & Kelas --}}
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">person</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Nama Siswa</p>
            <h4 class="mb-0">{{ $siswa->nama ?? '-' }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0">
            <span class="text-success text-sm font-weight-bolder">Kelas: </span>
            {{ $siswa->kelas ?? '-' }}
          </p>
        </div>
      </div>
    </div>

    {{-- Kartu: Status hari ini --}}
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">event_available</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Status Hari Ini</p>
            <h4 class="mb-0">
              @if($statusHariIni)
                {{ $statusHariIni }}
              @else
                Belum Absen
              @endif
            </h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0 text-sm text-secondary">
            {{ now()->format('d M Y') }}
          </p>
        </div>
      </div>
    </div>

    {{-- Kartu: Total Hadir --}}
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">history</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Hadir</p>
            <h4 class="mb-0">{{ $totalHadir ?? 0 }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0 text-sm">
            <span class="text-success text-sm font-weight-bolder">Akumulasi</span>
            semester ini
          </p>
        </div>
      </div>
    </div>

    {{-- Kartu: Aksi Cepat (Scan QR) --}}
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">qr_code_scanner</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Aksi Cepat</p>
            <h4 class="mb-0">Scan QR</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3 d-flex justify-content-between align-items-center">
          <span class="text-xs text-secondary d-none d-sm-inline">
            Klik untuk presensi
          </span>
          <a href="{{ route('siswa.absen.scan') }}" class="btn btn-sm bg-gradient-primary mb-0">
            Scan untuk Absen
          </a>
        </div>
      </div>
    </div>
  </div>

  {{-- ROW 2: Chart Ringkasan Status + Info Presensi --}}
  <div class="row mt-4">
    {{-- Chart Ringkasan Status --}}
    <div class="col-lg-8 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
          <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="chart-status" class="chart-canvas" height="220"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0">Ringkasan Status Presensi</h6>
          <p class="text-sm">
            Perbandingan jumlah Hadir, Izin, Sakit, dan Alfa pada semester ini.
          </p>
          <hr class="dark horizontal">
          <div class="d-flex align-items-center">
            <i class="material-icons text-sm me-1">insights</i>
            <p class="mb-0 text-sm">Grafik presensi pribadi kamu.</p>
          </div>
        </div>
      </div>
    </div>

    {{-- Info Presensi Singkat --}}
    <div class="col-lg-4">
      <div class="card h-100">
        <div class="card-header pb-0">
          <h6>Info Presensi</h6>
          <p class="text-sm mb-0">
            <i class="material-icons text-success text-sm me-1">info</i>
            Ringkasan cepat kehadiranmu.
          </p>
        </div>
        <div class="card-body pt-3">
          <ul class="list-group">
            <li class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
              <span class="text-sm">Hadir</span>
              <span class="text-sm font-weight-bold">{{ $totalHadir ?? 0 }} hari</span>
            </li>
            <li class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
              <span class="text-sm">Izin</span>
              <span class="text-sm font-weight-bold">{{ $totalIzin ?? 0 }} hari</span>
            </li>
            <li class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
              <span class="text-sm">Sakit</span>
              <span class="text-sm font-weight-bold">{{ $totalSakit ?? 0 }} hari</span>
            </li>
            <li class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
              <span class="text-sm">Alfa</span>
              <span class="text-sm font-weight-bold text-danger">{{ $totalAlfa ?? 0 }} hari</span>
            </li>
          </ul>

          <hr class="dark horizontal my-3">

          <p class="text-xs text-secondary mb-0">
            * Data diambil dari presensi pada semester berjalan.
          </p>
        </div>
      </div>
    </div>
  </div>

  {{-- CARD PENGUMUMAN ALA LMS --}}
  <div class="row mt-4">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            
            {{-- Header --}}
            <div class="card-header bg-white py-3 border-0 d-flex align-items-center" 
                 style="border-bottom: 1px solid #e5e9f2;">
                <i class="material-icons me-2 text-primary">campaign</i>
                <h5 class="mb-0" style="font-weight: 600;">Pengumuman</h5>
            </div>
  
            {{-- LIST --}}
            <div class="card-body" style="max-height: 300px; overflow-y: auto; background: #fafcff;">
  
                @forelse($pengumuman as $item)
                    <div class="p-3 mb-3 shadow-sm"
                         style="
                            background: #ffffff;
                            border-radius: 10px;
                            border-left: 4px solid #3a7bd5;
                          ">
                        
                        {{-- Judul --}}
                        <h6 class="mb-1" style="font-weight: 700; color:#003b73;">
                            {{ $item->judul }}
                        </h6>
  
                        {{-- Isi --}}
                        <p class="mb-1 text-sm" style="color:#333;">
                            {{ $item->isi }}
                        </p>
  
                        {{-- Footer --}}
                        <div class="d-flex justify-content-between mt-2">
                            <p class="text-xs text-secondary mb-0">
                                Posted by <strong>{{ $item->posted_by ?? 'Admin' }}</strong>
                            </p>
                            <span class="text-xs text-muted">
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y, H:i') }}
                            </span>
                        </div>
                    </div>
  
                @empty
                    <p class="text-center text-secondary mb-0">
                        Belum ada pengumuman.
                    </p>
                @endforelse
  
            </div>
        </div>
    </div>
  </div>
  


 {{-- ROW 3: Aktivitas Absensi Terakhir --}}
<div class="row mt-4 mb-4">
  <div class="col-lg-12">
      <div class="card shadow-sm border-0" style="border-radius: 12px;">
          
          <div class="card-header pb-2 border-0" style="border-bottom: 1px solid #e5e9f2;">
              <h5 class="mb-0" style="font-weight:600;">Aktivitas Absensi Terakhir</h5>
              <p class="text-sm text-secondary mb-0">
                  <i class="fa fa-history me-1 text-primary"></i>
                  Rekap presensi beberapa hari terakhir.
              </p>
          </div>

          <div class="card-body p-3">

              <div class="timeline timeline-one-side">
                @forelse($riwayatAbsensi as $log)
                  
                  <div class="timeline-block mb-4">

                    <span class="timeline-step shadow-sm"
                          style="background: #e8f5ff; border:1px solid #cfe4ff;">
                        <i class="material-icons text-primary">event</i>
                    </span>

                    <div class="timeline-content">

                        <h6 class="text-dark text-sm mb-1" style="font-weight:600;">
                            {{ $log->status }} 
                            <span class="text-secondary" style="font-weight:400;">
                                ({{ $log->keterangan ?? '-' }})
                            </span>
                        </h6>

                        <p class="text-xs text-muted mb-0">
                            {{ \Carbon\Carbon::parse($log->tanggal)->translatedFormat('d F Y') }}
                        </p>

                    </div>

                  </div>

                @empty
                    <p class="text-sm text-secondary mb-0">
                        Belum ada riwayat absensi.
                    </p>
                @endforelse
              </div>

          </div>
      </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  // Data dari controller
  var totalHadir = {{ $totalHadir ?? 0 }};
  var totalIzin  = {{ $totalIzin ?? 0 }};
  var totalSakit = {{ $totalSakit ?? 0 }};
  var totalAlfa  = {{ $totalAlfa ?? 0 }};

  var ctxStatus = document.getElementById("chart-status").getContext("2d");

  new Chart(ctxStatus, {
    type: "doughnut",
    data: {
      labels: ["Hadir", "Izin", "Sakit", "Alfa"],
      datasets: [{
        label: "Status Presensi",
        backgroundColor: [
          "rgba(255,255,255,0.95)",
          "rgba(255,255,255,0.75)",
          "rgba(255,255,255,0.55)",
          "rgba(255,255,255,0.35)"
        ],
        data: [totalHadir, totalIzin, totalSakit, totalAlfa],
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: true,
          labels: {
            color: '#fff',
            boxWidth: 12,
            font: { size: 11 }
          }
        }
      },
      cutout: '60%'
    },
  });
</script>
@endpush
