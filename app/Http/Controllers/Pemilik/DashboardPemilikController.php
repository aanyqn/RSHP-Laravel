<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        $id_pemilik = \DB::table('pemilik')->where('iduser', session('user_id'))->select('idpemilik')->first();
        $temu_dokter = \DB::table('temu_dokter as td')
                        ->whereDate('td.waktu_daftar', now())
                        ->whereIn('td.idpet', function ($query) use ($id_pemilik)   {
                            $query->select('idpet')->from('pet')->where('idpemilik', $id_pemilik->idpemilik);
                        })
                        ->leftJoin('pet as pt', 'td.idpet', '=', 'pt.idpet')
                        ->leftJoin('role_user as ru', 'td.idrole_user', '=', 'ru.idrole_user')
                        ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
                        ->select('td.idreservasi_dokter', 'td.no_urut', 'td.waktu_daftar', 'td.status', 'u.nama as dokter', 'pt.nama')
                        ->get();
        $rekam_medis = \DB::table('rekam_medis')->whereDate('created_at', now())->select('idrekam_medis')->count();
        return view('pemilik.dashboard-pemilik', compact('rekam_medis', 'temu_dokter'));
    }
}
