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
            <th>Jenis Hewan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jenisHewan as $index => $hewan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $hewan->nama_jenis_hewan }}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-warning" onclick="window.location='#'">
                        <i class="fas fa-edit"></i>Edit
                    </button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="if(confirm('Yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $hewan->idjenis_hewan }}').submit(); }">
                        <i class="fas fa-edit"></i>Hapus
                    </button>
                    <form id="delete-form-{{ $hewan->idjenis_hewan }}" action="#" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mb-3">
    <form action="{{ route('admin.jenis-hewan.create') }}" method="GET" style="displaye: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jenis Hewan
        </button>
    </form>
</div>