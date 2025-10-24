<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('pemilik', 'rasHewan')->get();
        return view('admin.pet.index', compact('pets'));
    }
}
