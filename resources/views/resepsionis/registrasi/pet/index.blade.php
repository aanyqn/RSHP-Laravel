@extends('layouts.lte.main')
@section('title', 'Pet')
@section('content')
@php
$breadcrumbs = [
    'Dashboard' => route('resepsionis.dashboard-resepsionis'),
    'Pet' => null,
];
@endphp
<div class="d-flex justify-content-between m-3 mt-0">
    <a href="{{ route('resepsionis.dashboard-resepsionis') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    <form action="{{ route('resepsionis.registrasi.pet.create') }}" method="GET">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pet
        </button>
    </form>
</div>
@if (session('success'))
    <div class="bg-green-200 border border-green-300 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none';">
            <button>X</button>
        </span>
    </div>
@endif
@if (session('deleteSuccess'))
    <div class="bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('deleteSuccess') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none';">
            <button>X</button>
        </span>
    </div>
@endif
<div class="card m-3">
    <div class="card-header"><h3 class="card-title">Pet</h3></div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Warna</th>
                <th>Jenis Kelamin</th>
                <th>Pemilik</th>
                <th>Ras</th>
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
                <td>{{ $pet->pemilik->user->nama }}</td>
                <td>{{ $pet->rasHewan->nama_ras }}</td>
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