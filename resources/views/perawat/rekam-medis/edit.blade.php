@extends('layouts.lte.main')
@section('title', 'Edit Rekam Medis')
@section('content')
@php
    $breadcrumbs = [
        'Dashboard' => route('perawat.dashboard-perawat'),
        'Rekam Medis' => route('perawat.rekam-medis.index'),
        'Edit' => null,
    ];
@endphp
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Rekam Medis</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('perawat.rekam-medis.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="idrekam_medis" id="idrekam_medis" value="{{ $id }}">
                        <div class="mb-3">
                            <label for="anamnesa" class="form-label">Anamnesa<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('anamnesa') is-invalid @enderror" id="anamnesa" name="anamnesa" value="{{ $data[0]->anamnesa }}" placeholder="Masukkan nama jenis hewan baru" required>
                            @error('anamnesa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="diagnosa" class="form-label">Diagnosa<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" name="diagnosa" value="{{ $data[0]->diagnosa }}" placeholder="Masukkan nama jenis hewan baru" required>
                            @error('diagnosa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="temuan_klinis" class="form-label">Temuan Klinis<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('temuan_klinis') is-invalid @enderror" id="temuan_klinis" name="temuan_klinis" value="{{ $data[0]->temuan_klinis }}" placeholder="Masukkan nama jenis hewan baru" required>
                            @error('temuan_klinis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary">
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