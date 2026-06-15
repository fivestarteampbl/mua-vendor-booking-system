<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Pricelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminLayananController extends Controller
{
    public function index()
    {
        $layanan = Pricelist::with('layanan')
            ->latest()
            ->get();

        $kategori = Layanan::where('aktif', true)->get();
        $semuaLayanan = Layanan::all();

        return view(
            'admin.layanan.index',
            compact('layanan', 'kategori', 'semuaLayanan')
        );
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:50',
            'kategori_layanan' => 'required|string|max:50',
            'deskripsi_layanan' => 'nullable|string|max:500',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'aktif' => 'boolean',
        ]);

        $id = 'lyn' . str_pad(Layanan::count() + 1, 2, '0', STR_PAD_LEFT);

        $data = [
            'id_layanan' => $id,
            'nama_layanan' => $request->nama_layanan,
            'kategori_layanan' => $request->kategori_layanan,
            'deskripsi_layanan' => $request->deskripsi_layanan,
            'aktif' => $request->boolean('aktif'),
        ];

        if ($request->hasFile('foto')) {
            $filename = strtolower(str_replace(' ', '-', $request->kategori_layanan)) . '.png';
            $request->file('foto')->move(public_path('images/layanan'), $filename);
            $data['foto'] = 'images/layanan/' . $filename;
        }

        Layanan::create($data);

        return back()->with('success', 'Kategori layanan berhasil ditambahkan');
    }

    public function updateKategori(Request $request, Layanan $kategoriLayanan)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:50',
            'kategori_layanan' => 'required|string|max:50',
            'deskripsi_layanan' => 'nullable|string|max:500',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'aktif' => 'boolean',
        ]);

        $data = [
            'nama_layanan' => $request->nama_layanan,
            'kategori_layanan' => $request->kategori_layanan,
            'deskripsi_layanan' => $request->deskripsi_layanan,
            'aktif' => $request->boolean('aktif'),
        ];

        if ($request->hasFile('foto')) {
            if ($kategoriLayanan->foto) {
                $oldPath = public_path($kategoriLayanan->foto);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $filename = strtolower(str_replace(' ', '-', $request->nama_layanan)) . '.png';
            $request->file('foto')->move(public_path('images/layanan'), $filename);
            $data['foto'] = 'images/layanan/' . $filename;
        }

        $kategoriLayanan->update($data);

        return back()->with('success', 'Kategori layanan berhasil diperbarui');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_layanan' => 'required',
            'nama_pricelist' => 'required',
            'deskripsi_pricelist' => 'required',
            'harga_pricelist' => 'required|numeric',
            'isi_paket' => 'nullable|string',
            'syarat_ketentuan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $id = 'prc' . str_pad(
            Pricelist::count() + 1,
            2,
            '0',
            STR_PAD_LEFT
        );

        $isiPaket = array_filter(
            array_map('trim', explode("\n", $request->isi_paket ?? ''))
        );

        $syaratKetentuan = array_filter(
            array_map('trim', explode("\n", $request->syarat_ketentuan ?? ''))
        );

        $data = [
            'id_pricelist' => $id,
            'id_layanan' => $request->id_layanan,
            'nama_pricelist' => $request->nama_pricelist,
            'deskripsi_pricelist' => $request->deskripsi_pricelist,
            'isi_paket' => $isiPaket,
            'syarat_ketentuan' => $syaratKetentuan,
            'harga_pricelist' => $request->harga_pricelist,
        ];

        if ($request->hasFile('foto')) {
            $filename = 'prc-' . $id . '.png';
            $request->file('foto')->move(public_path('images/layanan'), $filename);
            $data['foto_pricelist'] = 'images/layanan/' . $filename;
        }

        Pricelist::create($data);

        return back()->with(
            'success',
            'Paket berhasil ditambahkan'
        );
    }

    public function update(Request $request, Pricelist $layanan)
    {
        $request->validate([
            'id_layanan' => 'required',
            'nama_pricelist' => 'required',
            'deskripsi_pricelist' => 'required',
            'isi_paket' => 'nullable|string',
            'syarat_ketentuan' => 'nullable|string',
            'harga_pricelist' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $isiPaket = array_filter(
            array_map('trim', explode("\n", $request->isi_paket ?? ''))
        );

        $syaratKetentuan = array_filter(
            array_map('trim', explode("\n", $request->syarat_ketentuan ?? ''))
        );

        $data = [
            'id_layanan' => $request->id_layanan,
            'nama_pricelist' => $request->nama_pricelist,
            'deskripsi_pricelist' => $request->deskripsi_pricelist,
            'isi_paket' => $isiPaket,
            'syarat_ketentuan' => $syaratKetentuan,
            'harga_pricelist' => $request->harga_pricelist,
        ];

        if ($request->hasFile('foto')) {
            if ($layanan->foto_pricelist) {
                $oldPath = public_path($layanan->foto_pricelist);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $filename = 'prc-' . $layanan->id_pricelist . '.png';
            $request->file('foto')->move(public_path('images/layanan'), $filename);
            $data['foto_pricelist'] = 'images/layanan/' . $filename;
        }

        $layanan->update($data);

        return back()->with(
            'success',
            'Paket berhasil diperbarui'
        );
    }

    public function destroy(Pricelist $layanan)
    {
        $layanan->delete();

        return back()->with(
            'success',
            'Paket berhasil dihapus'
        );
    }
}
