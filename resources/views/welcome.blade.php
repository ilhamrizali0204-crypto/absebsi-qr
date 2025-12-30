<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Absensi - SMAN 11 Bandung</title>

  <link rel="icon" type="image/png" href="{{ asset('assets/img/sman11bandung.png') }}">

  {{-- Font --}}
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
      background: radial-gradient(circle at top, #e0f2fe, #e5e7eb);
      min-height: 100vh;
      color: #0f172a;
    }

    .page-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 16px;
    }

    .card-landing {
      max-width: 1100px;
      width: 100%;
      background: #ffffff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 18px 45px rgba(15, 23, 42, 0.15);
      display: flex;
      flex-wrap: wrap;
    }

    .left-panel {
      flex: 1 1 380px;
      padding: 32px 32px 40px;
      background: linear-gradient(135deg, #1a73e8, #4caf50);
      color: #ffffff;
      position: relative;
    }

    .left-panel::after {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at top left, rgba(255,255,255,0.18), transparent 55%);
      opacity: 0.8;
      pointer-events: none;
    }

    .left-inner {
      position: relative;
      z-index: 1;
    }

    .school-header {
      display: flex;
      align-items: center;
      margin-bottom: 24px;
    }

    .school-logo {
      width: 80px;
      height: 80px;
      object-fit: contain;
      margin-right: 16px;
      border-radius: 50%;
      background: rgba(255,255,255,0.15);
      padding: 6px;
    }

    .school-name {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 4px;
    }

    .school-tagline {
      font-size: 14px;
      opacity: 0.95;
    }

    .title-main {
      font-size: 26px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .title-sub {
      font-size: 14px;
      opacity: 0.95;
      margin-bottom: 18px;
      max-width: 360px;
    }

    .features {
      list-style: none;
      font-size: 14px;
      margin-bottom: 18px;
    }

    .features li {
      margin-bottom: 6px;
      display: flex;
      align-items: center;
    }

    .features span.icon-dot {
      width: 8px;
      height: 8px;
      border-radius: 999px;
      background: rgba(255,255,255,0.9);
      display: inline-block;
      margin-right: 8px;
    }

    .school-footer {
      font-size: 12px;
      opacity: 0.9;
      margin-top: 14px;
      line-height: 1.5;
    }

    .right-panel {
      flex: 1 1 360px;
      padding: 32px 32px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: #f9fafb;
    }

    .right-title {
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 6px;
      color: #111827;
    }

    .right-subtitle {
      font-size: 14px;
      color: #6b7280;
      margin-bottom: 20px;
    }

    .role-buttons {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 14px;
      margin-bottom: 22px;
    }

    .btn-role {
      border-radius: 14px;
      border: none;
      padding: 14px 12px;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      cursor: pointer;
      text-align: left;
      transition: transform 0.08s ease, box-shadow 0.1s ease, background 0.1s ease;
    }

    .btn-admin {
      background: linear-gradient(135deg, #1d4ed8, #2563eb);
      color: #ffffff;
      box-shadow: 0 10px 20px rgba(37, 99, 235, 0.45);
    }

    .btn-siswa {
      background: #ffffff;
      color: #111827;
      border: 1px solid #e5e7eb;
      box-shadow: 0 8px 18px rgba(148, 163, 184, 0.35);
    }

    .btn-role:hover {
      transform: translateY(-1px);
      box-shadow: 0 14px 30px rgba(15, 23, 42, 0.25);
    }

    .btn-label-main {
      font-size: 15px;
      font-weight: 600;
      margin-bottom: 4px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .badge {
      font-size: 10px;
      padding: 2px 6px;
      border-radius: 999px;
      background: rgba(15, 23, 42, 0.15);
    }

    .btn-desc {
      font-size: 12px;
      opacity: 0.9;
    }

    .mini-info {
      font-size: 13px;
      color: #6b7280;
      margin-bottom: 10px;
    }

    .divider {
      display: flex;
      align-items: center;
      margin: 14px 0;
      font-size: 12px;
      color: #9ca3af;
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: #e5e7eb;
    }

    .divider span {
      margin: 0 8px;
    }

    .stat-box {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 8px;
      font-size: 12px;
      color: #4b5563;
    }

    .pill {
      padding: 5px 10px;
      border-radius: 999px;
      background: #eef2ff;
      color: #3730a3;
    }

    .pill-2 {
      background: #ecfdf5;
      color: #047857;
    }

    .landing-footer {
      margin-top: 24px;
      font-size: 11px;
      color: #9ca3af;
    }

    .landing-footer a {
      color: #2563eb;
      text-decoration: none;
    }

    @media (max-width: 900px) {
      .card-landing {
        flex-direction: column;
      }

      .left-panel,
      .right-panel {
        padding: 22px 20px 26px;
      }

      .title-main {
        font-size: 22px;
      }
    }

    @media (max-width: 640px) {
      .role-buttons {
        grid-template-columns: 1fr;
      }

      .page-wrapper {
        padding: 12px;
      }
    }
  </style>
</head>
<body>
  <div class="page-wrapper">
    <div class="card-landing">

      {{-- PANEL KIRI: INFO SISTEM & SEKOLAH --}}
      <div class="left-panel">
        <div class="left-inner">
          <div class="school-header">
            <img src="{{ asset('assets/img/sman11bandung.png') }}"
                 alt="Logo SMAN 11 Bandung"
                 class="school-logo">
            <div>
              <div class="school-name">SMAN 11 Bandung</div>
              <div class="school-tagline">Sistem Informasi Absensi Siswa</div>
            </div>
          </div>

          <div class="title-main">Presensi Digital, Data Lebih Rapi</div>
          <p class="title-sub">
            Pantau kehadiran siswa secara real-time dengan QR Code,
            dashboard ringkas, dan laporan otomatis.
          </p>

          <ul class="features">
            <li>
              <span class="icon-dot"></span>
              Rekap kehadiran harian, mingguan, dan bulanan
            </li>
            <li>
              <span class="icon-dot"></span>
              Generate QR untuk absen masuk dan pulang
            </li>
            <li>
              <span class="icon-dot"></span>
              Laporan absensi dalam bentuk PDF & Excel
            </li>
          </ul>

          <div class="school-footer">
            Alamat: Jl. Kembar Baru No.23, Cigereleng, Kec. Regol, Kota Bandung, Jawa Barat 40253<br>
            

          </div>
        </div>
      </div>

      {{-- PANEL KANAN: PILIH LOGIN --}}
      <div class="right-panel">
        <h2 class="right-title">Masuk ke Sistem Absensi</h2>
        <p class="right-subtitle">
          Pilih jenis akun yang sesuai untuk melanjutkan ke dashboard.
        </p>

        <div class="role-buttons">
          {{-- LOGIN ADMIN --}}
          <button class="btn-role btn-admin"
                  onclick="window.location.href='{{ route('login') }}'">
            <div class="btn-label-main">
              Login Admin
              <span class="badge">Guru / Tata Usaha</span>
            </div>
            <div class="btn-desc">
              Kelola data siswa, generate QR, dan lihat rekap kehadiran lengkap.
            </div>
          </button>

          {{-- LOGIN SISWA --}}
          <button class="btn-role btn-siswa"
                  onclick="window.location.href='{{ route('siswa.login.form') }}'">
            <div class="btn-label-main">
              Login Siswa
              <span class="badge">Siswa</span>
            </div>
            <div class="btn-desc">
              Lihat riwayat presensi, status kehadiran, dan informasi absensi.
            </div>
          </button>
        </div>

        <div class="divider">
          <span>Info singkat</span>
        </div>

        <div class="mini-info">
          Akun dan password dibagikan oleh pihak sekolah. Jika mengalami kendala login,
          silakan hubungi wali kelas atau operator sekolah.
        </div>

        <div class="stat-box">
          <div class="pill">Absensi QR Code</div>
          <div class="pill pill-2">Rekap Otomatis</div>
        </div>

        <div class="landing-footer">
          © <script>document.write(new Date().getFullYear())</script>
          · Sistem Absensi · SMAN 11 Bandung
        </div>
      </div>

    </div>
  </div>
</body>
</html>
