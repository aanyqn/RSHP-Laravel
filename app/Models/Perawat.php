<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    public function perawat()
    {
        $data = \DB::table('perawat as p')->where('ru.idrole', 3)->leftJoin('user as u', 'p.id_user', '=', 'u.iduser')->leftJoin('role_user as ru', 'p.id_user', '=', 'ru.iduser')->leftJoin('role as r', 'ru.idrole', '=', 'r.idrole')->select('p.id_perawat', 'p.alamat', 'p.no_hp', 'p.pendidikan', 'p.jenis_kelamin', 'p.id_user', 'u.nama','ru.status', 'r.nama_role')->get();
        return $data;
    }
    public function find($request)
    {
        $data = \DB::table('perawat as p')->where('ru.idrole', 3)->whereLike('u.nama', '%' . $request->search . '%')->orWhereLike('p.no_hp', '%' . $request->search . '%')->leftJoin('user as u', 'p.id_user', '=', 'u.iduser')->leftJoin('role_user as ru', 'p.id_user', '=', 'ru.iduser')->leftJoin('role as r', 'ru.idrole', '=', 'r.idrole')->select('p.id_perawat', 'p.alamat', 'p.no_hp', 'p.pendidikan', 'p.jenis_kelamin', 'p.id_user', 'u.nama','ru.status', 'r.nama_role')->get();
        return $data;
    }
}
