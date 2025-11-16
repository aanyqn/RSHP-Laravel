@extends('layouts.lte.main')
@section('title', 'Edit Pemilik')
@section('content')
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Pet</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        {{-- ['nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idpemilik', 'idras_hewan'] --}}
                    <form action="{{ route('admin.pet.update') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $id }}" name="idpet" required>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal lahir<span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="warna_tanda" class="form-label">Warna<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('warna_tanda') is-invalid @enderror" id="warna_tanda" name="warna_tanda" value="{{ old('warna_tanda') }}" placeholder="Masukkan Warna" required>
                            @error('warna_tanda')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label d-block">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>

                            <div class="form-check">
                                <input type="radio" value="L" id="laki" name="jenis_kelamin"
                                    class="form-check-input @error('jenis_kelamin') is-invalid @enderror" required>
                                <label class="form-check-label" for="laki">Laki-laki</label>
                            </div>

                            <div class="form-check">
                                <input type="radio" value="P" id="perempuan" name="jenis_kelamin"
                                    class="form-check-input @error('jenis_kelamin') is-invalid @enderror" required>
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>

                            @error('jenis_kelamin')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="idpemilik" class="form-label">Pemilik<span class="text-danger">*</span></label>
                            {{-- <input type="text" class="form-control @error('idpemilik') is-invalid @enderror" id="idpemilik" name="idpemilik" value="{{ old('idpemilik') }}" placeholder="Masukkan no Whatsapp" required> --}}
                            <select class="form-control @error('idpemilik') is-invalid @enderror" id="idpemilik" name="idpemilik" name="idpemilik" required>
                                <option>
                                    Pilih pemilik..
                                </option>
                                @forelse ($pemilik as $item)
                                <option value="{{ $item->idpemilik }}">
                                    {{ $item->user->nama }}
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
                            <label for="idras_hewan" class="form-label">Ras Hewan<span class="text-danger">*</span></label>
                            {{-- <input type="text" class="form-control @error('idras_hewan') is-invalid @enderror" id="idras_hewan" name="idras_hewan" value="{{ old('idras_hewan') }}" placeholder="Masukkan no Whatsapp" required> --}}
                            <select class="form-control @error('idras_hewan') is-invalid @enderror" id="idras_hewan" name="idras_hewan" name="idras_hewan" required>
                                <option>
                                    Pilih ras..
                                </option>
                                @forelse ($ras as $item)
                                <option value="{{ $item->idras_hewan }}">
                                    {{ $item->nama_ras }}
                                </option>
                                @empty
                                <option>
                                    Tidak ada data
                                </option>
                                @endforelse
                            </select>
                            @error('idras_hewan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- <p>Ras</p>
                        <select name="idras_hewan" required>
                            <option value="">Choose an option</option>
                            
                            foreach ($result as $row) {
                            ?>
                            <option value=" echo $row['idras_hewan']?>"> echo $row['nama_ras']?></option>
                            
                            }
                            ?>
                        </select><br><br> --}}

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">
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