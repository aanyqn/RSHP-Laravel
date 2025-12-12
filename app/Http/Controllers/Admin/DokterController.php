<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        $dokter = new Dokter();
        $data_dokter = $dokter->dokter();
        if($request->filled('search')) {
            $data_dokter = $dokter->find($request);
        }
        return view('admin.dokter.index', compact('data_dokter'));
    }

    public function create()
    {
        $registered = \DB::table('dokter')->select('id_user')->get();
        $user = \DB::table('user as u')->where('ru.idrole', 2)
                    ->whereNotIn('u.iduser',  function($query){
                        $query->select('id_user')->from('dokter');
                    })
                    ->leftJoin('role_user as ru', 'u.iduser', '=', 'ru.iduser')
                    ->select('u.iduser', 'u.nama')->get();
        return view('admin.dokter.create',compact('user'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateDokter($request);
        $dokter = $this->createDokter($validatedData);
        return redirect()->route('admin.dokter.index')
                        ->with('success', 'Data dokter berhasil ditambahkan.');
    }

    protected function validateDokter(Request $request, $id = null)
    {
        $uniqueRule = $id ?
            'unique:dokter,no_hp,' . $id . ',id_user' :
            'unique:dokter,no_hp';
        return $request->validate([
            'alamat' => [
                'required',
                'string',
                'min:6',
                'max:100',
            ],
            'no_hp' => [
                'required',
                'numeric',
                $uniqueRule
            ],
            'bidang_dokter' => [
                'required',
                'string',
            ],
            'jenis_kelamin' => [
                'required',
                'string',
                'max:1'
            ],
            'iduser' => [
                'required',
                'numeric'
            ]
        ], [
            'no_hp.required' => 'No Handphone wajib diisi',
            'no_hp.numeric' => 'No Handphone harus dengan format yang benar',
            'no_hp.unique' => 'No Handphone sudah ada',

        ]);
    }

    protected function createDokter(array $data)
    {
        
        try {
            $dokter = \DB::table('dokter')->insert([
                'alamat' => $data['alamat'],
                'no_hp' => $data['no_hp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'bidang_dokter' => $data['bidang_dokter'],
                'id_user' => $data['iduser'],
            ]);
        return $dokter;

        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data: ' . $e->getMessage()));
        }
    }

    public function edit($id)
    {
        $dokter = \DB::table('dokter')->where('id_user', $id)->leftJoin('user', 'dokter.id_user', '=', 'user.iduser')->select('dokter.alamat', 'dokter.jenis_kelamin','dokter.bidang_dokter','dokter.no_hp', 'dokter.id_user','user.nama')->get();
        return view('admin.dokter.edit', compact('id', 'dokter'));
    }

    public function update(Request $request)
    {
        $validatedData = $this->validateDokter($request, $request['iduser']);
        $dokter = $this->updateDokter($validatedData);
        return redirect()->route('admin.dokter.index')
                        ->with('success', 'Pemilik berhasil ubah.');
    }
    protected function updateDokter(array $data)
    {
        try {
            $dokter = \DB::table('dokter')->where('id_user', $data['iduser'])->update([
                'alamat' => $data['alamat'],
                'no_hp' => $data['no_hp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'bidang_dokter' => $data['bidang_dokter'],
            ]);
            
        return $dokter;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data jenis hewan: ' . $e->getMessage()));
        }
    }
    protected function destroy($id_dokter)
    {
        \DB::table('dokter')->where('id_dokter', $id_dokter)->delete();
        return redirect()->back()->with('deleteSuccess', 'Data berhasil dihapus.');
    }
}
