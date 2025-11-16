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
    <div class="card-header"><h3 class="card-title">Kategori Klinis</h3></div>
    <!-- /.card-header -->
    <div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori Klinis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($kategoriKlinis as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_kategori_klinis }}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary" onclick="window.location='#'">
                        <i class="fas fa-edit"></i>Edit
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->idkategori_klinnis }}').submit(); }">
                        <i class="fas fa-edit"></i>Hapus
                    </button>
                    <form id="delete-form-{{ $item->idkategori_klinnis }}" action="#" method="POST" style="display: none;">
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
    <form action="{{ route('admin.kategori-klinis.create') }}" method="GET" style="displaye: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori Klinis
        </button>
    </form>
</div>

@endsection

