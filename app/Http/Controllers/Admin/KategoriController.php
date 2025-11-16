<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = \DB::table('kategori')->select('idkategori', 'nama_kategori')->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateKategori($request);
        $kategori = $this->createKategori($validatedData);
        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil ditambahkan.');
    }
    protected function validateKategori(Request $request, $id = null)
    {
        $uniqueRule = $id ?
            'unique:kategori,nama_kategori' . $id . ',idkategori' :
            'unique:kategori,nama_kategori';

        if($id != null) {
            return $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                'min:3',
                $uniqueRule
            ],
            'idkategori' => [
                'required',
                'numeric'
            ],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.string' => 'Nama kategori harus berupa teks',
            'nama_kategori.max' => 'Nama kategori max 100 karakter',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter',
            'nama_kategori.unique' => 'Nama kategori sudah ada', 
        ]);
        }
        return $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                'min:3',
                $uniqueRule
            ],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.string' => 'Nama kategori harus berupa teks',
            'nama_kategori.max' => 'Nama kategori max 100 karakter',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter',
            'nama_kategori.unique' => 'Nama kategori sudah ada', 
        ]);
    }
    protected function createKategori(array $data)
    {
        try {
            return Kategori::create([
                'nama_kategori' => $this->formatNamaKategori($data['nama_kategori']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data: ' . $e->getMessage()));
        }
    }
    public function edit($id)
    {
        return view('admin.kategori.edit', compact('id'));
    }

    public function update(Request $request)
    {
        $validatedData = $this->validateKategori($request, $request['idkategori']);
        $jenisHewan = $this->updateKategori($validatedData);
        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil ubah.');
    }
    protected function updateKategori(array $data)
    {
        try {
            $kategori = \DB::table('kategori')->where('idkategoriS', $data['idkategori'])->update([
                'nama_kategori' => $this->formatNamaJenisHewan($data['nama_kategori'])
            ]);
            return $kategori;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data kateogri: ' . $e->getMessage()));
        }
    }
    protected function formatNamaKategori($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

}
