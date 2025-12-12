@extends('layouts.lte.main')
@section('title', 'User')
@section('content')
@php
$breadcrumbs = [
    'Dashboard' => route('admin.dashboard-admin'),
    'User' => null,
];
@endphp
<div class="d-flex justify-content-between m-3 mt-0">
    <a href="{{ route('admin.dashboard-admin') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    <form action="{{ route('admin.user.create') }}" method="GET">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah User
        </button>
    </form>
</div>
@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none';">
            <button>X</button>
        </span>
    </div>
@endif
@if (session('deleteSuccess'))
    <div class="bg-red-100 border border-green-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('deleteSuccess') }}</span>
        
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none';">
            <button>X</button>
        </span>
    </div>
@endif

<div class="container-fluid">
    <div class="alert alert-light mb-2">
        <div class="row">
            <form class="d-flex" role="search">
                <input
                    class="form-control me-2"
                    type="search"
                    name="search"
                    placeholder="Cari nama atau email.."
                    aria-label="Search"
                />
                <button class="btn btn-outline-primary" type="submit">Search</button>
                <a href="{{ route('admin.user.index') }}">
                    <button class="btn btn-outline-danger ms-2">Reset</button>
                </a>
            </form>
        </div>
    </div>
</div>


<div class="card m-3">
    <div class="card-header"><h3 class="card-title">User</h3></div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered table-fixed">
        <thead>
            <tr>
                <th style="width: 50px">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->email }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.user.edit', $item->iduser) }}">
                        <button type="button" class="btn btn-sm btn-primary" onclick="window.location='#'">
                            <i class="fas fa-edit"></i>Edit
                        </button>
                    </a>
                    <a href="{{ route('admin.user.reset', $item->iduser) }}">
                        <button type="button" class="btn btn-sm btn-warning" onclick="window.location='#'">
                            <i class="fas fa-edit"></i>Reset Password
                        </button>
                    </a>
                    <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->iduser }}').submit(); }">
                        <i class="fas fa-edit"></i>Hapus
                    </button>
                    <form id="delete-form-{{ $item->iduser }}" action="{{ route('admin.user.delete', [$item->iduser]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
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
    <form action="{{ route('admin.pemilik.create') }}" method="GET" style="displaye: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah User
        </button>
    </form>
</div>
@endsection
