<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $total_reservasi = \DB::table('temu_dokter')->whereDate('waktu_daftar', now())->select('idreservasi_dokter')->count();
        $rekam_medis = \DB::table('rekam_medis')->whereDate('created_at', now())->select('idrekam_medis')->count();
        $dokter_aktif = \DB::table('role_user')->where('idrole', 2)->where('status', 1)->select('iduser')->count();
        $perawat_aktif = \DB::table('role_user')->where('idrole', 3)->where('status', 1)->select('iduser')->count();
        return view('admin.dashboard-admin', compact('total_reservasi', 'rekam_medis', 'dokter_aktif', 'perawat_aktif'));
    }
}
