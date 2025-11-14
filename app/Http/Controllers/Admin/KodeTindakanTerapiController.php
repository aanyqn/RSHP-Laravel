<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakanTerapi;
use Illuminate\Http\Request;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::with('kategori', 'kategoriKlinis')->get();
        return view('admin.kode-tindakan-terapi.index', compact('kodeTindakanTerapi'));
    }
    public function create()
    {
        return view('admin.kode-tindakan-terapi.create');
    }
    public function store(Request $request)
    {
        $validatedData = $this->validateKodeTindakanTerapi($request);
        $kategoriKlinis = $this->createKodeTindakanTerapi($validatedData);
        return redirect()->route('admin.kode-tindakan-terapi.index')
                        ->with('success', 'Kategori Klinis berhasil ditambahkan.');
    }
    protected function validateKodeTindakanTerapi(Request $request, $id = null)
    {
        $uniqueRule = $id ?
            'unique:kode_tindakan_terapi, kode' . $id . ',idkode_tindakan_terapi' :
            'unique:kode_tindakan_terapi,kode';

        return $request->validate([
            'kode' => [
                'required',
                'string',
                'max:5',
                'min:3',
                $uniqueRule
            ],
            'deskripsi_tindakan_terapi' => [
                'required',
                'string',
                'max:1000',
                'min:5'
            ],
        ], [
            'kode.required' => 'Kode wajib diisi',
            'kode.string' => 'Kode harus berupa teks',
            'kode.max' => 'Kode max 5 karakter',
            'kode.min' => 'Kode minimal 3 karakter',
            'kode.unique' => 'Kode sudah ada',

            'deskripsi_tindakan_terapi.required' => 'Deskripsi wajib diisi',
            'deskripsi_tindakan_terapi.string' => 'Deskripsi harus berupa teks',
            'deskripsi_tindakan_terapi.max' => 'Deskripsi max 1000 karakter',
            'deskripsi_tindakan_terapi.min' => 'Deskripsi minimal 5 karakter',
            'deskripsi_tindakan_terapi.unique' => 'Deskripsi sudah ada',
        ]);
    }

    protected function createKodeTindakanTerapi(array $data)
    {
        try {
            return KodeTindakanTerapi::create([
                'kode' => $this->formatKode($data['kode']),
                'deskripsi_tindakan_terapi' => $data['deskripsi_tindakan_terapi'],

            ]);
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data: ' . $e->getMessage()));
        }
    }
    protected function formatKode($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
} 
