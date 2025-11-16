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
                            <form id="delete-form-{{ $ras->idras_hewan }}" action="#" method="POST" style="display: none;">
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

<div class="m-3">
    <form action="{{ route('admin.ras-hewan.create') }}" method="GET" style="displaye: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Ras
        </button>
    </form>
</div>
@endsection

