@extends('layouts.app')
@section('title', 'Tambah Jenis Hewan')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Role</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.role.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_role" class="form-label">Nama Role<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_role') is-invalid @enderror" id="nama_role" name="nama_role" value="{{ old('nama_role') }}" placeholder="Masukkan role" required>
                            @error('nama_role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection