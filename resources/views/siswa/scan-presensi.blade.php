@extends('layouts.siswa')

@section('title', 'Scan Presensi')
@section('breadcrumb', 'Scan Presensi')
@section('page-title', 'Scan Presensi')

@section('content')
<div class="row">
  <div class="col-lg-6 col-md-8 mx-auto">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Scan QR Presensi</h6>
        <p class="text-sm text-secondary mb-0">
          Arahkan kamera ke QR Code yang diberikan guru / di depan kelas.
        </p>
      </div>
      <div class="card-body">
        {{-- Tombol mulai scan --}}
        <div class="d-flex justify-content-center mb-3">
          <button id="btn-start-scan" class="btn bg-gradient-primary">
            <i class="material-icons me-1">qr_code_scanner</i> Mulai Scan
          </button>
          <button id="btn-stop-scan" class="btn btn-outline-secondary ms-2 d-none">
            Stop
          </button>
        </div>

        {{-- Area kamera --}}
        <div id="reader" style="width: 100%; max-width: 400px; margin:0 auto; display:none;"></div>

        {{-- Notif hasil --}}
        <div id="scan-result" class="alert mt-4 d-none" role="alert"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
{{-- library html5-qrcode via CDN --}}
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
  let html5QrcodeScanner = null;

  const readerElem   = document.getElementById('reader');
  const resultElem   = document.getElementById('scan-result');
  const btnStart     = document.getElementById('btn-start-scan');
  const btnStop      = document.getElementById('btn-stop-scan');

  function showMessage(type, text) {
    resultElem.classList.remove('d-none', 'alert-success', 'alert-danger');
    resultElem.classList.add('alert-' + type);
    resultElem.innerText = text;
  }

  btnStart.addEventListener('click', function () {
    // tampilkan area kamera
    readerElem.style.display = 'block';
    btnStart.classList.add('d-none');
    btnStop.classList.remove('d-none');
    resultElem.classList.add('d-none');

    if (!html5QrcodeScanner) {
      html5QrcodeScanner = new Html5Qrcode("reader");
    }

    html5QrcodeScanner.start(
      { facingMode: "environment" }, // kamera belakang (kalau ada)
      {
        fps: 10,
        qrbox: 250
      },
      // onSuccess
      (decodedText, decodedResult) => {
        // Stop scan setelah berhasil
        html5QrcodeScanner.stop().then(() => {
          btnStart.classList.remove('d-none');
          btnStop.classList.add('d-none');
          // sembunyikan kamera
          readerElem.style.display = 'none';
        }).catch(err => {
          console.error("Gagal stop scanner", err);
        });

        // TAMPILIN NOTIF DULU
        showMessage('success', 'QR terbaca! Mengarahkan ke halaman presensi...');

        // Kalau QR berisi URL (mis: https://domain.com/siswa/scan-absen?type=masuk&token=xxx)
        // langsung redirect:
        setTimeout(() => {
          window.location.href = decodedText;
        }, 1000);
      },
      // onError tiap frame
      (errorMessage) => {
        // boleh diabaikan biar ga spam console
      }
    ).catch(err => {
      console.error("Gagal memulai scanner", err);
      showMessage('danger', 'Tidak dapat mengakses kamera. Cek izin browser.');
    });
  });

  btnStop.addEventListener('click', function () {
    if (html5QrcodeScanner) {
      html5QrcodeScanner.stop().then(() => {
        readerElem.style.display = 'none';
        btnStart.classList.remove('d-none');
        btnStop.classList.add('d-none');
      }).catch(err => {
        console.error("Gagal stop scanner", err);
      });
    }
  });
</script>
@endpush
