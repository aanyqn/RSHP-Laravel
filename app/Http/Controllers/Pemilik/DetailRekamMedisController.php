<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailRekamMedisController extends Controller
{
    public function index($id) 
    {
        $detailRekamMedis = \DB::table('detail_rekam_medis')->leftJoin('kode_tindakan_terapi', 'detail_rekam_medis.idkode_tindakan_terapi', '=', 'kode_tindakan_terapi.idkode_tindakan_terapi')->leftJoin('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')->leftJoin('kategori', 'kode_tindakan_terapi.idkategori','=','kategori.idkategori')->where('idrekam_medis', $id)
        ->select('detail_rekam_medis.*', 'kode_tindakan_terapi.kode', 'kode_tindakan_terapi.deskripsi_tindakan_terapi', 'kategori_klinis.nama_kategori_klinis', 'kategori.nama_kategori')->get();
        return view('pemilik.data-medis.rekam-medis.detail.index', compact('detailRekamMedis'));
    }
}
