<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    public function index() 
    {
        return view ('sites.home');
    }

    public function layanan()
    {
        return view ('sites.layanan');
    }

    public function struktur()
    {
        return view  ('sites.struktur');
    }

    public function visiMisi()
    {
        return view ('sites.visimisi');
    }

    public function login()
    {
        return view ('sites.login');
    }

    public function cekKoneksi()
    {
        try {
            \DB::connection()->getPdo();
            return 'Koneksi ke database berhasil!';
        } catch (\Exception $e) {
            return 'Koneksi ke database gagal: ' . $e->getMessage();
        }
    }
}
