<!DOCTYPE html>
<html lang="en">

<head>
    
      
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/sman11bandung.png') }}">
  <title>
    @yield('title', 'Absensi Siswa')
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
  @stack('styles')
  <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" /> 
  <link rel="stylesheet" href="{{ asset('assets/css/mobile.css') }}">

  
    
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ url('/') }}" target="_blank">
        <img src="{{ asset('assets/img/sman11bandung.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">SMAN 11 Bandung</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        {{-- Dashboard --}}
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active bg-gradient-primary' : '' }}"
             href="{{ route('admin.dashboard') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
    
        {{-- Data Siswa --}}
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('admin.data-siswa.*') ? 'active bg-gradient-primary' : '' }}"
             href="{{ route('admin.data-siswa.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">group</i>
            </div>
            <span class="nav-link-text ms-1">Data Siswa</span>
          </a>
        </li>
    
        {{-- Data Absensi --}}
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('admin.absensi.*') ? 'active bg-gradient-primary' : '' }}"
             href="{{ route('admin.absensi.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">fact_check</i>
            </div>
            <span class="nav-link-text ms-1">Data Absensi</span>
          </a>
        </li>
    
        {{-- Generate QR --}}
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('admin.qr.*') ? 'active bg-gradient-primary' : '' }}"
             href="{{ route('admin.qr.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">qr_code</i>
            </div>
            <span class="nav-link-text ms-1">Generate QR</span>
          </a>
        </li>
    
        {{-- Generate Laporan (PDF / Excel) --}}
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('admin.laporan.*') ? 'active bg-gradient-primary' : '' }}"
             href="{{ route('admin.generateLaporan.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">description</i>
            </div>
            <span class="nav-link-text ms-1">Generate Laporan</span>
          </a>
        </li>

        {{-- Pengumuman --}}
    <li class="nav-item">
      <a class="nav-link text-white {{ request()->routeIs('admin.pengumuman.*') ? 'active bg-gradient-primary' : '' }}"
         href="{{ route('admin.pengumuman.index') }}">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="material-icons opacity-10">notifications_active</i>
        </div>
        <span class="nav-link-text ms-1">Pengumuman</span>
      </a>
    </li>

    {{-- Akun Siswa --}}
<li class="nav-item">
  <a class="nav-link text-white {{ request()->routeIs('admin.akun-siswa.*') ? 'active bg-gradient-primary' : '' }}"
     href="{{ route('admin.akun-siswa.index') }}">
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="material-icons opacity-10">manage_accounts</i>
    </div>
    <span class="nav-link-text ms-1">Akun Siswa</span>
  </a>
</li>
    
      </ul>
    </div>
               
          
           
          </ul>
          
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn bg-gradient-primary mt-4 w-100" type="button">
            Logout
          </button>
        </form>
      </div>
    </div>
    
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          {{-- breadcrumb bisa dinamis kalau mau --}}
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">SMAN 11 Bandung</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('breadcrumb', 'Dashboard')</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">@yield('page-title', 'Dashboard')</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label"></label>
              <input type="text" class="form-control">
            </div>
          </div>
          <li class="nav-item dropdown d-flex align-items-center">
            <a href="#" class="nav-link p-0" id="navbarDropdownProfile" 
               role="button" data-bs-toggle="dropdown" aria-expanded="false">
        
                <div class="rounded-circle bg-primary d-flex justify-content-center align-items-center"
                     style="width: 40px; height: 40px; color: white; font-weight: bold;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
            </a>
        
            <div class="dropdown-menu dropdown-menu-end p-3 shadow-lg"
                 aria-labelledby="navbarDropdownProfile" style="width: 260px; border-radius: 12px;">
        
                {{-- Avatar besar --}}
                <div class="text-center mb-2">
                    <div class="rounded-circle bg-primary mx-auto d-flex justify-content-center align-items-center"
                        style="width: 70px; height: 70px; color: white; font-size: 26px; font-weight: bold;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                </div>
        
                {{-- User info --}}
                <h6 class="text-center mb-0">{{ Auth::user()->name }}</h6>
                <p class="text-center text-muted mb-3" style="font-size: 14px;">
                    {{ Auth::user()->email }}
                </p>
        
                {{-- Tombol logout --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn w-100 text-white" 
                            style="background: #e74c3c; border-radius: 8px;">
                        <i class="fa fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </li>
        
        
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                {{-- isi notifikasi original template bisa kamu copy di sini kalau mau --}}
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      {{-- INI TEMPAT KONTEN SETIAP HALAMAN --}}
      @yield('content')

     
    </div>
  </main>

  
        {{-- isi body configurator sama seperti template aslinya, bisa kamu copy persis --}}
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>

  {{-- tempat script tambahan dari tiap halaman, termasuk chart --}}
  @stack('scripts')
</body>

</html>
