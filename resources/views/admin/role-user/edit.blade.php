@extends('layouts.lte.main')
@section('title', 'Edit Role User')
@section('content')
@php
$breadcrumbs = [
    'Dashboard' => route('admin.dashboard-admin'),
    'Manajemen Role User' => route('admin.role-user.index'),
    'Edit' => null,
];
@endphp
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

                    <form action="{{ route('admin.role-user.edit-role-user') }}" method="POST">
                        @csrf
                        <input type="hidden" name="iduser" value="{{ $id }}">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $roleUsers[0]->nama }}" placeholder="Masukkan nama" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $roleUsers[0]->email }}" placeholder="Masukkan email" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Daftar Role Pengguna</label>
                            <ul class="list-group">
                                @if ($roleUsers[0]->idrole_user != null)
                                    @foreach($roleUsers as $roleUser)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">
                                            <i class="fas fa-user-tag text-muted mr-2"></i> {{ $roleUser->nama_role }}
                                        </span>
                                        <span class="badge {{ $roleUser->status ? 'badge-success bg-primary' : 'badge-secondary bg-warning' }} rounded-pill">
                                            {{ $roleUser->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                        <a href="{{ route('admin.role-user.delete-role-user', [$roleUser->idrole_user, $roleUser->iduser]) }}">
                                            <span class="badge badge-secondary bg-danger rounded-pill w-4 h-3">
                                                Hapus
                                            </span>
                                        </a>
                                    </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item text-center text-muted">
                                        <i class="fas fa-exclamation-circle"></i> Tidak ada role yang terdaftar
                                    </li>
                                @endif
                            </ul>
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
                        <label for="idrole" class="form-label">Tambah Role</label>
                            <div class="mb-3 row">
                                <div class="col-md-10">
                                    {{-- <input type="text" class="form-control @error('idrole') is-invalid @enderror" id="idrole" name="idrole" value="{{ old('idrole') }}" placeholder="Masukkan no Whatsapp" required> --}}
                                    <select class="form-control @error('idrole') is-invalid @enderror" id="idrole" name="idrole">
                                        <option value="">
                                            Pilih Role..
                                        </option>
                                        @forelse ($roles as $item)
                                        <option value="{{ $item->idrole }}">
                                            {{ $item->nama_role }}
                                        </option>
                                        @empty
                                        <option>
                                            Tidak ada data
                                        </option>
                                        @endforelse
                                    </select>
                                    @error('idrole')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i>Tambah
                                    </button>
                                </div>
                            </div>

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