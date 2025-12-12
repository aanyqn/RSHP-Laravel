@extends('layouts.lte.main')
@section('title', 'Pemilik')
@section('content')
@php
$breadcrumbs = [
    'Dashboard' => route('resepsionis.dashboard-resepsionis'),
    'Pemilik' => null,
];
@endphp
<div class="d-flex justify-content-between m-3 mt-0">
    <a href="{{ route('resepsionis.dashboard-resepsionis') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    <form action="{{ route('resepsionis.registrasi.pemilik.create') }}" method="GET">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pemilik
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
<div class="card m-3">
    <div class="card-header"><h3 class="card-title">Pemilik</h3></div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemilik</th>
                <th>No WA</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($pemilik as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->user->nama }}</td>
                <td>{{ $item->no_wa }}</td>
                <td>{{ $item->alamat }}</td>
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
@endsection
