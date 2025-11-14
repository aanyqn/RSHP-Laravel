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
            <th>Jenis</th>
            <th>No</th>
            <th>Nama Ras</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
            // $current = $ras->jenisHewan->idjenis_hewan;
            $current = null;
            $i = 1;
        @endphp
        @foreach ($groupedRasHewan as $index => $rasHewan)
                @foreach ($rasHewan as $ras)
                <tr>
                    @if ($ras->jenisHewan->idjenis_hewan != $current)
                        <td rowspan="{{ count($rasHewan) }}">
                            {{ $ras->jenisHewan->nama_jenis_hewan }}
                        </td>
                    @endif
                    <td>{{ $i }}</td>
                    <td>{{ $ras->nama_ras }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" onclick="window.location='#'">
                            <i class="fas fa-edit"></i>Edit
                        </button>
                            <button type="button" class="btn btn-sm btn-warning" onclick="if(confirm('Yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $ras->idras_hewan }}').submit(); }">
                            <i class="fas fa-edit"></i>Hapus
                        </button>
                            <form id="delete-form-{{ $ras->idras_hewan }}" action="#" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                        @php
                            $current = $ras->jenisHewan->idjenis_hewan;
                            // $current = null;
                            $i = $i + 1;
                        @endphp
                </tr> 
                @endforeach
        @endforeach
    </tbody>
</table>

<div class="mb-3">
    <form action="{{ route('admin.ras-hewan.create') }}" method="GET" style="displaye: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Ras
        </button>
    </form>
</div>