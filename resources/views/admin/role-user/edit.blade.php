@extends('layouts.lte.main')
@section('title', 'Edit User')
@section('content')
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="#" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $userInfo[0]->nama }}" placeholder="Masukkan nama" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $userInfo[0]->email }}" placeholder="Masukkan email" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- <div class="mb-3"> --}}
                            {{-- <label for="idrole" class="form-label">Role<span class="text-danger">*</span></label> --}}
                            {{-- <input type="text" class="form-control @error('idrole') is-invalid @enderror" id="idrole" name="idrole" value="{{ old('idrole') }}" placeholder="Masukkan no Whatsapp" required> --}}
                            {{-- <select class="form-control @error('idrole') is-invalid @enderror" id="idrole" name="idrole" name="idrole" required>
                                <option>
                                    Pilih Role..
                                </option>
                                @forelse ($role as $item)
                                <option value="{{ $item->idrole }}">
                                    {{ $item->nama_role }}
                                </option>
                                @empty
                                <option>
                                    Tidak ada data
                                </option>
                                @endforelse
                            </select> --}}
                            {{-- @error('idrole')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror --}}
                        {{-- </div> --}}

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.role-user.index') }}" class="btn btn-secondary">
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