@extends('layouts.lte.main')

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </div>
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<!--end::App Content Header-->
<!--begin::App Content-->
<div class="app-content">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row justify-content-center">
      <!--begin::Col-->
      <div class="col-lg-3 col-6">
        <!--begin::Small Box Widget 1-->
        <div class="small-box bg-white">
          <div class="inner text-center">
            <h3>{{ $total_reservasi }}</h3>
            <p>Reservasi</p>
            <span class="rounded-1 text-white bg-success ps-3 pe-3">{{ $total_reservasi_selesai }} selesai</span>
          </div>
          <a
            href="{{ route('resepsionis.reservasi.index') }}"
            class="small-box-footer bg-primary rounded-bottom-2 link-light link-underline-opacity-0 link-underline-opacity-50-hover"
          >
            Cek <i class="bi bi-link-45deg"></i>
          </a>
        </div>
        <!--end::Small Box Widget 1-->
      </div>
      <!--end::Col-->
    </div>
    <!--end::Row-->
    <div class="row ms-1 me-1">
      <div class="alert alert-light" role="alert">
        Selamat datang <strong>{{ session('user_name') }}</strong>!
      </div>
    </div>
    <div class="row ms-1 me-1">
      <div class="alert alert-primary" role="alert">
        <strong>Quick Action</strong>
        <ul>
          <li>
            <a href="{{ route('resepsionis.reservasi.create') }}">Tambah Reservasi</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--end::Container-->
</div>
<!--end::App Content-->
@endsection
