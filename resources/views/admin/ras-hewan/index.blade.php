<table border="1" cellpadding="8" cellspacing="8">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Ras</th>
            <th>Jenis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rasHewan as $index => $ras)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $ras->nama_ras }}</td>
                <td>{{ $ras->jenisHewan->nama_jenis_hewan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>