@extends('layouts.lte.main')
@section('content')

<div class="m-3">
    <a href="{{ route('admin.dashboard-admin') }}" method="GET" style="displaye: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Back
        </button>
    </a>
</div>

<div class="card m-3">
    <div class="card-header"><h3 class="card-title">User</h3></div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Edit</th>
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
                    @endif
                    <td>{{ $role->role->nama_role }}</td>
                    <td>{{ $role->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm {{ $role->status ? 'btn-warning' : 'btn-primary' }}" onclick="window.location='#'">
                            <i class="fas fa-edit"></i>{{ $role->status ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $role->idrole_user }}').submit(); }">
                            <i class="fas fa-edit"></i>Hapus
                        </button>
                        <form id="delete-form-{{ $role->idrole_user }}" action="#" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                    @if ($role->user->iduser != $current)
                    <td class="text-center" rowspan="{{ count($roleUser) }}">
                        <a href="{{ route('admin.role-user.edit', $role->user->iduser) }}">
                            <button type="button" class="btn btn-sm btn-primary" onclick="window.location='#'">
                                <i class="fas fa-edit"></i>Edit
                            </button>
                        </a>        
                    </td>
                    @endif
                    @php
                    $current = $role->user->iduser;
                    // $current = null;
                    $i = $i + 1;
                    @endphp
                </tr> 
                @endforeach
        @endforeach
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-end">
        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
    </ul>
    </div>
</div>

<div class="m-3">
    <form action="{{ route('admin.role-user.create') }}" method="GET" style="displaye: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah User
        </button>
    </form>
</div>
@endsection
