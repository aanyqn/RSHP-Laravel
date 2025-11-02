<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class DaftarPetController extends Controller
{
    public function index()
    {
        $id = session('user_id');
        $pets = Pet::with(['pemilik.user', 'rasHewan'])
                ->whereHas('pemilik', function($query) use ($id) {
                $query->where('iduser', $id);})
                ->get();
        return view('pemilik.daftar-pet.index', compact('pets'));
    }
}
