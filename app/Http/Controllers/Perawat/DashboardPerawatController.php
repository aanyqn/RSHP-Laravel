<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPerawatController extends Controller
{
    public function index()
    {
        $total_reservasi = \DB::table('temu_dokter')->whereDate('waktu_daftar', now())->select('idreservasi_dokter')->count();
        $total_reservasi_selesai = \DB::table('temu_dokter')->where('temu_dokter.status', 0)->whereDate('waktu_daftar', now())->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->select('idreservasi_dokter')->count();
        $rekam_medis = \DB::table('rekam_medis')->whereDate('created_at', now())->select('idrekam_medis')->count();
        return view('perawat.dashboard-perawat', compact('total_reservasi', 'rekam_medis', 'total_reservasi', 'total_reservasi_selesai'));
    }
}
