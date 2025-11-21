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

Route::get('/auth/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::middleware([isAdministrator::class])->group(function () {
    Route::get('/admin/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');
        Route::get('/admin/jenis-hewan/create', [App\Http\Controllers\Admin\JenisHewanController::class, 'create'])->name('admin.jenis-hewan.create');
        Route::post('/admin/jenis-hewan/store', [App\Http\Controllers\Admin\JenisHewanController::class, 'store'])->name('admin.jenis-hewan.store');
        Route::get('/admin/jenis-hewan/edit/{id}', [App\Http\Controllers\Admin\JenisHewanController::class, 'edit'])->name('admin.jenis-hewan.edit');
        Route::post('/admin/jenis-hewan/update', [App\Http\Controllers\Admin\JenisHewanController::class, 'update'])->name('admin.jenis-hewan.update');
        Route::delete('/admin/jenis-hewan/delete/{id}', [App\Http\Controllers\Admin\JenisHewanController::class, 'destroy'])->name('admin.jenis-hewan.delete');

    Route::get('/admin/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('admin.pemilik.index');
        Route::get('/admin/pemilik/create', [App\Http\Controllers\Admin\PemilikController::class, 'create'])->name('admin.pemilik.create');
        Route::post('/admin/pemilik/store', [App\Http\Controllers\Admin\PemilikController::class, 'store'])->name('admin.pemilik.store');
        Route::get('/admin/pemilik/edit/{id}', [App\Http\Controllers\Admin\PemilikController::class, 'edit'])->name('admin.pemilik.edit');
        Route::post('/admin/pemilik/update', [App\Http\Controllers\Admin\PemilikController::class, 'update'])->name('admin.pemilik.update');
        Route::delete('/admin/pemilik/delete/{idpemilik}/{iduser}', [App\Http\Controllers\Admin\PemilikController::class, 'destroy'])->name('admin.pemilik.delete');

    Route::get('/admin/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('admin.kategori.index');
        Route::get('/admin/kategori/create', [App\Http\Controllers\Admin\KategoriController::class, 'create'])->name('admin.kategori.create');
        Route::post('/admin/kategori/store', [App\Http\Controllers\Admin\KategoriController::class, 'store'])->name('admin.kategori.store');
        Route::get('/admin/kategori/edit/{id}', [App\Http\Controllers\Admin\KategoriController::class, 'edit'])->name('admin.kategori.edit');
        Route::post('/admin/kategori/update', [App\Http\Controllers\Admin\KategoriController::class, 'update'])->name('admin.kategori.update');
        Route::delete('/admin/kategori/delete/{id}', [App\Http\Controllers\Admin\KategoriController::class, 'destroy'])->name('admin.kategori.delete');

    Route::get('/admin/kategori-klinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');
        Route::get('/admin/kategori-klinis/create', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'create'])->name('admin.kategori-klinis.create');
        Route::post('/admin/kategori-klinis/store', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'store'])->name('admin.kategori-klinis.store');

    Route::get('/admin/kode-tindakan-terapi', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'index'])->name('admin.kode-tindakan-terapi.index');

    Route::get('/admin/pet', [App\Http\Controllers\Admin\PetController::class, 'index'])->name('admin.pet.index');
        Route::get('/admin/pet/create', [App\Http\Controllers\Admin\PetController::class, 'create'])->name('admin.pet.create');
        Route::post('/admin/pet/store', [App\Http\Controllers\Admin\PetController::class, 'store'])->name('admin.pet.store');
        Route::get('/admin/pet/edit/{id}', [App\Http\Controllers\Admin\PetController::class, 'edit'])->name('admin.pet.edit');
        Route::post('/admin/pet/update', [App\Http\Controllers\Admin\PetController::class, 'update'])->name('admin.pet.update');
        Route::delete('/admin/pet/delete/{id}', [App\Http\Controllers\Admin\PetController::class, 'destroy'])->name('admin.pet.delete');

    Route::get('/admin/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.role.index');
        Route::get('/admin/role/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('admin.role.create');
        Route::post('/admin/role/store', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('admin.role.store');
        Route::get('/admin/role/edit/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('admin.role.edit');
        Route::post('/admin/role/update', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('admin.role.update');
        Route::delete('/admin/role/delete/{id}', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('admin.role.delete');
    
    Route::get('/admin/role-user', [App\Http\Controllers\Admin\RoleUserController::class, 'index'])->name('admin.role-user.index');
        Route::get('/admin/role-user/create', [App\Http\Controllers\Admin\RoleUserController::class, 'create'])->name('admin.role-user.create');
        Route::post('/admin/role-user/store', [App\Http\Controllers\Admin\RoleUserController::class, 'store'])->name('admin.role-user.store');
        Route::get('/admin/role-user/edit/{id}', [App\Http\Controllers\Admin\RoleUserController::class, 'edit'])->name('admin.role-user.edit');

    Route::get('/admin/ras-hewan', [App\Http\Controllers\Admin\RasHewanController::class, 'index'])->name('admin.ras-hewan.index');
        Route::get('/admin/ras-hewan/create', [App\Http\Controllers\Admin\RasHewanController::class, 'create'])->name('admin.ras-hewan.create');
        Route::post('/admin/ras-hewan/store', [App\Http\Controllers\Admin\RasHewanController::class, 'store'])->name('admin.ras-hewan.store');
        Route::get('/admin/ras-hewan/edit/{id}', [App\Http\Controllers\Admin\RasHewanController::class, 'edit'])->name('admin.ras-hewan.edit');
        Route::post('/admin/ras-hewan/update', [App\Http\Controllers\Admin\RasHewanController::class, 'update'])->name('admin.ras-hewan.update');
        Route::delete('/admin/ras-hewan/delete/{id}', [App\Http\Controllers\Admin\RasHewanController::class, 'destroy'])->name('admin.ras-hewan.delete');

    Route::get('/admin/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.index');
        Route::get('/admin/user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.user.create');
        
        Route::post('/admin/user/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.user.store');
        Route::get('/admin/user/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('/admin/user/update', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/admin/user/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.user.delete');

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



