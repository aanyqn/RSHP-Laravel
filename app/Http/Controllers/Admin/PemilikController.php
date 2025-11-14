<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\User;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
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
            'unique:user,email,' . $id . ',email' :
            'unique:user,email';

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
            
        return [
            'user' => $user,
            'pemilik' => $pemilik,
        ];

        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data: ' . $e->getMessage()));
        }
    }

    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
