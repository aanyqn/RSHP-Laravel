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
    protected function edit($id)
    {
        return view('admin.kategori-klinis.edit', compact('id'));
    }
    protected function update(Request $request)
    {
        $validatedData = $this->validateKategoriKlinis($request, $request['idkategori_klinis']);
        $kategoriKlinis = $this->updateKategori($validatedData);
        return redirect()->route('admin.kategori-klinis.index')
                        ->with('success', 'Kategori Klinis berhasil ubah.');
    }
    protected function validateKategoriKlinis(Request $request, $id = null)
    {
        $uniqueRule = $id ?
            'unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis' :
            'unique:kategori_klinis,nama_kategori_klinis';

        if($id != null) {
            return $request->validate([
            'nama_kategori_klinis' => [
                'required',
                'string',
                'max:100',
                'min:3',
                $uniqueRule
            ],
            'idkategori_klinis' => [
                'required',
                'numeric'
            ],
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori wajib diisi',
            'nama_kategori_klinis.string' => 'Nama kategori harus berupa teks',
            'nama_kategori_klinis.max' => 'Nama kategori max 100 karakter',
            'nama_kategori_klinis.min' => 'Nama kategori minimal 3 karakter',
            'nama_kategori_klinis.unique' => 'Nama kategori sudah ada', 
        ]);
        }

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

    protected function updateKategori(array $data)
    {
        try {
            $kategoriKlinis = \DB::table('kategori_klinis')->where('idkategori_klinis', $data['idkategori_klinis'])->update([
                'nama_kategori_klinis' => $this->formatNamaKategoriKlinis($data['nama_kategori_klinis'])
            ]);
            return $kategoriKlinis;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data kateogri klinis: ' . $e->getMessage()));
        }
    }


    protected function formatNamaKategoriKlinis($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
