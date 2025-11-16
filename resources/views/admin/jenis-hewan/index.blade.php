@extends('layouts.lte.main')
@section('content')

<div class="m-3">
    <a href="{{ route('admin.dashboard-admin') }}" method="GET" style="displaye: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Back
        </button>
    </a>
</div>

<div class="card m-3">
    <div class="card-header"><h3 class="card-title">Jenis Hewan</h3></div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        {{-- <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>Task</th>
            <th>Progress</th>
            <th style="width: 40px">Label</th>
        </tr>
        </thead> --}}
        <thead>
            <tr>
                <th style="width: 10px">No</th>
                <th>Jenis Hewan</th>
                <th>Aksi</th>
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
        @foreach ($jenisHewan as $index => $hewan)
            <tr class="align-middle">
                <td>{{ $index + 1 }}</td>
                <td>{{ $hewan->nama_jenis_hewan }}</td>
                <td>
                    <a href="{{ route('admin.jenis-hewan.edit', $hewan->idjenis_hewan) }}">
                        <button type="button" class="btn btn-sm btn-primary" onclick="window.location='#'">
                            <i class="fas fa-edit"></i>Edit
                        </button>
                    </a>
                    
                    <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $hewan->idjenis_hewan }}').submit(); }">
                        <i class="fas fa-edit"></i>Hapus
                    </button>
                    <form id="delete-form-{{ $hewan->idjenis_hewan }}" action="#" method="POST" style="display: none;">
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
    <form action="{{ route('admin.jenis-hewan.create') }}" method="GET" style="displaye: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jenis Hewan
        </button>
    </form>
</div>

@endsection