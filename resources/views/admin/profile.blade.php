@extends('layouts.admin')

@section('title', 'Profil Akun')
@section('breadcrumb', 'Profil Admin')
@section('page-title', 'Profil Admin')

@section('content')
<div class="card">
    <div class="card-body">
        <h5>Profil Akun</h5>
        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Role:</strong> {{ Auth::user()->role ?? 'Admin' }}</p>
    </div>
</div>
@endsection
