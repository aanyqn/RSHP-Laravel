<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use App\Models\RasHewan;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenisHewan')->get();
        $groupedRasHewan = $rasHewan->groupBy('idjenis_hewan');
        return view('admin.ras-hewan.index', compact('groupedRasHewan'));
    }

    public function create()
    {
        $jenis = JenisHewan::all();
        return view('admin.ras-hewan.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRasHewan($request);
        $ras_hewan = $this->createRas($validatedData);
        return redirect()->route('admin.ras-hewan.index')
                        ->with('success', 'Ras Hewan berhasil ditambahkan.');
    }

    protected function validateRasHewan(Request $request, $id = null)
    {
        if($id != null) {
            return $request->validate([
            'nama_ras' => [
                'required',
                'string',
                'min:2',
            ],
            'idras_hewan' => [
                'required',
                'numeric',
            ],
        ], [
            // 'email.required' => 'Email wajib diisi',
            // 'email.email' => 'Email harus dengan format yang benar',
            // 'email.unique' => 'Email sudah ada',

        ]);
        }
        return $request->validate([
            'nama_ras' => [
                'required',
                'string',
                'min:2',
            ],
            'idjenis_hewan' => [
                'required',
                'numeric',
            ],
        ], [
            // 'email.required' => 'Email wajib diisi',
            // 'email.email' => 'Email harus dengan format yang benar',
            // 'email.unique' => 'Email sudah ada',

        ]);
    }

    protected function createRas(array $data)
    {
        
        try {
            return RasHewan::create([
                'nama_ras' => $this->formatNama($data['nama_ras']),
                'idjenis_hewan' => $data['idjenis_hewan'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data: ' . $e->getMessage()));
        }
    }

    public function edit($id)
    {
        return view('admin.ras-hewan.edit', compact('id'));
    }

    public function update(Request $request)
    {
        $validatedData = $this->validateRasHewan($request, $request['idras_hewan']);
        $jenisHewan = $this->updateRasHewan($validatedData);
        return redirect()->route('admin.ras-hewan.index')
                        ->with('success', 'Nama ras hewan berhasil ubah.');
    }

    protected function updateRasHewan(array $data)
    {
        try {
            $rasHewan = \DB::table('ras_hewan')->where('idras_hewan', $data['idras_hewan'])->update([
                'nama_ras' => $this->formatNama($data['nama_ras']),
            ]);
            
        return $rasHewan;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data ras hewan: ' . $e->getMessage()));
        }
    }

    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
