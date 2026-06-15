<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    //
    public function index()
    {
        $galeri = Galeri::orderBy('urutan_galeri', 'asc')
            ->get();

        return view('admin.galeri.index', compact('galeri'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_galeri' => 'required|string|max:50',
            'deskripsi_galeri' => 'required|string|max:100',
            'foto' => 'required|image|mimes:jpg,png|max:4096',
            'kategori_galeri' => 'required|string|max:50',
            'status_aktif' => 'boolean'
        ]);

        $validated['foto'] = $request->file('foto')->store('galeri', 'public');
        $validated['urutan_galeri'] = Galeri::max('urutan_galeri') + 1;

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil ditambahkan');
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul_galeri' => 'required|string|max:50',
            'deskripsi_galeri' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpg|max:4096',
            'kategori_galeri' => 'required|string|max:50',
            'status_aktif' => 'boolean'
        ]);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($galeri->foto);
            $validated['foto'] = $request->file('foto')->store('galeri', 'public');
        }
        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil diupdate');
    }

    public function destroy(Galeri $galeri)
    {
        Storage::disk('public')->delete($galeri->foto);
        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil dihapus');
    }
}
