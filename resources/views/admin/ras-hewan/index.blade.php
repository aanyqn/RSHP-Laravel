@extends('layouts.lte.main')
@section('title', 'Ras Hewan')
@section('content')
@php
$breadcrumbs = [
    'Dashboard' => route('admin.dashboard-admin'),
    'Ras Hewan' => null,
];
@endphp
<div class="d-flex justify-content-between m-3 mt-0">
    <a href="{{ route('admin.dashboard-admin') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    <form action="{{ route('admin.ras-hewan.create') }}" method="GET">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Ras Hewan
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
    <div class="card-header"><h3 class="card-title">Ras Hewan</h3></div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jenis</th>
                <th>No</th>
                <th>Nama Ras</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @php
            // $current = $ras->jenisHewan->idjenis_hewan;
            $current = null;
            $i = 1;
        @endphp
        @foreach ($groupedRasHewan as $index => $rasHewan)
                @foreach ($rasHewan as $ras)
                <tr>
                    @if ($ras->jenisHewan->idjenis_hewan != $current)
                        <td rowspan="{{ count($rasHewan) }}">
                            {{ $ras->jenisHewan->nama_jenis_hewan }}
                        </td>
                    @endif
                    <td>{{ $i }}</td>
                    <td>{{ $ras->nama_ras }}</td>
                    <td>
                        <a href="{{ route('admin.ras-hewan.edit', $ras->idras_hewan) }}">
                        <button type="button" class="btn btn-sm btn-primary" onclick="window.location='#'">
                            <i class="fas fa-edit"></i>Edit
                        </button>
                        </a>
                            <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $ras->idras_hewan }}').submit(); }">
                            <i class="fas fa-edit"></i>Hapus
                        </button>
                            <form id="delete-form-{{ $ras->idras_hewan }}" action="{{ route('admin.ras-hewan.delete', [$ras->idras_hewan]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                        @php
                            $current = $ras->jenisHewan->idjenis_hewan;
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
@endsection

