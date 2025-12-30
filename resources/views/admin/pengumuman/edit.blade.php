@extends('layouts.admin')

@section('title', 'Edit Pengumuman')
@section('breadcrumb', 'Edit Pengumuman')
@section('page-title', 'Edit Pengumuman')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.pengumuman.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ $item->judul }}" required>
            </div>

            <div class="mb-3">
                <label>Isi Pengumuman</label>
                <textarea name="isi" class="form-control" rows="4" required>{{ $item->isi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $item->tanggal }}" required>
            </div>

            <button class="btn bg-gradient-primary">Update</button>
        </form>

    </div>
</div>

@endsection
