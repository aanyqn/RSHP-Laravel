@extends('layouts.lte.main')
@section('title', 'Daftar Rekam Medis')
@section('content')
@php
$breadcrumbs = [
    'Dashboard' => route('admin.dashboard-admin'),
    'Rekam Medis' => null,
];
@endphp
<div class="d-flex justify-content-between m-3">
    <a href="{{ route('admin.dashboard-admin') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    <form action="{{ route('admin.rekam-medis.create') }}" method="GET">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Rekam Medis
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
@forelse($daftarRekamMedis as $index => $rekamMedis)
<div class="card m-4">
    <div class="card-header">
    <h3 class="card-title">Rekam Medis : {{ $index + 1 }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
    <table class="table table-striped">
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
<div class="card mb-4">
    <div class="card-header">
    <h3 class="card-title">Rekam Medis : {{ $index + 1 }}</h3>
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