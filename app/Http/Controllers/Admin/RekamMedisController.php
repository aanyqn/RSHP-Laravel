<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        $daftarRekamMedis = \DB::table('rekam_medis')->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
        return view('admin.daftar-rekam-medis.index', compact('daftarRekamMedis'));
    }
    public function create()
    {
        $reservasi = \DB::table('temu_dokter')->where('temu_dokter.status', 0)->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user','temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.idreservasi_dokter', 'pet.nama', 'user.nama as dokter')->get();
        return view('admin.daftar-rekam-medis.create', compact('reservasi'));
    }
}
