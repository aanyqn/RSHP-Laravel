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
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Warna</th>
            <th>Jenis Kelamin</th>
            <th>Pemilik</th>
            <th>Ras</th>
            <th>Aksi</th>
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
                <td>
                    <button type="button" class="btn btn-sm btn-warning" onclick="window.location='#'">
                        <i class="fas fa-edit"></i>Edit
                    </button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="if(confirm('Yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $pet->idpet }}').submit(); }">
                        <i class="fas fa-edit"></i>Hapus
                    </button>
                    <form id="delete-form-{{ $pet->idpet }}" action="#" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mb-3">
    <form action="{{ route('admin.pet.create') }}" method="GET" style="displaye: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pet
        </button>
    </form>
</div>