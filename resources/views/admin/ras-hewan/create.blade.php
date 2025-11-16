@extends('layouts.lte.main')
@section('title', 'Tambah Ras Hewan')
@section('content')
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Ras Hewan</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="idjenis_hewan" class="form-label">Jenis<span class="text-danger">*</span></label>
                            {{-- <input type="text" class="form-control @error('idjenis_hewan') is-invalid @enderror" id="idjenis_hewan" name="idjenis_hewan" value="{{ old('idjenis_hewan') }}" placeholder="Masukkan no Whatsapp" required> --}}
                            <select class="form-control @error('idjenis_hewan') is-invalid @enderror" id="idjenis_hewan" name="idjenis_hewan" name="idjenis_hewan" required>
                                <option>
                                    Pilih jenis..
                                </option>
                                @forelse ($jenis as $item)
                                <option value="{{ $item->idjenis_hewan }}">
                                    {{ $item->nama_jenis_hewan }}
                                </option>
                                @empty
                                <option>
                                    Tidak ada data
                                </option>
                                @endforelse
                            </select>
                            @error('idpemilik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_ras" class="form-label">Nama Ras Hewan<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_ras') is-invalid @enderror" id="nama_ras" name="nama_ras" value="{{ old('nama_ras') }}" placeholder="Masukkan ras-hewan" required>
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