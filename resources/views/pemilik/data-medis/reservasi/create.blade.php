@extends('layouts.lte.main')
@section('title', 'Buat Reservasi')
@section('content')
@php
    $breadcrumbs = [
        'Dashboard' => route('pemilik.dashboard-pemilik'),
        'Temu Dokter' => route('pemilik.data-medis.reservasi.index'),
        'Reservasi Baru' => null,
    ];
@endphp
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Reservasi</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('pemilik.data-medis.reservasi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="idpet" class="form-label">Pet<span class="text-danger">*</span></label>
                            {{-- <input type="text" class="form-control @error('idpet') is-invalid @enderror" id="idpet" name="idpet" value="{{ old('idpet') }}" placeholder="Masukkan no Whatsapp" required> --}}
                            <select class="form-control @error('idpet') is-invalid @enderror" id="idpet" name="idpet" name="idpet" required>
                                <option>
                                    Pilih Pet..
                                </option>
                                @forelse ($pets as $item)
                                <option value="{{ $item->idpet }}">
                                    {{ $item->nama }}
                                </option>
                                @empty
                                <option>
                                    Tidak ada data
                                </option>
                                @endforelse
                            </select>
                            @error('idpet')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idrole_user" class="form-label">Dokter<span class="text-danger">*</span></label>
                            {{-- <input type="text" class="form-control @error('idrole_user') is-invalid @enderror" id="idrole_user" name="idrole_user" value="{{ old('idrole_user') }}" placeholder="Masukkan no Whatsapp" required> --}}
                            <select class="form-control @error('idrole_user') is-invalid @enderror" id="idrole_user" name="idrole_user" name="idrole_user" required>
                                <option>
                                    Pilih Dokter..
                                </option>
                                @forelse ($dokter as $item)
                                <option value="{{ $item->idrole_user }}">
                                    {{ $item->nama }}
                                </option>
                                @empty
                                <option>
                                    Tidak ada data
                                </option>
                                @endforelse
                            </select>
                            @error('idrole_user')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pemilik.data-medis.reservasi.index') }}" class="btn btn-secondary">
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