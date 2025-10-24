<?php

use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

Route::get('/', [SiteController::class, 'index'])->name('home');

Route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');

Route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');

Route::get('/visimisi', [SiteController::class, 'visiMisi'])->name('visimisi');

Route::get('/login', [SiteController::class, 'login'])->name('login');

Route::get('/admin/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');

Route::get('/admin/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('admin.pemilik.index');

Route::get('/admin/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('admin.kategori.index');

Route::get('/admin/kategori-klinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');

Route::get('/admin/kode-tindakan-terapi', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'index'])->name('admin.kode-tindakan-terapi.index');

Route::get('/admin/pet', [App\Http\Controllers\Admin\PetController::class, 'index'])->name('admin.pet.index');

Route::get('/admin/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.role.index');

Route::get('/admin/role-user', [App\Http\Controllers\Admin\RoleUserController::class, 'index'])->name('admin.role-user.index');
