@extends('layouts.lte.main')
@section('title', 'Edit Rekam Medis')
@section('content')
@php
    $breadcrumbs = [
        'Dashboard' => route('dokter.dashboard-dokter'),
        'Rekam Medis' => route('dokter.rekam-medis.index'),
        'Detail Rekam Medis' => route('dokter.rekam-medis.detail.index', [$id]),
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

                    <form action="{{ route('dokter.rekam-medis.detail.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="iddetail_rekam_medis" id="iddetail_rekam_medis" value="{{ $id }}">
                        <input type="hidden" name="idrekam_medis" id="idrekam_medis" value="{{ $detail_rekam_medis[0]->idrekam_medis }}">
                        <div class="mb-3">
                            <label for="idkode_tindakan_terapi" class="form-label">Aksi<span class="text-danger">*</span></label>
                            {{-- <input type="text" class="form-control @error('idkode_tindakan_terapi') is-invalid @enderror" id="idkode_tindakan_terapi" name="idkode_tindakan_terapi" value="{{ old('idkode_tindakan_terapi') }}" placeholder="Masukkan no Whatsapp" required> --}}
                            <select class="form-control @error('idkode_tindakan_terapi') is-invalid @enderror" id="idkode_tindakan_terapi" name="idkode_tindakan_terapi" name="idkode_tindakan_terapi" required>
                                <option>
                                    Pilih Aksi..
                                </option>
                                @forelse ($kode_tindakan_terapi as $item)
                                <option value="{{ $item->idkode_tindakan_terapi }}" {{ $item->idkode_tindakan_terapi == $detail_rekam_medis[0]->idkode_tindakan_terapi ? 'selected' : '' }}>
                                    {{ $item->deskripsi_tindakan_terapi }}
                                </option>
                                @empty
                                <option>
                                    Tidak ada data
                                </option>
                                @endforelse
                            </select>
                            @error('idkode_tindakan_terapi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="detail" class="form-label">Detail<span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail" placeholder="Berikan detail rekaman" required>{{ $detail_rekam_medis[0]->detail }}</textarea>
                            @error('detail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dokter.rekam-medis.detail.index', [$detail_rekam_medis[0]->idrekam_medis]) }}" class="btn btn-secondary">
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