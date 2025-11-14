<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('pemilik', 'rasHewan')->get();
        return view('admin.pet.index', compact('pets'));
    }
    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        $ras = RasHewan::all();
        return view('admin.pet.create', compact('pemilik', 'ras'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validatePet($request);
        $pet = $this->createPet($validatedData);
        return redirect()->route('admin.pet.index')
                        ->with('success', 'Pet berhasil ditambahkan.');
    }

    protected function validatePet(Request $request, $id = null)
    {
        return $request->validate([
            'nama' => [
                'required',
                'string',
                'min:2',
            ],
            'tanggal_lahir' => [
                'required',
                'date',
            ],
            'warna_tanda' => [
                'required',
            ],
            'jenis_kelamin' => [
                'required',
            ],
            'idpemilik' => [
                'required',
                'numeric',
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

    protected function createPet(array $data)
    {
        
        try {
            return Pet::create([
                'nama' => $data['nama'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'warna_tanda' => $data['warna_tanda'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'idpemilik' => $data['idpemilik'],
                'idras_hewan' => $data['idras_hewan'],
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
