<div class="mb-3">
    <a href="{{ route('admin.dashboard-admin') }}" method="GET" style="displaye: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Back
        </button>
    </a>
</div>


<table border="1" cellpadding="8" cellspacing="8">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Kategori Klinis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kodeTindakanTerapi as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->deskripsi_tindakan_terapi }}</td>
                <td>{{ $item->kategori->nama_kategori }}</td>
                <td>{{ $item->kategoriKlinis->nama_kategori_klinis }}</td>
            </tr>
        @endforeach
    </tbody>
</table>