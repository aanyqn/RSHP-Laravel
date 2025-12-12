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
    <div class="row ms-1 me-1">
      <div class="alert alert-light" role="alert">
        Selamat datang <strong>{{ session('user_name') }}</strong>!
      </div>
    </div>

    <div class="row justify-content-center mb-5">
      @forelse($temu_dokter as $item)
        <div class="alert alert-light" role="alert">
          <div class="mb-2">
            <h5>Reservasi Hari Ini</h5>
          </div>
          <div class="accordion" id="reservasi">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button
                  class="accordion-button"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseOne"
                  aria-expanded="true"
                  aria-controls="collapseOne"
                >
                  KODE RESERVASI: {{ $item->idreservasi_dokter }}
                </button>
              </h2>
              <div
                id="collapseOne"
                class="accordion-collapse collapse show"
                data-bs-parent="#reservasi"
              >
                <div class="accordion-body">
                  <p>No Urut: {{ $item->no_urut }}</p>
                  <p>Nama: {{ $item->nama }}</p>
                  <p>Tanggal reservasi: {{ $item->waktu_daftar }}</p>
                  <p>Dokter pemeriksa: {{ $item->dokter }}</p>
                  <span>Status: {{ $item->status ? 'Belum' : 'Selesai' }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    @empty
    
    @endforelse
  <!--end::Container-->
</div>
<!--end::App Content-->
@endsection
