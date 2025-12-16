<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $id = session('user_id');
        $role_id = session('user_role');
        $info = null;
        if($role_id == 5) {
            $info = \DB::table('pemilik')->where('iduser', $id)->select('idpemilik','no_wa', 'alamat')->get();
        } else if ($role_id == 2) {
            $info = \DB::table('dokter')->where('id_user', $id)->select('id_dokter','no_hp', 'alamat', 'bidang_dokter', 'jenis_kelamin')->get();
        } else if ($role_id == 3) {
            $info = \DB::table('perawat')->where('id_user', $id)->select('id_perawat','no_hp', 'alamat', 'pendidikan', 'jenis_kelamin')->get();
        } 
        $info = $info->map(function ($item) {
            if (!property_exists($item, 'jenis_kelamin')) {
                $item->jenis_kelamin = null;
            }
            return $item;
        });
        return view('profile.index', compact('info'));
    }
}
