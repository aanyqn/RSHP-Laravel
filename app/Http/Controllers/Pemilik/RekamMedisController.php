<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        $pemilik_id = \DB::table('pemilik')->where('iduser', session('user_id'))->select('idpemilik')->first();
        $reservasi_id = \DB::table('temu_dokter')->whereIn('temu_dokter.idpet',  function($q) use($pemilik_id) {
                            $q->select('idpet')->from('pet')->where('idpemilik', $pemilik_id->idpemilik);
                            })
                            ->pluck('temu_dokter.idreservasi_dokter');
        $daftarRekamMedis = \DB::table('rekam_medis')->whereIn('rekam_medis.idreservasi_dokter', $reservasi_id)->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
        return view('pemilik.data-medis.rekam-medis.index', compact('daftarRekamMedis'));
    }

}
