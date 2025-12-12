@extends('layouts.lte.main')
@section('title', 'Perawat')
@section('content')
@php
$breadcrumbs = [
    'Dashboard' => route('admin.dashboard-admin'),
    'Perawat' => null,
];
@endphp
<div class="d-flex justify-content-between m-3 mt-0">
    <a href="{{ route('admin.dashboard-admin') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    <form action="{{ route('admin.perawat.create') }}" method="GET">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Data Perawat
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
                    placeholder="Cari nama atau no HP.."
                    aria-label="Search"
                />
                <button class="btn btn-outline-primary" type="submit">Search</button>
                <a href="{{ route('admin.perawat.index') }}">
                    <button class="btn btn-outline-danger ms-2">Reset</button>
                </a>
            </form>
        </div>
    </div>
</div>

<div class="card m-3">
    <div class="card-header"><h3 class="card-title">Perawat</h3></div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered table-fixed">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Perawat</th>
                <th>Alamat</th>
                <th>No Handphone</th>
                <th>Bidang Perawat</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($data_perawat as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->no_hp }}</td>
                <td>{{ $item->pendidikan }}</td>
                <td>{{ $item->jenis_kelamin == 'L' ? 'Pria' : 'Wanita' }}</td>
                <td><span class="rounded-pill ps-2 pe-2 text-light {{ $item->status ? 'bg-success' : 'bg-danger' }}">{{ $item->status ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                <td>
                    <a href="{{ route('admin.perawat.edit', $item->id_user) }}">
                        <button type="button" class="btn btn-sm btn-primary" onclick="window.location='#'">
                            <i class="fas fa-edit"></i>Edit
                        </button>
                    </a>
                    <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->id_perawat }}').submit(); }">
                        <i class="fas fa-edit"></i>Hapus
                    </button>
                    <form id="delete-form-{{ $item->id_perawat }}" action="{{ route('admin.perawat.delete', [$item->id_perawat]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">Tidak Ada Data Perawat</td>
        </tr>
        @endforelse
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
