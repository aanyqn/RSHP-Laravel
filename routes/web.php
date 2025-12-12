<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\isAdministrator;
use App\Http\Middleware\isDokter;
use App\Http\Middleware\isPemilik;
use App\Http\Middleware\isPerawat;
use App\Http\Middleware\isResepsionis;


Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

Route::get('/', [SiteController::class, 'index'])->name('sites.home');

Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/auth/login', [LoginController::class, 'login'])->name('login.post');

Route::post('/', [LoginController::class, 'logout'])->name('logout');

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

    Route::get('/admin/dokter', [App\Http\Controllers\Admin\DokterController::class, 'index'])->name('admin.dokter.index');
        Route::get('/admin/dokter/create', [App\Http\Controllers\Admin\DokterController::class, 'create'])->name('admin.dokter.create');
        Route::post('/admin/dokter/store', [App\Http\Controllers\Admin\DokterController::class, 'store'])->name('admin.dokter.store');
        Route::get('/admin/dokter/edit/{id}', [App\Http\Controllers\Admin\DokterController::class, 'edit'])->name('admin.dokter.edit');
        Route::post('/admin/dokter/update', [App\Http\Controllers\Admin\DokterController::class, 'update'])->name('admin.dokter.update');
        Route::delete('/admin/dokter/delete/{id_dokter}', [App\Http\Controllers\Admin\DokterController::class, 'destroy'])->name('admin.dokter.delete');

    Route::get('/admin/perawat', [App\Http\Controllers\Admin\PerawatController::class, 'index'])->name('admin.perawat.index');
        Route::get('/admin/perawat/create', [App\Http\Controllers\Admin\PerawatController::class, 'create'])->name('admin.perawat.create');
        Route::post('/admin/perawat/store', [App\Http\Controllers\Admin\PerawatController::class, 'store'])->name('admin.perawat.store');
        Route::get('/admin/perawat/edit/{id}', [App\Http\Controllers\Admin\PerawatController::class, 'edit'])->name('admin.perawat.edit');
        Route::post('/admin/perawat/update', [App\Http\Controllers\Admin\PerawatController::class, 'update'])->name('admin.perawat.update');
        Route::delete('/admin/perawat/delete/{id_perawat}', [App\Http\Controllers\Admin\PerawatController::class, 'destroy'])->name('admin.perawat.delete');

    Route::get('/admin/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('admin.kategori.index');
        Route::get('/admin/kategori/create', [App\Http\Controllers\Admin\KategoriController::class, 'create'])->name('admin.kategori.create');
        Route::post('/admin/kategori/store', [App\Http\Controllers\Admin\KategoriController::class, 'store'])->name('admin.kategori.store');
        Route::get('/admin/kategori/edit/{id}', [App\Http\Controllers\Admin\KategoriController::class, 'edit'])->name('admin.kategori.edit');
        Route::post('/admin/kategori/update', [App\Http\Controllers\Admin\KategoriController::class, 'update'])->name('admin.kategori.update');
        Route::delete('/admin/kategori/delete/{id}', [App\Http\Controllers\Admin\KategoriController::class, 'destroy'])->name('admin.kategori.delete');

    Route::get('/admin/kategori-klinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');
        Route::get('/admin/kategori-klinis/create', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'create'])->name('admin.kategori-klinis.create');
        Route::post('/admin/kategori-klinis/store', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'store'])->name('admin.kategori-klinis.store');
        Route::get('/admin/kategori-klinis/edit/{id}', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'edit'])->name('admin.kategori-klinis.edit');
        Route::post('/admin/kategori-klinis/update', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'update'])->name('admin.kategori-klinis.update');

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
        Route::get('/admin/role-user/activate-role/{id}/{status}', [App\Http\Controllers\Admin\RoleUserController::class, 'activateRole'])->name('admin.role-user.activate-role');
        Route::post('/admin/role-user/edit-role-user', [App\Http\Controllers\Admin\RoleUserController::class, 'editRoleUser'])->name('admin.role-user.edit-role-user');
        Route::get('/admin/role-user/delete-role-user/{idrole_user}/{iduser}', [App\Http\Controllers\Admin\RoleUserController::class, 'DeleteRoleUser'])->name('admin.role-user.delete-role-user');

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
        Route::get('/admin/user/reset/{id}', [App\Http\Controllers\Admin\UserController::class, 'reset'])->name('admin.user.reset');
        Route::post('/admin/user/reset-password', [App\Http\Controllers\Admin\UserController::class, 'resetPassword'])->name('admin.user.reset-password');

    Route::get('/admin/rekam-medis', [App\Http\Controllers\Admin\RekamMedisController::class, 'index'])->name('admin.rekam-medis.index');
        Route::get('/admin/rekam-medis/create', [App\Http\Controllers\Admin\RekamMedisController::class, 'create'])->name('admin.rekam-medis.create');
        Route::post('/admin/rekam-medis/store', [App\Http\Controllers\Admin\RekamMedisController::class, 'store'])->name('admin.rekam-medis.store');
        Route::delete('/admin/rekam-medis/delete/{id}', [App\Http\Controllers\Admin\RekamMedisController::class, 'destroy'])->name('admin.rekam-medis.delete');

    Route::get('/admin/rekam-medis/detail/{id}', [App\Http\Controllers\Admin\DetailRekamMedisController::class, 'index'])->name('admin.rekam-medis.detail.index');
        Route::get('/admin/rekam-medis/detail/create/{id}', [App\Http\Controllers\Admin\DetailRekamMedisController::class, 'create'])->name('admin.rekam-medis.detail.create');
        Route::post('/admin/rekam-medis/detail/store', [App\Http\Controllers\Admin\DetailRekamMedisController::class, 'store'])->name('admin.rekam-medis.detail.store');
        Route::get('/admin/rekam-medis/detail/edit/{id}', [App\Http\Controllers\Admin\DetailRekamMedisController::class, 'edit'])->name('admin.rekam-medis.detail.edit');
        Route::post('/admin/rekam-medis/detail/update', [App\Http\Controllers\Admin\DetailRekamMedisController::class, 'update'])->name('admin.rekam-medis.detail.update');
        Route::delete('/admin/rekam-medis/detail/delete/{id}', [App\Http\Controllers\Admin\DetailRekamMedisController::class, 'destroy'])->name('admin.rekam-medis.detail.delete');

    Route::get('/admin/temu-dokter', [App\Http\Controllers\Admin\TemuDokterController::class, 'index'])->name('admin.temu-dokter.index');
        Route::get('/admin/temu-dokter/create', [App\Http\Controllers\Admin\TemuDokterController::class, 'create'])->name('admin.temu-dokter.create');
        Route::get('/admin/temu-dokter/update-status/{id}', [App\Http\Controllers\Admin\TemuDokterController::class, 'updateStatus'])->name('admin.temu-dokter.update-status');
        Route::post('/admin/temu-dokter/store', [App\Http\Controllers\Admin\TemuDokterController::class, 'store'])->name('admin.temu-dokter.store');
        Route::delete('/admin/temu-dokter/delete/{id}', [App\Http\Controllers\Admin\TemuDokterController::class, 'destroy'])->name('admin.temu-dokter.delete');

    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardAdminController::class, 'index'])->name('admin.dashboard-admin');
});

Route::middleware([isResepsionis::class])->group(function () {
    Route::get('/resepsionis/dashboard', [App\Http\Controllers\Resepsionis\DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard-resepsionis');
    
    Route::get('/resepsionis/reservasi', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'index'])->name('resepsionis.reservasi.index');
        Route::get('/resepsionis/reservasi/create', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'create'])->name('resepsionis.reservasi.create');
        Route::get('/resepsionis/reservasi/edit/{id}', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'edit'])->name('resepsionis.reservasi.edit');
        Route::post('/resepsionis/reservasi/store', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'store'])->name('resepsionis.reservasi.store');
        Route::get('/resepsionis/reservasi/update-status/{id}', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'updateStatus'])->name('resepsionis.reservasi.update-status');

    Route::get('/resepsionis/registrasi', function () { return view ('resepsionis.registrasi'); })->name('resepsionis.registrasi');
    
    Route::get('/resepsionis/registrasi/pemilik', [App\Http\Controllers\Resepsionis\RegistrasiPemilikController::class, 'index'])->name('resepsionis.registrasi.pemilik.index');
        Route::get('/resepsionis/registrasi/pemilik/create', [App\Http\Controllers\Resepsionis\RegistrasiPemilikController::class, 'create'])->name('resepsionis.registrasi.pemilik.create');
        Route::post('/resepsionis/registrasi/pemilik/store', [App\Http\Controllers\Resepsionis\RegistrasiPemilikController::class, 'store'])->name('resepsionis.registrasi.pemilik.store');

    Route::get('/resepsionis/registrasi/pet', [App\Http\Controllers\Resepsionis\RegistrasiPetController::class, 'index'])->name('resepsionis.registrasi.pet.index');
        Route::get('/resepsionis/registrasi/pet/create', [App\Http\Controllers\Resepsionis\RegistrasiPetController::class, 'create'])->name('resepsionis.registrasi.pet.create');
        Route::post('/resepsionis/registrasi/pet/store', [App\Http\Controllers\Resepsionis\RegistrasiPetController::class, 'store'])->name('resepsionis.registrasi.pet.store');
});


Route::middleware([isDokter::class])->group(function () {
    Route::get('/dokter/dashboard', [App\Http\Controllers\Dokter\DashboardDokterController::class, 'index'])->name('dokter.dashboard-dokter');

    Route::get('/dokter/rekam-medis', [App\Http\Controllers\Dokter\RekamMedisController::class, 'index'])->name('dokter.rekam-medis.index');
        Route::get('/dokter/rekam-medis/create', [App\Http\Controllers\Dokter\RekamMedisController::class, 'create'])->name('dokter.rekam-medis.create');
        Route::post('/dokter/rekam-medis/store', [App\Http\Controllers\Dokter\RekamMedisController::class, 'store'])->name('dokter.rekam-medis.store');
        Route::delete('/dokter/rekam-medis/delete/{id}', [App\Http\Controllers\Dokter\RekamMedisController::class, 'destroy'])->name('dokter.rekam-medis.delete');

    Route::get('/dokter/rekam-medis/detail/{id}', [App\Http\Controllers\Dokter\DetailRekamMedisController::class, 'index'])->name('dokter.rekam-medis.detail.index');
        Route::get('/dokter/rekam-medis/detail/create/{id}', [App\Http\Controllers\Dokter\DetailRekamMedisController::class, 'create'])->name('dokter.rekam-medis.detail.create');
        Route::post('/dokter/rekam-medis/detail/store', [App\Http\Controllers\Dokter\DetailRekamMedisController::class, 'store'])->name('dokter.rekam-medis.detail.store');
        Route::get('/dokter/rekam-medis/detail/edit/{id}', [App\Http\Controllers\Dokter\DetailRekamMedisController::class, 'edit'])->name('dokter.rekam-medis.detail.edit');
        Route::post('/dokter/rekam-medis/detail/update', [App\Http\Controllers\Dokter\DetailRekamMedisController::class, 'update'])->name('dokter.rekam-medis.detail.update');
        Route::delete('/dokter/rekam-medis/detail/delete/{id}', [App\Http\Controllers\Dokter\DetailRekamMedisController::class, 'destroy'])->name('dokter.rekam-medis.detail.delete');

        Route::get('/dokter/temu-dokter', [App\Http\Controllers\Dokter\TemuDokterController::class, 'index'])->name('dokter.temu-dokter.index');
        Route::get('/dokter/temu-dokter/update-status/{id}', [App\Http\Controllers\Dokter\TemuDokterController::class, 'updateStatus'])->name('dokter.temu-dokter.update-status');
});

Route::middleware([isPerawat::class])->group(function () {
    Route::get('/perawat/dashboard', [App\Http\Controllers\Perawat\DashboardPerawatController::class, 'index'])->name('perawat.dashboard-perawat');

    Route::get('/perawat/rekam-medis', [App\Http\Controllers\Perawat\RekamMedisController::class, 'index'])->name('perawat.rekam-medis.index');
        Route::get('/perawat/rekam-medis/create', [App\Http\Controllers\Perawat\RekamMedisController::class, 'create'])->name('perawat.rekam-medis.create');
        Route::post('/perawat/rekam-medis/store', [App\Http\Controllers\Perawat\RekamMedisController::class, 'store'])->name('perawat.rekam-medis.store');
        Route::delete('/perawat/rekam-medis/delete/{id}', [App\Http\Controllers\Perawat\RekamMedisController::class, 'destroy'])->name('perawat.rekam-medis.delete');

    Route::get('/perawat/rekam-medis/detail/{id}', [App\Http\Controllers\Perawat\DetailRekamMedisController::class, 'index'])->name('perawat.rekam-medis.detail.index');
        Route::get('/perawat/rekam-medis/detail/create/{id}', [App\Http\Controllers\Perawat\DetailRekamMedisController::class, 'create'])->name('perawat.rekam-medis.detail.create');
        Route::post('/perawat/rekam-medis/detail/store', [App\Http\Controllers\Perawat\DetailRekamMedisController::class, 'store'])->name('perawat.rekam-medis.detail.store');
        Route::get('/perawat/rekam-medis/detail/edit/{id}', [App\Http\Controllers\Perawat\DetailRekamMedisController::class, 'edit'])->name('perawat.rekam-medis.detail.edit');
        Route::post('/perawat/rekam-medis/detail/update', [App\Http\Controllers\Perawat\DetailRekamMedisController::class, 'update'])->name('perawat.rekam-medis.detail.update');
        Route::delete('/perawat/rekam-medis/detail/delete/{id}', [App\Http\Controllers\Perawat\DetailRekamMedisController::class, 'destroy'])->name('perawat.rekam-medis.detail.delete');

        Route::get('/perawat/temu-dokter', [App\Http\Controllers\Perawat\TemuDokterController::class, 'index'])->name('perawat.temu-dokter.index');
        Route::get('/perawat/temu-dokter/update-status/{id}', [App\Http\Controllers\Perawat\TemuDokterController::class, 'updateStatus'])->name('perawat.temu-dokter.update-status');
});

Route::middleware([isPemilik::class])->group(function () {
    Route::get('/pemilik/dashboard', [App\Http\Controllers\Pemilik\DashboardPemilikController::class, 'index'])->name('pemilik.dashboard-pemilik');
    Route::get('/pemilik/daftar-pet', [App\Http\Controllers\Pemilik\DaftarPetController::class, 'index'])->name('pemilik.daftar-pet.index');
    
    Route::get('/pemilik/reservasi', [App\Http\Controllers\Pemilik\ReservasiController::class, 'index'])->name('pemilik.data-medis.reservasi.index');
    Route::get('/pemilik/reservasi/create', [App\Http\Controllers\Pemilik\ReservasiController::class, 'create'])->name('pemilik.data-medis.reservasi.create');
    Route::post('/pemilik/reservasi/store', [App\Http\Controllers\Pemilik\ReservasiController::class, 'store'])->name('pemilik.data-medis.reservasi.store');
    
    
    Route::get('/pemilik/rekam-medis', [App\Http\Controllers\Pemilik\RekamMedisController::class, 'index'])->name('pemilik.data-medis.rekam-medis.index');
    Route::get('/pemilik/rekam-medis/detail/{id}', [App\Http\Controllers\Pemilik\DetailRekamMedisController::class, 'index'])->name('pemilik.data-medis.rekam-medis.detail.index');
});


Route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');

Route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');

Route::get('/visimisi', [SiteController::class, 'visiMisi'])->name('visimisi');



