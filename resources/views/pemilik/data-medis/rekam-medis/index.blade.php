@extends('layouts.lte.main')
@section('title', 'Daftar Rekam Medis')
@section('content')
@php
$breadcrumbs = [
    'Dashboard' => route('pemilik.dashboard-pemilik'),
    'Rekam Medis' => null,
];
@endphp
<div class="d-flex justify-content-between m-3">
    <a href="{{ route('pemilik.dashboard-pemilik') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
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
                        1 Minggu terakhir
                    </option>
                    <option value="3" {{ request('date') == 3 ? 'selected' : ''}}>
                        1 Bulan terakhir
                    </option>
                    <option value="4" {{ request('date') == 4 ? 'selected' : ''}}>
                        3 Bulan Terakhir
                    </option>
                    <option value="5" {{ request('date') == 5 ? 'selected' : ''}}>
                        Semua
                    </option>
                </select>
                <button class="btn btn-outline-primary me-2" type="submit">Filter</button>
                <a href="{{ route('pemilik.data-medis.rekam-medis.index') }}">
                    <span class="btn btn-outline-danger">Reset</span>
                </a>
            </form>
        </div>
    </div>
</div>
@forelse($daftarRekamMedis as $index => $rekamMedis)
<div class="card m-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Rekam Medis : {{ $index + 1 }}</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('pemilik.data-medis.rekam-medis.detail.index', [$rekamMedis->idrekam_medis]) }}">
                <button type="button" class="btn btn-sm btn-success" onclick="window.location='#'">
                    <i class="fas fa-edit"></i>Detail
                </button>
            </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
    <table class="table table-striped table-fixed">
        <tbody>
            <tr>
                <th>Nama Peliharaan :</th>
                <td>{{ $rekamMedis->nama }}</td>
            </tr>
            <tr>
                <th>Anamnesa :</th>
                <td>{{ $rekamMedis->anamnesa }}</td>
            </tr>
            <tr>
                <th>Temuan Klinis :</th>
                <td>{{ $rekamMedis->temuan_klinis }}</td>
            </tr>
            <tr>
                <th>Diagnosa :</th>
                <td>{{ $rekamMedis->diagnosa }}</td>
            </tr>
            <tr>
                <th>Kode Reservasi :</th>
                <td>{{ $rekamMedis->idreservasi_dokter }}</td>
            </tr>
            <tr>
                <th>Dokter Pemeriksa :</th>
                <td>{{ $rekamMedis->dokter }}</td>
            </tr>
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
</div>
@empty
<div class="card m-4">
    <div class="card-header">
    <h3 class="card-title">Rekam Medis : -</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
    <table class="table table-striped">
        <tbody>
            <tr>
                <td>Tidak ada data</td>
            </tr>
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
</div>
@endforelse




@endsection