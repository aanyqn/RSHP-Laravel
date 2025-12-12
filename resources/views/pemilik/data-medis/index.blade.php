<table border="1" cellpadding="8" cellspacing="8">
    @foreach ($pets as $index => $pet)
    <thead>
        <tr>
            <th>NO REKAM MEDIS</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Warna</th>
            <th>Jenis Kelamin</th>
            <th>Pemilik</th>
            <th>Ras</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pet->nama }}</td>
                <td>{{ $pet->tanggal_lahir }}</td>
                <td>{{ $pet->warna_tanda }}</td>
                <td>{{ $pet->jenis_kelamin }}</td>
                <td>{{ $pet->pemilik->user->nama }}</td>
                <td>{{ $pet->rasHewan->nama_ras }}</td>
            </tr>
    </tbody>
</table>
@endforeach