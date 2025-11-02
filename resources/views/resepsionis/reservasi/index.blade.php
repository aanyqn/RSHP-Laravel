<table border="1" cellpadding="8" cellspacing="8">
    <thead>
        <tr>
            <th>No Urut</th>
            <th>Waktu Daftar</th>
            <th>Status</th>
            <th>Nama Pet</th>
            <th>Dokter</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($temuDokter as $index => $item)
            <tr>
                <td>{{ $item->no_urut }}</td>
                <td>{{ $item->waktu_daftar }}</td>
                <td>{{ $item->status ? 'Belum' : 'Sudah' }}</td>
                <td>{{ $item->pet->nama }}</td>
                <td>{{ $item->role_user->user->nama }}</td>
            </tr>
        @endforeach
    </tbody>
</table>