<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Absensi Siswa</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        /* ===== KOP SURAT ===== */
        .kop {
            width: 100%;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .kop table {
            width: 100%;
            border: none;
        }

        .kop td {
            border: none;
            vertical-align: middle;
        }

        .kop img {
            width: 70px;
        }

        .kop-text {
            text-align: center;
        }

        .kop-text h1 {
            font-size: 16px;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .kop-text p {
            margin: 2px 0;
            font-size: 10px;
        }

        /* ===== JUDUL ===== */
        .judul {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .subjudul {
            text-align: center;
            font-size: 11px;
            margin-bottom: 10px;
        }

        /* ===== TABEL ===== */
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 4px;
            font-size: 10px;
        }

        table.data th {
            background: #f2f2f2;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mt-4 {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    {{-- KOP SURAT --}}
    <div class="kop">
        <table>
            <tr>
                <td style="width: 80px;">
                    <img src="{{ public_path('assets/img/sman11bandung.png') }}">
                </td>
                <td class="kop-text">
                    <h1>SMAN 11 Bandung</h1>
                    <p>Jl. Jl. Kembar Baru No.23, Cigereleng, Kec. Regol, Kota Bandung, Jawa Barat 40253</p>
                    <p>No. Telepon : 022-5201102 </p>
                </td>
                <td style="width: 80px;"></td>
            </tr>
        </table>
    </div>

    {{-- JUDUL --}}
    <div class="judul">
        Laporan Absensi Siswa
    </div>

    <div class="subjudul">
        @if ($kelas)
            Kelas {{ $kelas }} <br>
        @endif

        Periode:
        @if ($tanggal_mulai && $tanggal_selesai)
            {{ \Carbon\Carbon::parse($tanggal_mulai)->format('d M Y') }}
            s/d
            {{ \Carbon\Carbon::parse($tanggal_selesai)->format('d M Y') }}
        @elseif($tanggal_mulai)
            Mulai {{ \Carbon\Carbon::parse($tanggal_mulai)->format('d M Y') }}
        @elseif($tanggal_selesai)
            Sampai {{ \Carbon\Carbon::parse($tanggal_selesai)->format('d M Y') }}
        @else
            Semua Tanggal
        @endif
    </div>

    {{-- TABEL DATA --}}
    <table class="data">
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Tanggal</th>
                <th>Jam Absen</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataAbsensi as $index => $absen)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}
                    </td>
                    <td class="text-center">
                        {{ $absen->jam_absen ?? '-' }}
                    </td>
                    <td>{{ $absen->siswa->nama ?? '-' }}</td>
                    <td class="text-center">{{ $absen->siswa->kelas ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Tidak ada data absensi
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TANDA TANGAN --}}
    <div class="mt-4" style="width: 100%; text-align: right;">
        Bandung, {{ now()->format('d M Y') }} <br>
        Wali Kelas <br><br><br>
        <b>( ____________________ )</b>
    </div>

</body>
</html>
