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

                    <form action="{{ route('admin.rekam-medis.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="idreservasi_dokter" class="form-label">Reservasi<span class="text-danger">*</span></label>
                            {{-- <input type="text" class="form-control @error('idreservasi_dokter') is-invalid @enderror" id="idreservasi_dokter" name="idreservasi_dokter" value="{{ old('idreservasi_dokter') }}" placeholder="Masukkan no Whatsapp" required> --}}
                            <select class="form-control @error('idreservasi_dokter') is-invalid @enderror" id="idreservasi_dokter" name="idreservasi_dokter" name="idreservasi_dokter" required>
                                <option>
                                    Pilih berdasarkan kode reservasi..
                                </option>
                                @forelse ($reservasi as $item)
                                <option value="{{ $item->idreservasi_dokter }}" data-dokter="{{ $item->dokter }}" id-dokter="{{ $item->idrole_user }}">
                                    {{ $item->nama }}
                                </option>
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
                            <div class="form-control bg-white" id="dokter-text">
                                -
                            </div>
                        </div>

                        <input type="hidden" name="dokter_pemeriksa" id="dokter-id">

                        <div class="mb-3">
                            <label for="anamnesa" class="form-label">Anamnesa<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('anamnesa') is-invalid @enderror" id="anamnesa" name="anamnesa" value="{{ old('anamnesa') }}" placeholder="Masukkan anamnesa" required>
                            @error('anamnesa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="diagnosa" class="form-label">Diagnosa<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" name="diagnosa" value="{{ old('diagnosa') }}" placeholder="Masukkan diagnosa" required>
                            @error('diagnosa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="temuan_klinis" class="form-label">Temuan Klinis<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('temuan_klinis') is-invalid @enderror" id="temuan_klinis" name="temuan_klinis" value="{{ old('temuan_klinis') }}" placeholder="Masukkan temuan klinis" required>
                            @error('temuan_klinis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-secondary">
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
<script>
document.getElementById('idreservasi_dokter').addEventListener('change', function () {
    let selectedOption = this.options[this.selectedIndex];
    let dokter = selectedOption.getAttribute('data-dokter');
    let dokter_id = selectedOption.getAttribute('id-dokter');
    document.getElementById('dokter-text').textContent = dokter ?? '-';
    document.getElementById('dokter-id').value = dokter_id ?? '';
});
</script>
@endsection