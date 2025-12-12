@extends('layouts.lte.main')
@section('title', 'Manajemen Role User')
@section('content')
@php
$breadcrumbs = [
    'Dashboard' => route('admin.dashboard-admin'),
    'Manajemen Role User' => null,
];
@endphp
<div class="d-flex justify-content-between m-3 mt-0">
    <a href="{{ route('admin.dashboard-admin') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    <form action="{{ route('admin.role-user.create') }}" method="GET">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah User dan Role
        </button>
    </form>
</div>

<div class="container-fluid">
    <div class="alert alert-light mb-2">
        <div class="row">
            <form class="d-flex" role="search">
                <input
                    class="form-control me-2"
                    type="search"
                    name="search"
                    placeholder="Cari nama atau role.."
                    aria-label="Search"
                />
                <button class="btn btn-outline-primary" type="submit">Search</button>
                <a href="{{ route('admin.role-user.index') }}">
                    <button class="btn btn-outline-danger ms-2">Reset</button>
                </a>
            </form>
        </div>
    </div>
</div>

<div class="card m-3">
    <div class="card-header"><h3 class="card-title">Manajemen Role User</h3></div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered table-fixed">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th style="width: 80px">Edit</th>
                <th>Role</th>
                <th style="width: 100px">Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($groupedRoleUser as $index => $roleUser)
            @if($roleUser['roles'][0]['idrole_user'] != null)
                @if(count($roleUser['roles']) > 1)
                    @php
                        $count = null
                    @endphp
                    @foreach ($roleUser['roles'] as $role)
                        <tr>
                        @if($count == null)
                            <td rowspan="{{ count($roleUser['roles']) }}">
                                {{ $roleUser['nama'] }}
                            </td>
                            <td rowspan="{{ count($roleUser['roles']) }}">
                                {{ $roleUser['email'] }}
                            </td>
                            <td rowspan="{{ count($roleUser['roles']) }}" class="text-center">
                                <a href="{{ route('admin.role-user.edit', [$roleUser['iduser']]) }}">
                                    <button type="button" class="btn btn-sm btn-primary" onclick="window.location='#'">
                                        <i class="fas fa-edit"></i>Edit
                                    </button>
                                </a>
                            </td>
                            @php
                            $count = 1
                            @endphp
                        @endif
                        <td>{{ $role['nama_role'] }}</td>
                        <td>{{ $role['status'] ? 'Aktif' : 'Tidak Aktif' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.role-user.activate-role', [$role['idrole_user'], $role['status']]) }}">
                                <button type="button" class="btn btn-sm {{ $role['status'] ? 'btn-danger' : 'btn-success' }}" onclick="window.location='#'">
                                    <i class="fas fa-edit"></i>{{ $role['status'] ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </a>
                        </td>
                    @endforeach
                @else
                    <tr>
                        <td>
                            {{ $roleUser['nama'] }}
                        </td>
                        <td>
                            {{ $roleUser['email'] }}
                        </td>
                        <td rowspan="{{ count($roleUser['roles']) }}" class="text-center">
                            <a href="{{ route('admin.role-user.edit', [$roleUser['iduser']]) }}">
                                <button type="button" class="btn btn-sm btn-primary" onclick="window.location='#'">
                                    <i class="fas fa-edit"></i>Edit
                                </button>
                            </a>
                        </td>
                        <td>{{ $roleUser['roles'][0]['nama_role'] }}</td>
                        <td>{{ $roleUser['roles'][0]['status'] ? 'Aktif' : 'Tidak Aktif' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.role-user.activate-role', [$roleUser['roles'][0]['idrole_user'], $roleUser['roles'][0]['status']]) }}">
                                <button type="button" class="btn btn-sm {{ $roleUser['roles'][0]['status'] ? 'btn-danger' : 'btn-success' }}" onclick="window.location='#'">
                                    <i class="fas fa-edit"></i>{{ $roleUser['roles'][0]['status'] ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </a>
                        </td>
                    </tr>
                @endif
            @else
                <tr>
                    <td>
                        {{ $roleUser['nama'] }}
                    </td>
                    <td>
                        {{ $roleUser['email'] }}
                    </td>
                    <td rowspan="{{ count($roleUser['roles']) }}" class="text-center">
                        <a href="{{ route('admin.role-user.edit', [$roleUser['iduser']]) }}">
                            <button type="button" class="btn btn-sm btn-primary" onclick="window.location='#'">
                                <i class="fas fa-edit"></i>Edit
                            </button>
                        </a>
                    </td>
                    <td colspan="3">Tidak ada role</td>
                </tr>
            @endif
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

@endsection
