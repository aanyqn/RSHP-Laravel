<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        $pemilik_id = \DB::table('pemilik')->where('iduser', session('user_id'))->select('idpemilik')->get();
        $daftar_temu_dokter = \DB::table('temu_dokter')->where('pemilik.idpemilik',  $pemilik_id[0]->idpemilik)->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
        return view('pemilik.data-medis.reservasi.index', compact('daftar_temu_dokter'));
    }
    public function create()
    {
        $pemilik_id = \DB::table('pemilik')->where('iduser', session('user_id'))->select('idpemilik')->get();
        $pets = \DB::table('pet')->where('idpemilik', $pemilik_id[0]->idpemilik)->select('idpet', 'nama')->get();
        $dokter = \DB::table('role_user')->where('idrole', 2)->rightJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('role_user.idrole_user', 'user.nama')->get();
        return view('pemilik.data-medis.reservasi.create', compact('pets', 'dokter'));
    }
    public function store(Request $request)
    {
        $validatedData = $this->validateTemuDokter($request);
        $temuDokter = $this->createTemuDokter($validatedData);
        return redirect()->route('pemilik.data-medis.reservasi.index')
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
    protected function destroy($id)
    {
        if (!TemuDokter::where('idreservasi_dokter', $id)->exists()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        try {
            TemuDokter::where('idreservasi_dokter', $id)->delete();
            return redirect()->back()->with('deleteSuccess', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menghapus data: ' . $e->getMessage()));
        }
    }
}
