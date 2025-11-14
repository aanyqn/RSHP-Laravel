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
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
            // $current = $ras->jenisHewan->idjenis_hewan;
            $current = null;
            $i = 1;
        @endphp
        @foreach ($groupedRoleUser as $index => $roleUser)
                @foreach ($roleUser as $role)
                <tr>
                    @if ($role->user->iduser != $current)
                    <td rowspan="{{ count($roleUser) }}">{{ $i }}</td>
                    <td rowspan="{{ count($roleUser) }}">
                        {{ $role->user->nama }}
                    </td>
                    <td rowspan="{{ count($roleUser) }}">
                        {{ $role->user->email }}
                    </td>
                    @php
                    $current = $role->user->iduser;
                    // $current = null;
                    $i = $i + 1;
                    @endphp
                    @endif
                    <td>{{ $role->role->nama_role }}</td>
                    <td>{{ $role->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" onclick="window.location='#'">
                            <i class="fas fa-edit"></i>{{ $role->status ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                            <button type="button" class="btn btn-sm btn-warning" onclick="if(confirm('Yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $role->idrole_user }}').submit(); }">
                            <i class="fas fa-edit"></i>Hapus
                        </button>
                            <form id="delete-form-{{ $role->idrole_user }}" action="#" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr> 
                @endforeach
        @endforeach
    </tbody>
</table>

<div class="mb-3">
    <form action="{{ route('admin.role-user.create') }}" method="GET" style="displaye: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah User
        </button>
    </form>
</div>