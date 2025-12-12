<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        $id = session('user_id');q
        $daftarRekamMedis = \DB::table('rekam_medis')->where('user.iduser', $id)->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
        return view('dokter.rekam-medis.index', compact('daftarRekamMedis'));
    }
    public function create()
    {
        $reservasi = \DB::table('temu_dokter')->where('temu_dokter.status', 1)->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user','temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.idreservasi_dokter','temu_dokter.idrole_user', 'pet.nama', 'user.nama as dokter')->get();
        return view('dokter.rekam-medis.create', compact('reservasi'));
    }
    public function store(Request $request)
    {
        $validatedData = $this->validateRekamMedis($request);
        $rekamMedis = $this->createRekamMedis($validatedData);
        return redirect()->route('dokter.rekam-medis.index')
                        ->with('success', 'Rekam Medis berhasil ditambahkan.');
    }
    protected function validateRekamMedis(Request $request, $id = null)
    {

        if($id != null) {
            return $request->validate([
            'anamnesa' => [
                'required',
                'string',
                'max:1000',
                'min:3',
            ],
            'diagnosa' => [
                'required',
                'string',
                'max:1000',
                'min:3',
            ],
            'temuan_klinis' => [
                'required',
                'string',
                'max:1000',
                'min:3',
            ],
            'dokter_pemeriksa' => [
                'required',
                'numeric'
            ],
            'idreservasi_dokter' => [
                'required',
                'numeric'
            ],
            'idrekam_medis' => [
                'required',
                'numeric'
            ]

        ]);
        }

        return $request->validate([
            'anamnesa' => [
                'required',
                'string',
                'max:1000',
                'min:3',
            ],
            'diagnosa' => [
                'required',
                'string',
                'max:1000',
                'min:3',
            ],
            'temuan_klinis' => [
                'required',
                'string',
                'max:1000',
                'min:3',
            ],
            'dokter_pemeriksa' => [
                'required',
                'numeric'
            ],
            'idreservasi_dokter' => [
                'required',
                'numeric'
            ]
        ]);
    }
    protected function createRekamMedis(array $data)
    {
        try {
            $rekamMedis = \DB::table('rekam_medis')->insert([
                'anamnesa' => $data['anamnesa'],
                'diagnosa' => $data['diagnosa'],
                'temuan_klinis' => $data['temuan_klinis'],
                'dokter_pemeriksa' => $data['dokter_pemeriksa'],
                'idreservasi_dokter' => $data['idreservasi_dokter'],
            ]);
            return $rekamMedis;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data rekam medis: ' . $e->getMessage()));
        }
    }
    protected function destroy($id)
    {
        if (!RekamMedis::where('idrekam_medis', $id)->exists()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        try {
            DetailRekamMedis::where('idrekam_medis', $id)->delete();
            RekamMedis::where('idrekam_medis', $id)->delete();
            return redirect()->back()->with('deleteSuccess', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menghapus data jenis hewan: ' . $e->getMessage()));
        }
    }
}
