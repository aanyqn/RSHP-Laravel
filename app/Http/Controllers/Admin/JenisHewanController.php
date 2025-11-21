<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use Illuminate\Http\Request;

class JenisHewanController extends Controller
{
    public function index()
    {
        // $jenisHewan = JenisHewan::select('idjenis_hewan', 'nama_jenis_hewan')->get();
        $jenisHewan = \DB::table('jenis_hewan')->select('idjenis_hewan', 'nama_jenis_hewan')->get();
        return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }

    public function create()
    {
        return view('admin.jenis-hewan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateJenisHewan($request);
        $jenisHewan = $this->createJenisHewan($validatedData);
        return redirect()->route('admin.jenis-hewan.index')
                        ->with('success', 'Jenis hewan berhasil ditambahkan.');
    }

    protected function validateJenisHewan(Request $request, $id = null)
    {
        $uniqueRule = $id ?
            'unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan' :
            'unique:jenis_hewan,nama_jenis_hewan';

        if($id != null) {
            return $request->validate([
            'nama_jenis_hewan' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],
            'idjenis_hewan' => [
                'required',
                'numeric'
            ]

        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi',
            'nama_jenis_hewan.string' => 'Nama jenis hewan harus berupa teks',
            'nama_jenis_hewan.max' => 'Nama jenis hewan max 255 karakter',
            'nama_jenis_hewan.min' => 'Nama jenis hewan minimal 3 karakter',
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada',
        ]);
        }

        return $request->validate([
            'nama_jenis_hewan' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule
            ],

        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi',
            'nama_jenis_hewan.string' => 'Nama jenis hewan harus berupa teks',
            'nama_jenis_hewan.max' => 'Nama jenis hewan max 255 karakter',
            'nama_jenis_hewan.min' => 'Nama jenis hewan minimal 3 karakter',
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada',
        ]);
    }

    protected function createJenisHewan(array $data)
    {
        try {
            $jenisHewan = \DB::table('jenis_hewan')->insert([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan'])
            ]);
            return $jenisHewan;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data jenis hewan: ' . $e->getMessage()));
        }
    }
    protected function edit($id)
    {
        return view('admin.jenis-hewan.edit', compact('id'));
    }

    protected function update(Request $request)
    {
        $validatedData = $this->validateJenisHewan($request, $request['idjenis_hewan']);
        $jenisHewan = $this->updateJenisHewan($validatedData);
        return redirect()->route('admin.jenis-hewan.index')
                        ->with('success', 'Jenis hewan berhasil ubah.');
    }
    protected function updateJenisHewan(array $data)
    {
        try {
            $jenisHewan = \DB::table('jenis_hewan')->where('idjenis_hewan', $data['idjenis_hewan'])->update([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan'])
            ]);
            return $jenisHewan;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data jenis hewan: ' . $e->getMessage()));
        }
    }
    protected function destroy($id)
    {
        if (!JenisHewan::where('idjenis_hewan', $id)->exists()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        JenisHewan::where('idjenis_hewan', $id)->delete();

        return redirect()->back()->with('deleteSuccess', 'Data berhasil dihapus.');
    }

    protected function formatNamaJenisHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
