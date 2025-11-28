<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TemuDokterController extends Controller
{
    public function index()
    {
        $daftar_temu_dokter = \DB::table('temu_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
        return view('admin.temu-dokter.index', compact('daftar_temu_dokter'));
    }
    public function create()
    {
        $pets = \DB::table('pet')->select('idpet', 'nama')->get();
        $dokter = \DB::table('role_user')->where('idrole', 2)->rightJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('role_user.idrole_user', 'user.nama')->get();
        return view('admin.temu-dokter.create', compact('pets', 'dokter'));
    }
    public function store(Request $request)
    {
        $validatedData = $this->validateTemuDokter($request);
        $temuDokter = $this->createTemuDokter($validatedData);
        return redirect()->route('admin.temu-dokter.index')
                        ->with('success', 'Antrian berhasil ditambahkan.');
    }
    protected function validateTemuDokter($request)
    {
            return $request->validate([
            'idpet' => [
                'required',
                'numeric',
            ],
            'idrole_user' => [
                'required',
                'numeric'
            ]

        ]);
    }

    protected function createTemuDokter($data)
    {
        try {
            $no_urut_terakhir = \DB::table('temu_dokter')->whereDate('waktu_daftar', today())->max('no_urut');
            $no_urut = $no_urut_terakhir ?? 1;
            $temuDokter = \DB::table('temu_dokter')->insert([
                'idpet' => $data['idpet'],
                'idrole_user' => $data['idrole_user'],
                'no_urut' => $no_urut,
                'status' => 0
            ]);
            return $temuDokter;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data jenis hewan: ' . $e->getMessage()));
        }
    }
}
