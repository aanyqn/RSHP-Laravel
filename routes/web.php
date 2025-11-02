<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\isAdministrator;
use App\Http\Middleware\isPemilik;
use App\Http\Middleware\isResepsionis;


Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

Route::get('/', [SiteController::class, 'index'])->name('sites.home');

Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/auth/login', [LoginController::class, 'login'])->name('login.post');

Auth::routes();

Route::middleware([isAdministrator::class])->group(function () {
    Route::get('/admin/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');

    Route::get('/admin/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('admin.pemilik.index');

    Route::get('/admin/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('admin.kategori.index');

    Route::get('/admin/kategori-klinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');

    Route::get('/admin/kode-tindakan-terapi', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'index'])->name('admin.kode-tindakan-terapi.index');

    Route::get('/admin/pet', [App\Http\Controllers\Admin\PetController::class, 'index'])->name('admin.pet.index');

    Route::get('/admin/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.role.index');

    Route::get('/admin/role-user', [App\Http\Controllers\Admin\RoleUserController::class, 'index'])->name('admin.role-user.index');

    Route::get('/admin/ras-hewan', [App\Http\Controllers\Admin\RasHewanController::class, 'index'])->name('admin.ras-hewan.index');

    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardAdminController::class, 'index'])->name('admin.dashboard-admin');
});

Route::middleware([isResepsionis::class])->group(function () {
    Route::get('/resepsionis/dashboard', [App\Http\Controllers\Resepsionis\DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard-resepsionis');
    
    Route::get('/resepsionis/reservasi', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'index'])->name('resepsionis.reservasi.index');

    Route::get('/resepsionis/registrasi', function () { return view ('resepsionis.registrasi'); })->name('resepsionis.registrasi');
    
    Route::get('/resepsionis/registrasi/pemilik', [App\Http\Controllers\Resepsionis\RegistrasiPemilikController::class, 'index'])->name('resepsionis.registrasi.pemilik.index');

    Route::get('/resepsionis/registrasi/pet', [App\Http\Controllers\Resepsionis\RegistrasiPetController::class, 'index'])->name('resepsionis.registrasi.pet.index');
});


Route::middleware('isDokter')->group(function () {
    Route::get('/dokter/dashboard', [App\Http\Controllers\Dokter\DashboardDokterController::class, 'index'])->name('dokter.dashboard-dokter');
});

Route::middleware('isPerawat')->group(function () {
    Route::get('/perawat/dashboard', [App\Http\Controllers\Perawat\DashboardPerawatController::class, 'index'])->name('perawat.dashboard-perawat');
});

Route::middleware([isPemilik::class])->group(function () {
    Route::get('/pemilik/dashboard', [App\Http\Controllers\Pemilik\DashboardPemilikController::class, 'index'])->name('pemilik.dashboard-pemilik');

    Route::get('/pemilik/daftar-pet', [App\Http\Controllers\Pemilik\DaftarPetController::class, 'index'])->name('pemilik.daftar-pet.index');
});


Route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');

Route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');

Route::get('/visimisi', [SiteController::class, 'visiMisi'])->name('visimisi');



