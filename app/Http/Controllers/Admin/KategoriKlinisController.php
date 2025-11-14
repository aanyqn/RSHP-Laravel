<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kategori-klinis.index', compact('kategoriKlinis'));
    }

    public function create()
    {
        return view('admin.kategori-klinis.create');
    }
     public function store(Request $request)
    {
        $validatedData = $this->validateKategoriKlinis($request);
        $kategoriKlinis = $this->createKategoriKlinis($validatedData);
        return redirect()->route('admin.kategori-klinis.index')
                        ->with('success', 'Kategori Klinis berhasil ditambahkan.');
    }
    protected function validateKategoriKlinis(Request $request, $id = null)
    {
        $uniqueRule = $id ?
            'unique:kategori_klinis,nama_kategori_klinis' . $id . ',idkategori' :
            'unique:kategori_klinis,nama_kategori_klinis';

        return $request->validate([
            'nama_kategori_klinis' => [
                'required',
                'string',
                'max:100',
                'min:3',
                $uniqueRule
            ],
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi',
            'nama_kategori_klinis.string' => 'Nama kategori klinis harus berupa teks',
            'nama_kategori_klinis.max' => 'Nama kategori klinis max 100 karakter',
            'nama_kategori_klinis.min' => 'Nama kategori klinis minimal 3 karakter',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada',
        ]);
    }

    protected function createKategoriKlinis(array $data)
    {
        try {
            return KategoriKlinis::create([
                'nama_kategori_klinis' => $this->formatNamaKategoriKLinis($data['nama_kategori_klinis']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data: ' . $e->getMessage()));
        }
    }

    protected function formatNamaKategoriKlinis($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
