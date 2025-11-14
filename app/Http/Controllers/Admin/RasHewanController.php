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

    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
