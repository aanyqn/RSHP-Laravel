<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailRekamMedis;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $daftarRekamMedis = \DB::table('rekam_medis')->whereDate('created_at', now())->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
        if($request->filled('search')) {
            $daftarRekamMedis = \DB::table('rekam_medis')->whereLike('pet.nama', '%' . $request->search . '%')->orWhereLike('user.nama', '%' . $request->search . '%')->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
        }
        if($request->filled('date') && !$request->search) {
            if($request->date != null) {
                if($request->date == 1) {
                     $daftarRekamMedis = \DB::table('rekam_medis')->whereDate('created_at', now())->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
                }
                else if($request->date == 2) {
                     $daftarRekamMedis = \DB::table('rekam_medis')->whereDate('created_at', '>=', now()->subDays(7))->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
                }
                else if($request->date == 3) {
                     $daftarRekamMedis = \DB::table('rekam_medis')->whereDate('created_at', '>=', now()->subMonth())->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
                }
                else if($request->date == 4) {
                     $daftarRekamMedis = \DB::table('rekam_medis')->whereDate('created_at', '>=', now()->subMonths(3))->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
                }
                else {
                    $daftarRekamMedis = \DB::table('rekam_medis')->leftJoin('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('rekam_medis.*', 'user.nama as dokter', 'pet.nama')->get();
                }
            }
        }
        return view('admin.daftar-rekam-medis.index', compact('daftarRekamMedis'));
    }
    public function create()
    {
        $reservasi = \DB::table('temu_dokter')->where('temu_dokter.status', 1)->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user','temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.idreservasi_dokter','temu_dokter.idrole_user', 'pet.nama', 'user.nama as dokter')->get();
        return view('admin.daftar-rekam-medis.create', compact('reservasi'));
    }
    public function store(Request $request)
    {
        $validatedData = $this->validateRekamMedis($request);
        $rekamMedis = $this->createRekamMedis($validatedData);
        return redirect()->route('admin.rekam-medis.index')
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

    public function edit($id)
    {
        $data = \DB::table('rekam_medis')->where('idrekam_medis', $id)->select('anamnesa', 'temuan_klinis', 'diagnosa')->get();
        return view('admin.daftar-rekam-medis.edit', compact('data', 'id'));
    }
    
    protected function update(Request $request)
    {
        $validatedData = $this->validateRekamMedis($request, $request['idrekam_medis']);
        $rekamMedis = $this->updateRekamMedis($validatedData);
        return redirect()->route('admin.rekam-medis.index')
                        ->with('success', 'Rekam medis berhasil diubah.');
    }
    protected function updateRekamMedis(array $data)
    {
        try {
            $rekamMedis = \DB::table('rekam_medis')->where('idrekam_medis', $data['idrekam_medis'])->update([
                'anamnesa' => $data['anamnesa'],
                'diagnosa' => $data['diagnosa'],
                'temuan_klinis' => $data['temuan_klinis']
            ]);
            return $rekamMedis;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data: ' . $e->getMessage()));
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
