<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }
    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateUser($request);
        $pemilik = $this->createUser($validatedData);
        return redirect()->route('admin.user.index')
                        ->with('success', 'User berhasil ditambahkan.');
    }

    protected function validateUser(Request $request, $id = null)
    {
        $uniqueRule = $id ?
            'unique:user,email,' . $id . ',email' :
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
            'confirm_password' => [
                'required',
            ]
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus dengan format yang benar',
            'email.unique' => 'Email sudah ada',

        ]);
    }

    protected function createUser(array $data)
    {
        
        try {
            if($data['password'] != $data['confirm_password']) {
            return redirect()->route('admin.user.create')->with('fail', 'Password berbeda.');
            }
            $hashed = \Hash::make($data['password']);
            $user = User::create([
                'nama' => $this->formatNama($data['nama']),
                'email' => $data['email'],
                'password' => $hashed,
            ]);
        return $user;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data: ' . $e->getMessage()));
        }
    }

    public function edit($id)
    {
        return view('admin.user.edit', compact('id'));
    }

    public function update(Request $request)
    {
        $validatedData = $this->validateUser($request, $request['iduser']);
        $jenisHewan = $this->updateUser($validatedData);
        return redirect()->route('admin.user.index')
                        ->with('success', 'User berhasil ubah.');
    }
    protected function updateUser(array $data)
    {
        try {
            $user = \DB::table('user')->where('iduser', $data['iduser'])->update([
                'nama' => $this->formatNama($data['nama']),
                'email' => $data['email'],
            ]);
        return $user;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data jenis hewan: ' . $e->getMessage()));
        }
    }
    protected function destroy($iduser)
    {
        if (!User::where('iduser', $iduser)->exists()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        if (!Pemilik::where('iduser', $iduser)->exists()) {
            RoleUser::where('iduser', $iduser)->delete();
            User::where('iduser', $iduser)->delete();
            return redirect()->back()->with('deleteSuccess', 'Data berhasil dihapus.');
        }
        $pemilik = Pemilik::where('iduser', $iduser)->select('idpemilik')->first();
        RoleUser::where('iduser', $iduser)->delete();
        Pet::where('idpemilik', $pemilik->idpemilik)->delete();
        Pemilik::where('iduser', $iduser)->delete();
        User::where('iduser', $iduser)->delete();
        return redirect()->back()->with('deleteSuccess', 'Data berhasil dihapus.');
    }

    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
