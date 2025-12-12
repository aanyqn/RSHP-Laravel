<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;

class TemuDokterController extends Controller
{
   public function index()
    {
        $daftar_temu_dokter = \DB::table('temu_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
        return view('resepsionis.reservasi.index', compact('daftar_temu_dokter'));
    }
    public function create()
    {
        $pets = \DB::table('pet')->select('idpet', 'nama')->get();
        $dokter = \DB::table('role_user')->where('idrole', 2)->rightJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('role_user.idrole_user', 'user.nama')->get();
        return view('resepsionis.reservasi.create', compact('pets', 'dokter'));
    }
    public function store(Request $request)
    {
        $validatedData = $this->validateTemuDokter($request);
        $temuDokter = $this->createTemuDokter($validatedData);
        return redirect()->route('resepsionis.reservasi.index')
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
                'status' => 1
            ]);
            return $temuDokter;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data jenis hewan: ' . $e->getMessage()));
        }
    }
    public function updateStatus($id)
    {
        $update = \DB::table('temu_dokter')->where('idreservasi_dokter', $id)->update(['status' => 0]);
        return redirect()->route('resepsionis.reservasi.index')
                        ->with('success', 'Status antrian berhasil diubah.');
    }
}
