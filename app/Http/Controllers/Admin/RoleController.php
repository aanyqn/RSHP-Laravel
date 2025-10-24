<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // $jenisHewan = JenisHewan::select('idjenis_hewan', 'nama_jenis_hewan')->get();
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }
}
