<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('siswa/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('siswa/assets/img/sman11bandung.png') }}">
  <title>@yield('title', 'Material Dashboard 2')</title>

  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="{{ asset('siswa/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('siswa/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link id="pagestyle" href="{{ asset('siswa/assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />

  @stack('styles')
  <link href="{{ asset('siswa/assets/css/custom.css') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-200">

  @php
    function getInitials($name) {
        $words = explode(' ', trim($name));
        $initials = '';
        foreach ($words as $w) {
            $initials .= strtoupper($w[0] ?? '');
        }
        return substr($initials, 0, 2);
    }
    $inisial = getInitials(auth()->user()->nama ?? 'User');
  @endphp

  <!-- SIDEBAR -->
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main">

    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        id="iconSidenav"></i>

      <a class="navbar-brand m-0" href="{{ url('/') }}">
        <img src="{{ asset('siswa/assets/img/sman11bandung.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">SMAN 11 Bandung</span>
      </a>
    </div>

    <hr class="horizontal light mt-0 mb-2">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('siswa.dashboard') ? 'active bg-gradient-primary' : '' }}"
            href="{{ route('siswa.dashboard') }}">
            <div class="text-white d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('siswa.scan.presensi') ? 'active bg-gradient-primary' : '' }}"
            href="{{ route('siswa.scan.presensi') }}">
            <div class="text-white d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">qr_code_scanner</i>
            </div>
            <span class="nav-link-text ms-1">Scan Presensi</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white {{ request()->routeIs('siswa.profile') ? 'active bg-gradient-primary' : '' }}"
            href="{{ route('siswa.profile') }}">
            <div class="text-white d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profil</span>
          </a>
        </li>

      </ul>
    </div>

    <div class="sidenav-footer position-absolute w-100 bottom-0">
      <div class="mx-3">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn bg-gradient-primary mt-4 w-100">Logout</button>
        </form>
      </div>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

    <!-- NAVBAR -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">

      <div class="container-fluid py-1 px-3">

        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active">@yield('breadcrumb', 'Dashboard')</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">@yield('page-title', 'Dashboard')</h6>
        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div>
          </div>

          <ul class="navbar-nav justify-content-end">

            <!-- AVATAR INISIAL -->
            <li class="nav-item dropdown d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="navbarProfileDropdown" data-bs-toggle="dropdown">
                <div class="avatar avatar-sm rounded-circle d-flex align-items-center justify-content-center"
                  style="background:#4a4a4a; color:white; font-weight:600;">
                  {{ $inisial }}
                </div>
              </a>

              <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="navbarProfileDropdown">
                <li>
                  <a class="dropdown-item border-radius-md" href="{{ route('siswa.profile') }}">
                    <i class="fa fa-user me-2"></i> Profil Saya
                  </a>
                </li>
                <li>
                  <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0 m-0">
                    @csrf
                    <button class="dropdown-item border-radius-md">
                      <i class="fa fa-sign-out-alt me-2"></i> Logout
                    </button>
                  </form>
                </li>
              </ul>
            </li>

            <!-- NOTIF -->
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton"></ul>
            </li>

          </ul>
        </div>

      </div>
    </nav>
    <!-- END NAVBAR -->

    <div class="container-fluid py-4">
      @yield('content')
    </div>

  </main>

  <!-- Scripts -->
  <script src="{{ asset('siswa/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('siswa/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('siswa/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('siswa/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('siswa/assets/js/plugins/chartjs.min.js') }}"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), { damping: '0.5' });
    }
  </script>

  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="{{ asset('siswa/assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>

  @stack('scripts')
</body>

</html>
