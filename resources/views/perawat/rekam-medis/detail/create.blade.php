@extends('layouts.lte.main')
@section('title', 'Tambah Rekam Medis')
@section('content')
@php
    $breadcrumbs = [
        'Dashboard' => route('perawat.dashboard-perawat'),
        'Rekam Medis' => route('perawat.rekam-medis.index'),
        'Detail Rekam Medis' => route('perawat.rekam-medis.detail.index', [$id]),
        'Tambah' => null,
    ];
@endphp
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Rekam Medis</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('perawat.rekam-medis.detail.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="idrekam_medis" id="idrekam_medis" value="{{ $id }}">
                        <div class="mb-3">
                            <label for="idkode_tindakan_terapi" class="form-label">Aksi<span class="text-danger">*</span></label>
                            {{-- <input type="text" class="form-control @error('idkode_tindakan_terapi') is-invalid @enderror" id="idkode_tindakan_terapi" name="idkode_tindakan_terapi" value="{{ old('idkode_tindakan_terapi') }}" placeholder="Masukkan no Whatsapp" required> --}}
                            <select class="form-control @error('idkode_tindakan_terapi') is-invalid @enderror" id="idkode_tindakan_terapi" name="idkode_tindakan_terapi" name="idkode_tindakan_terapi" required>
                                <option>
                                    Pilih Aksi..
                                </option>
                                @forelse ($kode_tindakan_terapi as $item)
                                <option value="{{ $item->idkode_tindakan_terapi }}">
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
                            <textarea type="text" class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail" value="{{ old('detail') }}" placeholder="Berikan detail rekaman" required></textarea>
                            @error('detail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('perawat.rekam-medis.detail.index', [$id]) }}" class="btn btn-secondary">
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