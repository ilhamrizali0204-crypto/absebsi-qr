<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/sman11bandung.png') }}">

  <title>Register Admin - Absensi SMAN 11 Bandung</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Roboto', sans-serif;
      background: #e5e7eb;
      min-height: 100vh;
    }

    .page-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 16px;
    }

    .auth-container {
      display: flex;
      flex-wrap: wrap;
      max-width: 1100px;
      width: 100%;
      background: #ffffff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(15,23,42,0.15);
    }

    .school-panel {
      flex: 1 1 320px;
      padding: 32px 32px 40px;
      background: linear-gradient(135deg, #1a73e8, #4caf50);
      color: #ffffff;
    }

    .school-header {
      display: flex;
      align-items: center;
      margin-bottom: 24px;
    }

    .school-logo {
      width: 72px;
      height: 72px;
      object-fit: contain;
      margin-right: 16px;
    }

    .school-title {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 4px;
    }

    .school-subtitle {
      font-size: 14px;
      opacity: 0.9;
    }

    .welcome-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 8px;
      margin-top: 8px;
    }

    .school-panel p, 
    .school-panel ul {
      font-size: 14px;
      line-height: 1.6;
      margin-bottom: 8px;
    }

    .school-footer {
      font-size: 12px;
      opacity: 0.9;
      margin-top: 16px;
      line-height: 1.5;
    }

    .login-panel {
      flex: 1 1 320px;
      padding: 32px 32px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-title {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .login-subtitle {
      font-size: 14px;
      color: #6b7280;
      margin-bottom: 20px;
    }

    .alert {
      padding: 10px 12px;
      border-radius: 8px;
      font-size: 13px;
      margin-bottom: 16px;
    }

    .alert-danger {
      background: #fee2e2;
      color: #991b1b;
      border: 1px solid #fecaca;
    }

    .form-group { margin-bottom: 14px; }
    .form-label { font-size: 13px; font-weight: 500; margin-bottom: 6px; display: block; }

    .form-control {
      width: 100%;
      padding: 8px 10px;
      border-radius: 8px;
      border: 1px solid #d1d5db;
      font-size: 14px;
    }

    .btn-primary {
      width: 100%;
      border: none;
      border-radius: 999px;
      padding: 10px 16px;
      font-size: 14px;
      font-weight: 600;
      background: linear-gradient(135deg, #1d4ed8, #2563eb);
      color: white;
      cursor: pointer;
    }

    .login-footer {
      margin-top: 18px;
      font-size: 12px;
      text-align: center;
      color: #6b7280;
    }

    @media (max-width: 768px) {
      .auth-container { flex-direction: column; }
      .school-panel, .login-panel { padding: 20px; }
    }
  </style>
</head>

<body>
  <div class="page-wrapper">
    <div class="auth-container">

      {{-- PANEL KIRI --}}
      <div class="school-panel">
        <div class="school-header">
          <img src="{{ asset('assets/img/sman11bandung.png') }}" class="school-logo">
          <div>
            <div class="school-title">SMAN 11 Bandung</div>
            <div class="school-subtitle">Sistem Informasi Absensi Siswa</div>
          </div>
        </div>

        <div class="welcome-title">Buat Akun Admin</div>
        <p>Akun admin digunakan untuk mengelola absensi, data siswa, dan laporan sekolah.</p>

        <ul>
          <li>Kelola data absensi siswa</li>
          <li>Kelola kelas & jadwal</li>
          <li>Generate laporan PDF / Excel</li>
        </ul>

        <div class="school-footer">
          Alamat: Jl. Gatot Subroto No. 123, Bandung<br>
          Telepon: (022) 1234567
        </div>
      </div>

      {{-- PANEL KANAN --}}
      <div class="login-panel">
        <div class="login-title">Register Admin</div>
        <div class="login-subtitle">Silakan isi data berikut untuk membuat akun admin</div>

        @if ($errors->any())
        <div class="alert alert-danger">
          {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.register.store') }}">
          @csrf

          <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
          </div>

          <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
          </div>

          <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <div class="form-group">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
          </div>

          <button type="submit" class="btn-primary">Daftar Sekarang</button>
        </form>

        <div class="text-center mt-3">
          <a href="{{ route('login') }}">Sudah punya akun? Login</a>
        </div>

        <div class="login-footer">
          © <script>document.write(new Date().getFullYear())</script> · Sistem Absensi · SMAN 11 Bandung
        </div>
      </div>

    </div>
  </div>
</body>
</html>
