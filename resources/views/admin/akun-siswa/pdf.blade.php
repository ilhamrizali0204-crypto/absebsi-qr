<h3 style="text-align:center">DATA AKUN SISWA</h3>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>NIS</th>
    <th>Email</th>
    <th>Password</th>
</tr>

@foreach($users as $i => $user)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->siswa->nis }}</td>
    <td>{{ $user->email }}</td>
    <td>12345678</td>
</tr>
@endforeach
</table>
