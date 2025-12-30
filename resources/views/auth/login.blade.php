<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/sman11bandung.png') }}">
  <title>Login - Absensi SMAN 11 Bandung</title>

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #eef1f5;
      min-height: 100vh;
    }

    .page-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .auth-container {
      display: flex;
      flex-wrap: wrap;
      max-width: 1100px;
      width: 100%;
      background: #ffffff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
    }

    /* Panel kiri */
    .school-panel {
      flex: 1 1 350px;
      padding: 40px 36px 48px;
      background: linear-gradient(135deg, #1e3a8a, #2563eb);
      color: #ffffff;
    }

    .school-header {
      display: flex;
      align-items: center;
      margin-bottom: 26px;
    }

    .school-logo {
      width: 70px;
      height: 70px;
      object-fit: contain;
      margin-right: 16px;
    }

    .school-title {
      font-size: 24px;
      font-weight: 700;
    }

    .school-subtitle {
      font-size: 14px;
      opacity: 0.85;
    }

    .welcome-title {
      font-size: 20px;
      font-weight: 600;
      margin: 12px 0;
    }

    .school-panel p,
    .school-panel ul {
      font-size: 14px;
      opacity: 0.95;
      margin-bottom: 10px;
      line-height: 1.6;
    }

    .school-panel ul {
      margin-left: 18px;
    }

    .school-footer {
      font-size: 12px;
      opacity: 0.85;
      margin-top: 20px;
      line-height: 1.5;
    }

    /* Panel kanan */
    .login-panel {
      flex: 1 1 350px;
      padding: 40px 36px 48px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-title {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 4px;
      color: #1f2937;
    }

    .login-subtitle {
      font-size: 14px;
      color: #6b7280;
      margin-bottom: 22px;
    }

    .alert {
      padding: 10px 12px;
      border-radius: 8px;
      font-size: 13px;
      margin-bottom: 16px;
    }

    .alert-danger {
      background: #fee2e2;
      color: #b91c1c;
      border: 1px solid #fecaca;
    }

    .form-group {
      margin-bottom: 16px;
    }

    .form-label {
      font-size: 13px;
      font-weight: 500;
      margin-bottom: 6px;
      display: block;
    }

    .form-control {
      width: 100%;
      padding: 10px 12px;
      border-radius: 10px;
      border: 1px solid #cbd5e1;
      font-size: 14px;
      transition: 0.2s;
    }

    .form-control:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.25);
      outline: none;
    }

    .invalid-feedback {
      font-size: 12px;
      color: #dc2626;
      margin-top: 4px;
    }

    .form-check {
      display: flex;
      align-items: center;
      font-size: 13px;
      margin-bottom: 18px;
    }

    .form-check input {
      margin-right: 6px;
    }

    .btn-primary {
      width: 100%;
      padding: 12px;
      border-radius: 12px;
      background: #2563eb;
      border: none;
      font-size: 15px;
      font-weight: 600;
      color: white;
      transition: 0.2s;
      cursor: pointer;
    }

    .btn-primary:hover {
      background: #1d4ed8;
    }

    .btn-primary:active {
      transform: scale(0.98);
    }

    .register-link {
      margin-top: 14px;
      font-size: 13px;
      text-align: center;
    }

    .register-link a {
      color: #2563eb;
      font-weight: 600;
      text-decoration: none;
    }

    .register-link a:hover {
      text-decoration: underline;
    }

    .login-footer {
      margin-top: 24px;
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
        padding: 28px 20px;
      }
    }
  </style>
</head>

<body>
  <div class="page-wrapper">
    <div class="auth-container">

      <!-- PANEL KIRI -->
      <div class="school-panel">
        <div class="school-header">
          <img src="{{ asset('assets/img/sman11bandung.png') }}" class="school-logo">
          <div>
            <div class="school-title">SMAN 11 Bandung</div>
            <div class="school-subtitle">Sistem Informasi Absensi Siswa</div>
          </div>
        </div>

        <div class="welcome-title">Selamat Datang </div>

        <p>Silakan login untuk mengelola data absensi, kelas, siswa, serta laporan kehadiran.</p>

        <ul>
          <li>Monitoring kehadiran harian / mingguan</li>
          <li>Generate QR Presensi</li>
          <li>Rekap absensi dalam PDF / Excel</li>
        </ul>

        <div class="school-footer">
          Alamat: Jl. Kembar Baru No.23, Cigereleng, Kec. Regol, Kota Bandung, Jawa Barat 40253<br>
          
        </div>
      </div>

      <!-- PANEL KANAN -->
      <div class="login-panel">
        <div class="login-title">Login Admin / Guru</div>
        <div class="login-subtitle">Masuk ke sistem absensi</div>

        @if ($errors->any())
          <div class="alert alert-danger">
            {{ $errors->first() }}
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
              placeholder="admin@example.com" required autofocus>
          </div>

          <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <div class="form-check">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Ingat saya</label>
          </div>

          <button type="submit" class="btn-primary">Masuk</button>
        </form>

        <div class="register-link">
          <a href="{{ route('admin.register') }}">Buat akun admin baru</a>
        </div>

        <div class="login-footer">
          © <script>document.write(new Date().getFullYear())</script> · Sistem Absensi SMAN 11 Bandung
        </div>
      </div>

    </div>
  </div>
</body>

</html>
