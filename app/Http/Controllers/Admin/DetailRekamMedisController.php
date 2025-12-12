<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailRekamMedis;
use Illuminate\Http\Request;

class DetailRekamMedisController extends Controller
{
    public function index($id) 
    {
        $detailRekamMedis = \DB::table('detail_rekam_medis')->leftJoin('kode_tindakan_terapi', 'detail_rekam_medis.idkode_tindakan_terapi', '=', 'kode_tindakan_terapi.idkode_tindakan_terapi')->leftJoin('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')->leftJoin('kategori', 'kode_tindakan_terapi.idkategori','=','kategori.idkategori')->where('idrekam_medis', $id)
        ->select('detail_rekam_medis.*', 'kode_tindakan_terapi.kode', 'kode_tindakan_terapi.deskripsi_tindakan_terapi', 'kategori_klinis.nama_kategori_klinis', 'kategori.nama_kategori')->get();
        return view('admin.daftar-rekam-medis.detail.index', compact('detailRekamMedis'));
    }
    public function create($id)
    {
        $kode_tindakan_terapi = \DB::table('kode_tindakan_terapi')->select('idkode_tindakan_terapi', 'deskripsi_tindakan_terapi')->get();
        return view('admin.daftar-rekam-medis.detail.create', compact('kode_tindakan_terapi', 'id'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateData($request);
        $detailRekamMedis = $this->createDetail($validatedData);
        return redirect()->route('admin.rekam-medis.detail.index', [$request->idrekam_medis])
                        ->with('success', 'Detail Rekam Medis berhasil ditambahkan.');
    }

    protected function validateData(Request $request, $id = null)
    {
        if($id != null) {
            return $request->validate([
            'detail' => [
                'required',
                'string',
                'max:1000',
                'min:10',
            ],
            'idrekam_medis' => [
                'required',
                'numeric'
            ],
            'idkode_tindakan_terapi' => [
                'required',
                'numeric'
            ],
            'iddetail_rekam_medis' => [
                'required',
                'numeric'
            ]
        ], [
            'detail.required' => 'Nama jenis hewan wajib diisi',
            'detail.string' => 'Nama jenis hewan harus berupa teks',
            'detail.max' => 'Nama jenis hewan max 255 karakter',
            'detail.min' => 'Nama jenis hewan minimal 3 karakter',
            'detail.unique' => 'Nama jenis hewan sudah ada',
        ]);
        }

        return $request->validate([
            'detail' => [
                'required',
                'string',
                'max:1000',
                'min:10',
            ],
            'idrekam_medis' => [
                'required',
                'numeric'
            ],
            'idkode_tindakan_terapi' => [
                'required',
                'numeric'
            ],

        ], [
            'detail.required' => 'detail wajib diisi',
            'detail.string' => 'detail harus berupa teks',
            'detail.max' => 'detail max 1000 karakter',
            'detail.min' => 'detail minimal 10 karakter',
            'detail.unique' => 'detail sudah ada',
        ]);
    }

    protected function createDetail(array $data)
    {
        try {
            $detail = \DB::table('detail_rekam_medis')->insert([
                'idrekam_medis' => $data['idrekam_medis'],
                'idkode_tindakan_terapi' => $data['idkode_tindakan_terapi'],
                'detail' => $data['detail']
            ]);
            return $detail;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan detail: ' . $e->getMessage()));
        }
    }
    protected function edit($id)
    {
       $kode_tindakan_terapi = \DB::table('kode_tindakan_terapi')->select('idkode_tindakan_terapi', 'deskripsi_tindakan_terapi')->get();
        $detail_rekam_medis = \DB::table('detail_rekam_medis')->where('iddetail_rekam_medis', $id)->select('idrekam_medis','idkode_tindakan_terapi', 'detail')->get();
        return view('admin.daftar-rekam-medis.detail.edit', compact('id', 'detail_rekam_medis', 'kode_tindakan_terapi'));
    }
    protected function update(Request $request)
    {
        $validatedData = $this->validateData($request, $request['iddetail_rekam_medis']);
        $detail = $this->updateDetail($validatedData);
        return redirect()->route('admin.rekam-medis.detail.index', [$request->idrekam_medis])
                        ->with('success', 'Detail berhasil ubah.');
    }
    protected function updateDetail(array $data)
    {
        try {
            $detail = \DB::table('detail_rekam_medis')->where('iddetail_rekam_medis', $data['iddetail_rekam_medis'])->update([
                'idkode_tindakan_terapi' => $data['idkode_tindakan_terapi'],
                'detail' => $data['detail'],
            ]);
            return $detail;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan detail: ' . $e->getMessage()));
        }
    }
    protected function destroy($id)
    {
        if (!DetailRekamMedis::where('iddetail_rekam_medis', $id)->exists()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        try {
            DetailRekamMedis::where('iddetail_rekam_medis', $id)->delete();
            return redirect()->back()->with('deleteSuccess', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menghapus riwayat rekam medis: ' . $e->getMessage()));
        }
    }
}
