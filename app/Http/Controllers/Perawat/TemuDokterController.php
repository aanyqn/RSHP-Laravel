<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TemuDokterController extends Controller
{
    public function index(Request $request)
    {
        $daftar_temu_dokter = \DB::table('temu_dokter')->whereDate('temu_dokter.waktu_daftar', now())->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
        if($request->filled('search')) {
            $daftar_temu_dokter = \DB::table('temu_dokter')->whereLike('pet.nama', '%' . $request->search . '%')->orWhereLike('user.nama', '%' . $request->search . '%')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
        }
        if($request->filled('date') && !$request->search) {
            if($request->date != null) {
                if($request->date == 1) {
                     $daftar_temu_dokter = \DB::table('temu_dokter')->whereDate('temu_dokter.waktu_daftar', now())->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
                }
                else if($request->date == 2) {
                     $daftar_temu_dokter = \DB::table('temu_dokter')->whereDate('temu_dokter.waktu_daftar', now()->subDay())->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
                }
                else if($request->date == 3) {
                     $daftar_temu_dokter = \DB::table('temu_dokter')->whereDate('temu_dokter.waktu_daftar', '>=', now()->subDays(7))->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
                }
                else if($request->date == 4) {
                     $daftar_temu_dokter = \DB::table('temu_dokter')->whereDate('temu_dokter.waktu_daftar', '>=', now()->subMonth())->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
                }
                else {
                    $daftar_temu_dokter = \DB::table('temu_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
                }
            }
        }
        return view('perawat.temu-dokter.index', compact('daftar_temu_dokter'));
    }
    public function updateStatus($id)
    {
        $update = \DB::table('temu_dokter')->where('idreservasi_dokter', $id)->update(['status' => 0]);
        return redirect()->route('perawat.temu-dokter.index')
                        ->with('success', 'Status antrian berhasil diubah.');
    }
}
