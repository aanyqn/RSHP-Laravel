<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use Illuminate\Http\Request;

class TemuDokterController extends Controller
{
    public function index(Request $request)
    {
        $daftar_temu_dokter = \DB::table('temu_dokter')->where('temu_dokter.waktu_daftar', now())->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
        if($request->filled('search')) {
            $daftar_temu_dokter = \DB::table('temu_dokter')->whereLike('pet.nama', '%' . $request->search . '%')->orWhereLike('user.nama', '%' . $request->search . '%')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
        }
        if($request->filled('date') && !$request->search) {
            if($request->date != null) {
                if($request->date == 1) {
                     $daftar_temu_dokter = \DB::table('temu_dokter')->where('temu_dokter.waktu_daftar', now())->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
                }
                else if($request->date == 2) {
                     $daftar_temu_dokter = \DB::table('temu_dokter')->where('temu_dokter.waktu_daftar', now()->subDay())->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
                }
                else if($request->date == 3) {
                     $daftar_temu_dokter = \DB::table('temu_dokter')->whereBetween('temu_dokter.waktu_daftar', [now()->subDays(7), now()])->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
                }
                else if($request->date == 4) {
                     $daftar_temu_dokter = \DB::table('temu_dokter')->whereBetween('temu_dokter.waktu_daftar', [now()->subMonth(), now()])->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
                }
                else {
                    $daftar_temu_dokter = \DB::table('temu_dokter')->leftJoin('pet', 'temu_dokter.idpet', '=', 'pet.idpet')->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')->select('temu_dokter.*', 'pet.nama', 'user.nama AS dokter')->get();
                }
            }
        }
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
    public function updateStatus($id)
    {
        $update = \DB::table('temu_dokter')->where('idreservasi_dokter', $id)->update(['status' => 0]);
        return redirect()->route('admin.temu-dokter.index')
                        ->with('success', 'Status antrian berhasil diubah.');
    }
}
