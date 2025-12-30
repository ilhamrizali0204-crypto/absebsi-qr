@extends('layouts.admin')

@section('title', 'Tambah Pengumuman')
@section('breadcrumb', 'Tambah Pengumuman')
@section('page-title', 'Tambah Pengumuman')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.pengumuman.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Isi Pengumuman</label>
                <textarea name="isi" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <button class="btn bg-gradient-primary">Simpan</button>
        </form>

    </div>
</div>

@endsection
