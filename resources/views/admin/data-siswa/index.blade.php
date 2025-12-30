  @extends('layouts.admin')

  @section('title', 'Data Siswa')
  @section('breadcrumb', 'Data Siswa')
  @section('page-title', 'Data Siswa')

  @section('content')
  <div class="row">
    <div class="col-12">

      {{-- Alert sukses --}}
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
          <span class="text-sm">{{ session('success') }}</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      {{-- CARD --}}
      <div class="card shadow-sm">

        {{-- HEADER --}}
        <div class="card-header bg-white pb-3">
          <div class="row align-items-center">

            <div class="col-md-6">
              <h5 class="mb-0">Daftar Siswa</h5>
              <small class="text-muted">
                Total: <b>{{ $siswa->count() }}</b> siswa
              </small>
            </div>

            <div class="col-md-6 mt-3 mt-md-0">
              <div class="d-flex flex-wrap justify-content-md-end gap-2">

                {{-- Filter tingkat --}}
                <div class="btn-group btn-group-sm">
                  <button class="btn btn-outline-secondary" onclick="showRombel('X')">X</button>
                  <button class="btn btn-outline-secondary" onclick="showRombel('XI')">XI</button>
                  <button class="btn btn-outline-secondary" onclick="showRombel('XII')">XII</button>
                </div>

                {{-- Dropdown rombel --}}
                <form action="{{ route('admin.data-siswa.index') }}" method="GET">
                  <input type="hidden" name="tingkat" id="tingkatInput">

                  <select name="kelas"
                          id="rombelSelect"
                          class="form-select form-select-sm"
                          style="width:120px; display:none;"
                          onchange="this.form.submit()">
                    <option value="">Rombel</option>
                  </select>
                </form>

                {{-- Action buttons --}}
                <a href="{{ route('admin.data-siswa.create') }}"
                  class="btn btn-sm bg-gradient-primary">
                  <i class="material-icons text-sm">add</i>
                  Tambah
                </a>

                <button class="btn btn-sm btn-outline-success"
                        data-bs-toggle="modal"
                        data-bs-target="#importCsvModal">
                  <i class="material-icons text-sm">upload</i>
                  Import CSV
                </button>

              </div>
            </div>

          </div>
        </div>

        {{-- BODY --}}
        <div class="card-body p-0">
          <div class="table-responsive">

            <table class="table table-hover align-items-center mb-0">
              <thead class="table-light">
                <tr>
                  <th class="text-center" style="width:10px">No</th>
                  <th>NIS</th>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>JK</th>
                  
                  
                  <th class="text-center" style="width:150px">Aksi</th>
                </tr>
              </thead>

              <tbody>
                @forelse ($siswa as $index => $item)
                  <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->nis }}</td>
                    <td>{{ $item->nisn }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>
                      <span class="badge {{ $item->jenis_kelamin == 'L' ? 'bg-info' : 'bg-info' }}">
                        {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                      </span>
                    </td>
                    <td class="text-center">
                      <a href="{{ route('admin.data-siswa.edit', $item->id) }}"
                        class="btn btn-warning btn-sm">Edit</a>
                
                      <form action="{{ route('admin.data-siswa.destroy', $item->id) }}"
                            method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus siswa ini?')">
                          Hapus
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center text-muted">
                      Belum ada data siswa
                    </td>
                  </tr>
                @endforelse
                </tbody>
                
            </table>            

          </div>
        </div>

      </div>
    </div>
  </div>

  {{-- MODAL IMPORT CSV --}}
  <div class="modal fade" id="importCsvModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">

        <form action="{{ route('admin.data-siswa.import') }}"
              method="POST"
              enctype="multipart/form-data">
          @csrf

          <div class="modal-header">
            <h5 class="modal-title">Import CSV Siswa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">

            <div class="mb-3">
              <label class="form-label">Kelas</label>
              <select name="kelas" id="kelasImport" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
              </select>
            </div>
            

            <div class="mb-3">
              <label class="form-label">File CSV</label>
              <input type="file" name="file" class="form-control" required>
              <small class="text-muted">
                Format: <code>nis,nama</code>
              </small>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
              Batal
            </button>
            <button type="submit" class="btn btn-success">
              Import & Buat Akun
            </button>
          </div>

        </form>

      </div>
    </div>
  </div>

  {{-- SCRIPT --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const select = document.getElementById('kelasImport');
      if (!select) return;
    
      const kelas = {
        X: 12,
        XI: 12,
        XII: 11
      };
    
      Object.keys(kelas).forEach(tingkat => {
        for (let i = 1; i <= kelas[tingkat]; i++) {
          const option = document.createElement('option');
          option.value = `${tingkat}-${i}`;
          option.textContent = `${tingkat}-${i}`;
          select.appendChild(option);
        }
      });
    });
    </script>
  @endsection
