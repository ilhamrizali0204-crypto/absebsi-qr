@extends('layouts.admin')

@section('title', 'Pengumuman')
@section('breadcrumb', 'Pengumuman')
@section('page-title', 'Kelola Pengumuman')

@section('content')

<div class="row">

    <!-- FORM TAMBAH PENGUMUMAN -->
    <div class="col-lg-5 col-md-12">
        <div class="card shadow-sm" style="border-radius: 16px;">
            <div class="card-header pb-0 mb-0">
                <h5 class="mb-0"><i class="material-icons text-primary">campaign</i> Tambah Pengumuman</h5>
                <p class="text-sm text-muted">Pengumuman akan muncul di dashboard siswa</p>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.pengumuman.store') }}" method="post">
                    @csrf
                
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Pengumuman</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul..." required>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Pengumuman</label>
                        <textarea name="isi" rows="4" class="form-control" placeholder="Tulis pengumuman..." required></textarea>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                
                    <button class="btn bg-gradient-primary w-100" style="border-radius: 8px;">
                        <i class="material-icons me-1">add_circle</i> Buat Pengumuman
                    </button>
                </form>
                
            </div>
        </div>
    </div>

    <!-- LIST PENGUMUMAN -->
    <div class="col-lg-7 col-md-12 mt-lg-0 mt-4">
        <div class="card shadow-sm" style="border-radius: 16px;">
            <div class="card-header pb-0">
                <h5 class="mb-0"><i class="material-icons text-warning">notifications_active</i> Daftar Pengumuman</h5>
            </div>

            <div class="card-body">

                @if($pengumuman->count() == 0)
                    <p class="text-center text-muted">Belum ada pengumuman</p>
                @endif

                <ul class="list-group">

                    @foreach($pengumuman as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-start"
                            style="border-radius: 10px; margin-bottom: 10px;">

                            <div class="ms-2 me-auto">
                                <div class="fw-bold">{{ $item->judul }}</div>
                                <small class="text-muted">{{ $item->created_at->format('d M Y, H:i') }}</small>
                                <p class="mt-2 mb-1">{{ $item->isi }}</p>
                            </div>

                            <form action="{{ route('admin.pengumuman.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" style="border-radius: 6px;">
                                    <i class="material-icons" style="font-size: 18px;">delete</i>
                                </button>
                            </form>

                        </li>
                    @endforeach

                </ul>

            </div>
        </div>
    </div>

</div>

@endsection
