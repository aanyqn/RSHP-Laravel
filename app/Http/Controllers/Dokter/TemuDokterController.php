<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TemuDokterController extends Controller
{
    public function index()
    {
        $id = session('user_id');
        $daftar_temu_dokter = \DB::table('temu_dokter')->where('user.iduser', $id)->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
        return view('dokter.temu-dokter.index', compact('daftar_temu_dokter'));
    }
    public function updateStatus($id)
    {
        $update = \DB::table('temu_dokter')->where('idreservasi_dokter', $id)->update(['status' => 0]);
        return redirect()->route('dokter.temu-dokter.index')
                        ->with('success', 'Status antrian berhasil diubah.');
    }
}
