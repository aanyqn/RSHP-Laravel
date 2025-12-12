@extends('layouts.lte.main')
@section('title', 'Dokter')
@section('content')
@php
$breadcrumbs = [
    'Dashboard' => route('admin.dashboard-admin'),
    'Dokter' => route('admin.dokter.index'),
    'Edit' => null,
];
@endphp
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Dokter</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.dokter.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="iduser" value="{{ $id }}" required>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $dokter[0]->nama }}" placeholder="Masukkan nama" disabled>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ $dokter[0]->alamat }}" placeholder="Masukkan alamat" required>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No Handphone<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ $dokter[0]->no_hp }}" placeholder="Masukkan no Whatsapp" required>
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bidang_dokter" class="form-label">Bidang Dokter<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('bidang_dokter') is-invalid @enderror" id="bidang_dokter" name="bidang_dokter" value="{{ $dokter[0]->bidang_dokter }}"" placeholder="Masukkan bidang_dokter" required>
                            @error('bidang_dokter')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin<span class="text-danger">*</span></label><br>
                        <div
                        class="btn-group mb-2"
                        role="group"
                        aria-label="Basic radio toggle button group"
                        >
                        <input
                            type="radio"
                            class="btn-check"
                            name="jenis_kelamin"
                            id="jenis_kelamin_l"
                            value="L"
                            autocomplete="off"
                            {{ $dokter[0]->jenis_kelamin == 'L' ? 'checked' : '' }}
                        />
                        <label class="btn btn-outline-primary" for="jenis_kelamin_l">Pria</label>
                        <input
                            type="radio"
                            class="btn-check"
                            name="jenis_kelamin"
                            id="jenis_kelamin_p"
                            value="P"
                            autocomplete="off"
                            {{ $dokter[0]->jenis_kelamin == 'P' ? 'checked' : '' }}
                        />
                        <label class="btn btn-outline-primary" for="jenis_kelamin_p">Wanita</label>
                        </div><br><br>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">
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