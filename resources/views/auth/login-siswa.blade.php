<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/sman11bandung.png') }}">
  <title>Login Siswa - Absensi SMAN 11 Bandung</title>

  {{-- Google Font --}}
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

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
      box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15);
    }

    /* Panel kiri (info sekolah) */
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

    .school-panel p {
      font-size: 14px;
      line-height: 1.6;
      margin-bottom: 8px;
    }

    .school-panel ul {
      margin-left: 18px;
      margin-bottom: 12px;
      font-size: 14px;
    }

    .school-panel li {
      margin-bottom: 4px;
    }

    .school-footer {
      font-size: 12px;
      opacity: 0.9;
      margin-top: 12px;
      line-height: 1.5;
    }

    /* Panel kanan (login) */
    .login-panel {
      flex: 1 1 320px;
      padding: 32px 32px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 4px;
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

    .form-group {
      margin-bottom: 14px;
    }

    .form-label {
      display: block;
      font-size: 13px;
      font-weight: 500;
      margin-bottom: 6px;
    }

    .form-control {
      width: 100%;
      padding: 9px 11px;
      border-radius: 8px;
      border: 1px solid #d1d5db;
      font-size: 14px;
      outline: none;
      transition: border-color 0.15s, box-shadow 0.15s;
    }

    .form-control:focus {
      border-color: #1d4ed8;
      box-shadow: 0 0 0 1px rgba(37, 99, 235, 0.35);
    }

    .invalid-feedback {
      color: #b91c1c;
      font-size: 12px;
      margin-top: 3px;
    }

    .form-check {
      display: flex;
      align-items: center;
      margin-bottom: 16px;
      margin-top: 4px;
      font-size: 13px;
    }

    .form-check input {
      margin-right: 6px;
    }

    .btn-primary {
      width: 100%;
      border: none;
      border-radius: 999px;
      padding: 10px 16px;
      font-size: 14px;
      font-weight: 600;
      background: linear-gradient(135deg, #1d4ed8, #2563eb);
      color: #ffffff;
      cursor: pointer;
      transition: opacity 0.15s, transform 0.05s;
    }

    .btn-primary:hover {
      opacity: 0.95;
    }

    .btn-primary:active {
      transform: scale(0.98);
    }

    .login-footer {
      margin-top: 18px;
      font-size: 12px;
      text-align: center;
      color: #6b7280;
    }

    @media (max-width: 768px) {
      .auth-container {
        flex-direction: column;
      }

      .school-panel,
      .login-panel {
        padding: 20px 18px 24px;
      }
    }
  </style>
</head>

<body>
  <div class="page-wrapper">
    <div class="auth-container">

      {{-- Panel kiri: info sekolah --}}
      <div class="school-panel">
        <div class="school-header">
          <img src="{{ asset('assets/img/sman11bandung.png') }}"
               alt="Logo SMAN 11 Bandung"
               class="school-logo">
          <div>
            <div class="school-title">SMAN 11 Bandung</div>
            <div class="school-subtitle">Sistem Informasi Absensi Siswa</div>
          </div>
        </div>

        <div class="welcome-title">Selamat Datang Siswa </div>
        <p>Silakan login untuk melihat riwayat presensi dan informasi kehadiran.</p>

        <ul>
          <li>Lihat riwayat absensi harian</li>
          <li>Informasi status hadir / izin / sakit</li>
          <li>Presensi melalui scan QR di kelas</li>
        </ul>

        <div class="school-footer">
          Alamat: Jl. Kembar Baru No.23, Cigereleng, Kec. Regol, Kota Bandung, Jawa Barat 40253<br>
          
        </div>
      </div>

      
      <div class="login-panel">
        <div class="login-header">
          <div class="login-title">Login Siswa</div>
          <div class="login-subtitle">Masuk menggunakan akun yang diberikan sekolah</div>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger">
            {{ $errors->first() }}
          </div>
        @endif

        <form method="POST" action="{{ route('siswa.login.form') }}">
          @csrf

          <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="siswa@example.com"
                   required autofocus>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-check">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Ingat saya</label>
          </div>

          <button type="submit" class="btn-primary">
            Masuk
          </button>
        </form>

        <div class="login-footer">
          © <script>document.write(new Date().getFullYear())</script>
          · Sistem Absensi · SMAN 11 Bandung
        </div>
      </div>

    </div>
  </div>
</body>

</html>
