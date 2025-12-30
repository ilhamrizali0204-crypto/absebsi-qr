{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row dashboard-cards">

  {{-- Total Siswa --}}
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
          <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                  <i class="material-icons opacity-10">group</i>
              </div>
              <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Total Siswa</p>
                  <h4 class="mb-0">{{ $totalSiswa }}</h4>
              </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
              <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder"></span>siswa tahun ajaran 2025-2026
              </p>
          </div>
      </div>
  </div>

  {{-- Jumlah Kelas --}}
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
          <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                  <i class="material-icons opacity-10">meeting_room</i>
              </div>
              <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Jumlah Kelas</p>
                  <h4 class="mb-0">35</h4>
              </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
              <p class="mb-0">
                  <span class="text-info text-sm font-weight-bolder">X, XI, XII </span>semua kelas
              </p>
          </div>
      </div>
  </div>

  {{-- Total Petugas --}}
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
          <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                  <i class="material-icons opacity-10">badge</i>
              </div>
              <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Total Petugas</p>
                  <h4 class="mb-0">6</h4>
              </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
              <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder">Siap </span>monitor absensi harian
              </p>
          </div>
      </div>
  </div>
</div>


  {{-- ROW 2: 3 kolom (Chart1, Chart2, Aktivitas) --}}
<div class="row mt-4">
  {{-- Chart 1 --}}
  <div class="col-lg-4 col-md-6 mt-4 mb-4">
    <div class="card z-index-2 ">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
          <div class="chart">
            <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
          </div>
        </div>
      </div>
      <div class="card-body">
        <h6 class="mb-0">Kehadiran Mingguan</h6>
        <p class="text-sm">Persentase kehadiran 7 hari terakhir</p>
        <hr class="dark horizontal">
        <div class="d-flex">
          <i class="material-icons text-sm my-auto me-1">schedule</i>
          <p class="mb-0 text-sm">Data diambil dari log absensi</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Chart 2 --}}
  <div class="col-lg-4 col-md-6 mt-4 mb-4">
    <div class="card z-index-2 ">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
        <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
          <div class="chart">
            <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
          </div>
        </div>
      </div>
      <div class="card-body">
        <h6 class="mb-0">Kehadiran per Kelas</h6>
        <p class="text-sm">
          (<span class="font-weight-bolder">Realtime</span>) berdasarkan data hari ini
        </p>
        <hr class="dark horizontal">
        <div class="d-flex">
          <i class="material-icons text-sm my-auto me-1">schedule</i>
          <p class="mb-0 text-sm">Update beberapa menit lalu</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Aktivitas Absensi Terakhir (posisi kolom ke-3) --}}
  <div class="col-lg-4 col-md-12 mt-4 mb-4">
    <div class="card h-100">
      <div class="card-header pb-0">
        <h6>Aktivitas Absensi Terakhir</h6>
        <p class="text-sm">
          <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
          <span class="font-weight-bold">Realtime</span> log sistem
        </p>
      </div>
      <div class="card-body p-3">
        <div class="timeline timeline-one-side">

          @forelse ($aktivitasAbsensi as $log)
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="material-icons text-success text-gradient">qr_code_scanner</i>
              </span>
        
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">
                  Siswa {{ $log->siswa->nama }}
                  ({{ $log->siswa->kelas }})
                  melakukan presensi
                </h6>
        
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                  {{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('d M H:i') }}
                </p>
              </div>
            </div>
          @empty
            <p class="text-center text-muted text-sm">
              Belum ada aktivitas absensi hari ini
            </p>
          @endforelse
        
        </div>
        

          {{-- Tambah item lain di sini --}}
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@push('scripts')
<script>
  // ==================================
  // Ambil data dari controller (PHP -> JS)
  // ==================================
  const labelsMingguan = @json($labelsMingguan); // contoh: ["Mon","Tue",...]
  const dataMingguan   = @json($dataMingguan);   // contoh: [12, 15, 9, ...]

  const kelasLabels = @json($chartLabels); // ["X-1","X-2", ...]
  const kelasData   = @json($chartData);   // [30, 28, ...]

  // ==================================
  // Chart 1: Kehadiran Mingguan
  // ==================================
  var ctx = document.getElementById("chart-bars").getContext("2d");

  new Chart(ctx, {
    type: "bar",
    data: {
      labels: labelsMingguan,
      datasets: [{
        label: "Jumlah Hadir",
        tension: 0.4,
        borderWidth: 0,
        borderRadius: 4,
        borderSkipped: false,
        backgroundColor: "rgba(255, 255, 255, .8)",
        data: dataMingguan,
        maxBarThickness: 6
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5],
            color: 'rgba(255, 255, 255, .2)'
          },
          ticks: {
            beginAtZero: true,
            padding: 10,
            font: {
              size: 14,
              weight: 300,
              family: "Roboto",
              style: 'normal',
              lineHeight: 2
            },
            color: "#fff"
          },
        },
        x: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5],
            color: 'rgba(255, 255, 255, .2)'
          },
          ticks: {
            display: true,
            color: '#f8f9fa',
            padding: 10,
            font: {
              size: 14,
              weight: 300,
              family: "Roboto",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
      },
    },
  });


  // ==================================
  // Chart 2: Kehadiran per Kelas
  // ==================================
  var ctx2 = document.getElementById("chart-line").getContext("2d");

  new Chart(ctx2, {
    type: "line",
    data: {
      labels: kelasLabels,
      datasets: [{
        label: "Jumlah Siswa",
        tension: 0.3,
        borderWidth: 0,
        pointRadius: 5,
        pointBackgroundColor: "rgba(255, 255, 255, .8)",
        pointBorderColor: "transparent",
        borderColor: "rgba(255, 255, 255, .8)",
        borderWidth: 4,
        backgroundColor: "transparent",
        fill: true,
        data: kelasData,
        maxBarThickness: 6
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5],
            color: 'rgba(255, 255, 255, .2)'
          },
          ticks: {
            display: true,
            color: '#f8f9fa',
            padding: 10,
            font: {
              size: 14,
              weight: 300,
              family: "Roboto",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            color: '#f8f9fa',
            padding: 10,
            font: {
              size: 14,
              weight: 300,
              family: "Roboto",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
      },
    },
  });
</script>
@endpush


