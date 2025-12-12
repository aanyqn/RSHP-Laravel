<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    public function dokter()
    {
        $data = \DB::table('dokter as d')->where('ru.idrole', 2)->leftJoin('user as u', 'd.id_user', '=', 'u.iduser')->leftJoin('role_user as ru', 'd.id_user', '=', 'ru.iduser')->leftJoin('role as r', 'ru.idrole', '=', 'r.idrole')->select('d.id_dokter', 'd.alamat', 'd.no_hp', 'd.bidang_dokter', 'd.jenis_kelamin', 'd.id_user', 'u.nama','ru.status', 'r.nama_role')->get();
        return $data;
    }
    public function find($request)
    {
        $data = \DB::table('dokter as d')->where('ru.idrole', 2)->whereLike('u.nama', '%' . $request->search . '%')->orWhereLike('d.no_hp', '%' . $request->search . '%')->leftJoin('user as u', 'd.id_user', '=', 'u.iduser')->leftJoin('role_user as ru', 'd.id_user', '=', 'ru.iduser')->leftJoin('role as r', 'ru.idrole', '=', 'r.idrole')->select('d.id_dokter', 'd.alamat', 'd.no_hp', 'd.bidang_dokter', 'd.jenis_kelamin', 'd.id_user', 'u.nama','ru.status', 'r.nama_role')->get();
        return $data;
    }
}
