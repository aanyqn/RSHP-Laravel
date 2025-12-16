@extends('layouts.lte.main')
@section('title', 'Tambah Jenis Hewan')
@section('content')
@php
$breadcrumbs = [
    'Dashboard' => route('perawat.dashboard-perawat'),
    'Rekam Medis' => route('perawat.rekam-medis.index'),
    'Detail Rekam Medis' => null,
];
@endphp
<div class="d-flex justify-content-between m-3 mt-0">
    <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-primary">
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
    <div class="card-header"><h3 class="card-title">Riwayat Rekam Medis</h3></div>
    <div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">Kode Tindakan</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Kategori Klinis</th>
                <th>Detail</th>
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
        @forelse ($detailRekamMedis as $index => $detail)
            <tr class="align-middle">
                <td>{{ $detail->kode }}</td>
                <td>{{ $detail->deskripsi_tindakan_terapi }}</td>
                <td>{{ $detail->nama_kategori }}</td>
                <td>{{ $detail->nama_kategori_klinis }}</td>
                <td>{{ $detail->detail }}</td>
                {{-- <td>
                    <a href="{{ route('perawat.rekam-medis.detail.edit', $detail->iddetail_rekam_medis) }}">
                        <button type="button" class="btn btn-sm btn-primary" onclick="window.location='#'">
                            <i class="fas fa-edit"></i>Edit
                        </button>
                    </a>
                    
                    <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $detail->iddetail_rekam_medis }}').submit(); }">
                        <i class="fas fa-edit"></i>Hapus
                    </button>
                    <form id="delete-form-{{ $detail->iddetail_rekam_medis }}" action="{{ route('perawat.rekam-medis.detail.delete', [$detail->iddetail_rekam_medis]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td> --}}
            </tr>
        @empty
        <tr>
            <td colspan="5">Tidak ada riwayat rekam medis</td>
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