<table border="1" cellpadding="8" cellspacing="8">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Warna</th>
            <th>Jenis Kelamin</th>
            <th>Pemilik</th>
            <th>Ras</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pets as $index => $pet)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pet->nama }}</td>
                <td>{{ $pet->tanggal_lahir }}</td>
                <td>{{ $pet->warna_tanda }}</td>
                <td>{{ $pet->jenis_kelamin }}</td>
                <td>{{ $pet->pemilik->idpemilik }}</td>
                <td>{{ $pet->rasHewan->nama_ras }}</td>
            </tr>
        @endforeach
    </tbody>
</table>