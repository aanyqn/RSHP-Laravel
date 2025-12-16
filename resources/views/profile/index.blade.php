@extends('layouts.lte.main')
@section('title', 'Manajemen Role User')
@section('content')
@php
$breadcrumbs = [
    'Dashboard' => route('admin.dashboard-admin'),
    'Profile' => null,
];
@endphp

<div class="d-flex justify-content-between ms-3">
    @php
    $role = session('user_role')
    @endphp
    @if ($role == 1)
    <a href="{{ route('admin.dashboard-admin') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    @elseif ($role == 2)
    <a href="{{ route('dokter.dashboard-dokter') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    @elseif ($role == 3)
    <a href="{{ route('perawat.dashboard-perawat') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    @elseif ($role == 4)
    <a href="{{ route('resepsionis.dashboard-resepsionis') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    @else
    <a href="{{ route('pemilik.dashboard-pemilik') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    @endif
</div>
<div class="d-flex justify-content-center">
    <div class="card m-3 d-flex" style="width: 500px">
        <div class="card-header bg-primary"><h3 class="card-title text-white">My Profile</h3></div>
        <!-- /.card-header -->
        <div class="card-body d-flex flex-column align-items-center text-center pt-5 pb-5">
            <img
            src="{{ asset('assets/img/profile.jpeg') }}"
            class="rounded-circle d-flex jusrtify cantent wak meach" width="150cm"
            alt="User Image"
            />
            <div class="profile-info mt-3 ml-4">
                <h2 class="font-weight-bold text-dark mb-1">{{ session('user_name') }}</h2>
                <p class="text-muted mb-2 p-2" style="font-size: 1.1rem;">{{ session('user_role_name') }}</p>
                @if($info != null)
                    <div>
                        @forelse($info as $index => $item)
                            <p class="text-muted mb-2" style="font-size: 1.1rem;">{{ $item->bidang_dokter ?? $item->pendidikan ?? '' }}</p>
                            @if(!$item->jenis_kelamin)
                            @else
                            <p class="text-muted mb-2" style="font-size: 1.1rem;">{{ $item->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-Laki' }}</p>
                            @endif
                            <p class="text-muted mb-2" style="font-size: 1.1rem;">{{ $item->no_hp ?? $item->no_wa }}</p>
                            <p class="text-muted mb-2" style="font-size: 1.1rem;">{{ $item->alamat }}</p>
                        @empty
                        @endforelse
                    </div>
                @endif
                 
                <div>
                    <i class="fas fa-envelope text-muted mr-1"></i>
                    <a href="mailto:{{ session('user_email') }}" class="text-primary">{{ session('user_email') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection