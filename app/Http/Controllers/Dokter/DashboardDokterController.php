<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardDokterController extends Controller
{
    public function index()
    {
        $id = session('user_id');
        $total_reservasi = \DB::table('temu_dokter')->whereDate('waktu_daftar', now())->where('role_user.iduser', $id)->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->select('idreservasi_dokter')->count();
        $total_reservasi_selesai = \DB::table('temu_dokter')->where('temu_dokter.status', 0)->whereDate('waktu_daftar', now())->where('role_user.iduser', $id)->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->select('idreservasi_dokter')->count();
        $rekam_medis = \DB::table('rekam_medis')->whereDate('created_at', now())->where('role_user.iduser', $id)->leftJoin('role_user', 'rekam_medis.dokter_pemeriksa', '=', 'role_user.idrole_user')->select('idrekam_medis')->count();
        return view('dokter.dashboard-dokter', compact('total_reservasi', 'rekam_medis', 'total_reservasi_selesai'));
    }
}
