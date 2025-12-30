<li class="nav-item">
    <a class="nav-link text-white {{ request()->is('admin/dashboard') ? 'active bg-gradient-primary' : '' }}"
       href="{{ route('admin.dashboard') }}">
      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="material-icons opacity-10">dashboard</i>
      </div>
      <span class="nav-link-text ms-1">Dashboard</span>
    </a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link text-white {{ request()->is('admin/siswa*') ? 'active bg-gradient-primary' : '' }}"
       href="{{ route('admin.siswa.index') }}">
      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="material-icons opacity-10">table_view</i>
      </div>
      <span class="nav-link-text ms-1">Data Siswa</span>
    </a>
  </li>
  