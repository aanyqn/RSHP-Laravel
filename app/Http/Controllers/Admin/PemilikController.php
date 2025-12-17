<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\User;

class PemilikController extends Controller
{
    public function index(Request $request)
    {
        $pemilik = Pemilik::with('user')->get();
        if($request->filled('search')) {
            $pemilik = Pemilik::with('user')
                        ->whereHas('user', function ($q) use ($request)
                        {
                            $q->whereLike('nama', '%' . $request->search . '%');
                        })
                        ->orWhereLike('no_wa', '%' . $request->search . '%')
                        ->get();
        }
        return view('admin.pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        return view('admin.pemilik.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validatePemilik($request);
        $pemilik = $this->createPemilik($validatedData);
        return redirect()->route('admin.pemilik.index')
                        ->with('success', 'Pemilik berhasil ditambahkan.');
    }

    protected function validatePemilik(Request $request, $id = null)
    {
        $uniqueRule = $id ?
            'unique:user,email,' . $id . ',iduser' :
            'unique:user,email';

        if($id != null) {
            return $request->validate([
            'nama' => [
                'required',
                'string',
                'min:3',
            ],
            'email' => [
                'required',
                'email',
                $uniqueRule
            ],
            'alamat' => [
                'required',
                'string',
            ],
            'no_wa' => [
                'required',
                'numeric',
                'min:10'
            ],
            'iduser' => [
                'required',
                'numeric'
            ]
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus dengan format yang benar',
            'email.unique' => 'Email sudah ada',

        ]);
        }
        return $request->validate([
            'nama' => [
                'required',
                'string',
                'min:3',
            ],
            'email' => [
                'required',
                'email',
                $uniqueRule
            ],
            'password' => [
                'required',
            ],
            'alamat' => [
                'required',
                'string',
            ],
            'no_wa' => [
                'required',
                'numeric',
                'min:10'
            ],
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus dengan format yang benar',
            'email.unique' => 'Email sudah ada',

        ]);
    }

    protected function createPemilik(array $data)
    {
        
        try {
            $hashed = \Hash::make($data['password']);
            $user = User::create([
                'nama' => $this->formatNama($data['nama']),
                'email' => $data['email'],
                'password' => $hashed,
            ]);

            $pemilik = $user->pemilik()->create([
                'alamat' => $data['alamat'],
                'no_wa' => $data['no_wa'],
            ]);
            $iduser = \DB::table('user')->where('email', $data['email'])->select('iduser')->get();
            $set_role = \DB::table('role_user')->insert([
                'iduser' => $iduser[0]->iduser,
                'idrole' => 5,
                'status' => 1,
            ]);
            
        return [
            'user' => $user,
            'pemilik' => $pemilik,
        ];

        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data: ' . $e->getMessage()));
        }
    }

    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->where('iduser', $id)->get();
        return view('admin.pemilik.edit', compact('id', 'pemilik'));
    }

    public function update(Request $request)
    {
        $validatedData = $this->validatePemilik($request, $request['iduser']);
        $jenisHewan = $this->updatePemilik($validatedData);
        return redirect()->route('admin.pemilik.index')
                        ->with('success', 'Pemilik berhasil ubah.');
    }
    protected function updatePemilik(array $data)
    {
        try {
            $user = \DB::table('user')->where('iduser', $data['iduser'])->update([
                'nama' => $this->formatNama($data['nama']),
                'email' => $data['email'],
            ]);

            $pemilik = \DB::table('pemilik')->where('iduser', $data['iduser'])->update([
                'alamat' => $data['alamat'],
                'no_wa' => $data['no_wa'],
            ]);
            
        return [
            'user' => $user,
            'pemilik' => $pemilik,
        ];
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data jenis hewan: ' . $e->getMessage()));
        }
    }
    protected function destroy($idpemilik, $iduser)
    {
        if (!Pemilik::where('idpemilik', $idpemilik)->exists()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        
        Pet::where('idpemilik', $idpemilik)->delete();
        Pemilik::where('idpemilik', $idpemilik)->delete();
        User::where('iduser', $iduser)->delete();

        return redirect()->back()->with('deleteSuccess', 'Data berhasil dihapus.');
    }

    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
