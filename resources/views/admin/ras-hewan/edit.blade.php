@extends('layouts.lte.main')
@section('title', 'Edit Ras Hewan')
@section('content')
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Ras Hewan</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.ras-hewan.update') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $id }}" name="idras_hewan" required>

                        <div class="mb-3">
                            <label for="nama_ras" class="form-label">Nama Ras Hewan<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_ras') is-invalid @enderror" id="nama_ras" name="nama_ras" value="{{ old('nama_ras') }}" placeholder="Masukkan ras hewan baru" required>
                            @error('nama_ras')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">
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