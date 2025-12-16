@extends('layouts.lte.main')
@section('title', 'Reservasi')
@section('content')
@php
$breadcrumbs = [
    'Dashboard' => route('pemilik.dashboard-pemilik'),
    'Reservasi' => null,
];
@endphp
<div class="d-flex justify-content-between m-3 mt-0">
    <a href="{{ route('pemilik.dashboard-pemilik') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    <form action="{{ route('pemilik.data-medis.reservasi.create') }}" method="GET">
        <button type="submit" class="btn btn-primary {{ count($daftar_temu_dokter) == 0 ? '' : 'disabled' }}">
            <i class="fas fa-plus"></i> Buat reservasi
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

<div class="container-fluid">
    <div class="alert alert-light mb-2">
        <div class="row">
            <form class="d-flex" role="search">
                <input
                    class="form-control me-2"
                    type="search"
                    name="search"
                    placeholder="Cari nama pet atau dokter pemeriksa.."
                    aria-label="Search"
                />
                <button class="btn btn-outline-primary me-2" type="submit">Search</button>
                <select class="form-control me-2 @error('date') is-invalid @enderror" id="date" name="date" name="date">
                    <option value="">
                        Pilih berdasarkan waktu..
                    </option>
                    <option value="1" {{ request('date') == 1 ? 'selected' : ''}}>
                        Hari ini
                    </option>
                    <option value="2" {{ request('date') == 2 ? 'selected' : ''}}>
                        Kemarin
                    </option>
                    <option value="3" {{ request('date') == 3 ? 'selected' : ''}}>
                        1 Minggu Terakhir
                    </option>
                    <option value="4" {{ request('date') == 4 ? 'selected' : ''}}>
                        1 Bulan Terakhir
                    </option>
                    <option value="5" {{ request('date') == 5 ? 'selected' : ''}}>
                        Semua
                    </option>
                </select>
                <button class="btn btn-outline-primary me-2" type="submit">Filter</button>
                <a href="{{ route('pemilik.data-medis.reservasi.index') }}">
                    <span class="btn btn-outline-danger">Reset</span>
                </a>
            </form>
        </div>
    </div>
</div>
<div class="card m-3">
    <div class="card-header"><h3 class="card-title">Reservasi Saya</h3></div>
    <div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No. Antrian</th>
                <th>Kode Reservasi</th>
                <th>Nama Pet</th>
                <th>Waktu Pendaftaran</th>
                <th>Status</th>
                <th>Dokter Pemeriksa</th>
            </tr>
        </thead>
        <tbody>
        {{-- <tr class="align-middle">
            <td>1.</td>
            <td>Update software</td>
            <td>
            <div class="progress progress-xs">
                <div
                class="progress-bar progress-bar-danger"
                style="width: 55%"
                ></div>
            </div>
            </td>
            <td><span class="badge text-bg-danger">55%</span></td>
        </tr> --}}
        @forelse ($daftar_temu_dokter as $index => $temu_dokter)
            <tr class="align-middle">
                <td>{{ $temu_dokter->no_urut }}</td>
                <td>{{ $temu_dokter->idreservasi_dokter }}</td>
                <td>{{ $temu_dokter->nama }}</td>
                <td>{{ $temu_dokter->waktu_daftar }}</td>
                <td class="{{ $temu_dokter->status ? 'bg-danger' : 'bg-success' }}">
                    <span class="text-white text-center">
                        {{ $temu_dokter->status ? 'Belum' : 'Selesai' }}
                    </span>
                </td>
                <td>{{ $temu_dokter->dokter }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada reservasi</td>
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