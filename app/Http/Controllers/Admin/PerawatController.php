<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perawat;
use Illuminate\Http\Request;

class PerawatController extends Controller
{
    public function index(Request $request)
    {
        $perawat = new Perawat();
        $data_perawat = $perawat->perawat();
        if($request->filled('search')) {
            $data_perawat = $perawat->find($request);
        }
        return view('admin.perawat.index', compact('data_perawat'));
    }

    public function create()
    {
        $registered = \DB::table('perawat')->select('id_user')->get();
        $user = \DB::table('user as u')->where('ru.idrole', 3)
                    ->whereNotIn('u.iduser',  function($query){
                        $query->select('id_user')->from('perawat');
                    })
                    ->leftJoin('role_user as ru', 'u.iduser', '=', 'ru.iduser')
                    ->select('u.iduser', 'u.nama')->get();
        return view('admin.perawat.create',compact('user'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validatePerawat($request);
        $perawat = $this->createPerawat($validatedData);
        return redirect()->route('admin.perawat.index')
                        ->with('success', 'Data perawat berhasil ditambahkan.');
    }

    protected function validatePerawat(Request $request, $id = null)
    {
        $uniqueRule = $id ?
            'unique:perawat,no_hp,' . $id . ',id_user' :
            'unique:perawat,no_hp';
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
            'pendidikan' => [
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

    protected function createPerawat(array $data)
    {
        
        try {
            $perawat = \DB::table('perawat')->insert([
                'alamat' => $data['alamat'],
                'no_hp' => $data['no_hp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'pendidikan' => $data['pendidikan'],
                'id_user' => $data['iduser'],
            ]);
        return $perawat;

        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data: ' . $e->getMessage()));
        }
    }

    public function edit($id)
    {
        $perawat = \DB::table('perawat')->where('id_user', $id)->leftJoin('user', 'perawat.id_user', '=', 'user.iduser')->select('perawat.alamat', 'perawat.jenis_kelamin','perawat.pendidikan','perawat.no_hp', 'perawat.id_user','user.nama')->get();
        return view('admin.perawat.edit', compact('id', 'perawat'));
    }

    public function update(Request $request)
    {
        $validatedData = $this->validatePerawat($request, $request['iduser']);
        $perawat = $this->updateDokter($validatedData);
        return redirect()->route('admin.perawat.index')
                        ->with('success', 'Pemilik berhasil ubah.');
    }
    protected function updateDokter(array $data)
    {
        try {
            $perawat = \DB::table('perawat')->where('id_user', $data['iduser'])->update([
                'alamat' => $data['alamat'],
                'no_hp' => $data['no_hp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'pendidikan' => $data['pendidikan'],
            ]);
            
        return $perawat;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data jenis hewan: ' . $e->getMessage()));
        }
    }
    protected function destroy($id_perawat)
    {
        \DB::table('perawat')->where('id_perawat', $id_perawat)->delete();
        return redirect()->back()->with('deleteSuccess', 'Data berhasil dihapus.');
    }
}
