@extends('layouts.admin')

@section('title', 'Akun Siswa')
@section('page-title', 'Akun Siswa')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap gap-2 mb-3 align-items-center">

            {{-- tombol tingkat --}}
            <div class="btn-group btn-group-sm">
                <button class="btn btn-outline-secondary" onclick="showRombel('X')">X</button>
                <button class="btn btn-outline-secondary" onclick="showRombel('XI')">XI</button>
                <button class="btn btn-outline-secondary" onclick="showRombel('XII')">XII</button>
            </div>
        
            {{-- form filter --}}
            <form method="GET" class="d-flex gap-2 align-items-center">
                <input type="hidden" name="tingkat" id="tingkatInput">
        
                <select name="kelas"
                        id="rombelSelect"
                        class="form-select form-select-sm"
                        style="width:120px; display:none;"
                        onchange="this.form.submit()">
                    <option value="">Pilih Kelas</option>
                </select>
            </form>
        
        </div>
        <script>
            function showRombel(tingkat) {
                document.getElementById('tingkatInput').value = tingkat;
            
                const rombel = document.getElementById('rombelSelect');
                rombel.style.display = 'block';
                rombel.innerHTML = `<option value="">Pilih Kelas</option>`;
            
                let jumlah = (tingkat === 'XII') ? 11 : 12;
            
                for (let i = 1; i <= jumlah; i++) {
                    let kelas = `${tingkat}-${i}`;
                    rombel.innerHTML += `<option value="${kelas}">${kelas}</option>`;
                }
            }
            </script>
            
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $i => $user)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->siswa->nis ?? '-' }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge bg-secondary">12345678</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.akun-siswa.export.pdf',request()->query()) }}"
           class="btn btn-danger mt-3">
           Export PDF
        </a>
    </div>
</div>
@endsection
