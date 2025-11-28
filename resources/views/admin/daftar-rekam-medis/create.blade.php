@extends('layouts.lte.main')
@section('title', 'Tambah Rekam Medis')
@section('content')
@php
    $breadcrumbs = [
        'Dashboard' => route('admin.dashboard-admin'),
        'Rekam Medis' => route('admin.rekam-medis.index'),
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

                    <form action="{{ route('admin.temu-dokter.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="idreservasi_dokter" class="form-label">Reservasi<span class="text-danger">*</span></label>
                            {{-- <input type="text" class="form-control @error('idreservasi_dokter') is-invalid @enderror" id="idreservasi_dokter" name="idreservasi_dokter" value="{{ old('idreservasi_dokter') }}" placeholder="Masukkan no Whatsapp" required> --}}
                            <select class="form-control @error('idreservasi_dokter') is-invalid @enderror" id="idreservasi_dokter" name="idreservasi_dokter" name="idreservasi_dokter" required>
                                <option>
                                    Pilih berdasarkan kode reservasi..
                                </option>
                                @forelse ($reservasi as $item)
                                <option value="{{ $item->idreservasi_dokter }}">
                                    {{ $item->nama }}
                                </option>
                                @php
                                $dokter = $item->dokter;
                                @endphp
                                @empty
                                <option>
                                    Tidak ada data
                                </option>
                                @endforelse
                            </select>
                            @error('idreservasi_dokter')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Dokter Pemeriksa</label>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">
                                        <i class="fas fa-user-tag text-muted mr-2"></i> {{ $dokter }}
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.temu-dokter.index') }}" class="btn btn-secondary">
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