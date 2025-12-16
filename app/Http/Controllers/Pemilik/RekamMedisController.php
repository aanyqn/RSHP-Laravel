<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $pemilik_id = \DB::table('pemilik')->where('iduser', session('user_id'))->select('idpemilik')->first();
        $reservasi_id = \DB::table('temu_dokter')->whereIn('temu_dokter.idpet',  function($q) use($pemilik_id) {
                            $q->select('idpet')->from('pet')->where('idpemilik', $pemilik_id->idpemilik);
                            })
                            ->pluck('temu_dokter.idreservasi_dokter');
        $daftarRekamMedis = \DB::table('rekam_medis')->whereIn('rekam_medis.idreservasi_dokter', $reservasi_id)->where('created_at', now())->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
        if($request->filled('search')) {
            $daftarRekamMedis = \DB::table('rekam_medis')->whereIn('rekam_medis.idreservasi_dokter', $reservasi_id)->whereLike('pet.nama', '%' . $request->search . '%')->orWhereLike('user.nama', '%' . $request->search . '%')->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
        }
        if($request->filled('date') && !$request->search) {
            if($request->date != null) {
                if($request->date == 1) {
                     $daftarRekamMedis = \DB::table('rekam_medis')->whereIn('rekam_medis.idreservasi_dokter', $reservasi_id)->where('created_at', now())->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
                }
                else if($request->date == 2) {
                     $daftarRekamMedis = \DB::table('rekam_medis')->whereIn('rekam_medis.idreservasi_dokter', $reservasi_id)->whereBetween('created_at', [now()->subDays(7), now()])->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
                }
                else if($request->date == 3) {
                     $daftarRekamMedis = \DB::table('rekam_medis')->whereIn('rekam_medis.idreservasi_dokter', $reservasi_id)->whereBetween('created_at', [now()->subMonth(), now()])->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
                }
                else if($request->date == 4) {
                     $daftarRekamMedis = \DB::table('rekam_medis')->whereIn('rekam_medis.idreservasi_dokter', $reservasi_id)->whereBetween('created_at', [now()->subMonths(3), now()])->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
                }
                else {
                    $daftarRekamMedis = \DB::table('rekam_medis')->whereIn('rekam_medis.idreservasi_dokter', $reservasi_id)->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
                }
            }
        }
        return view('pemilik.data-medis.rekam-medis.index', compact('daftarRekamMedis'));
    }

}
