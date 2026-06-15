@extends('layouts.admin')
@section('title', 'Kelola Layanan')
@section('page-title', 'Kelola Layanan')

@section('content')
{{-- Kategori Layanan --}}
<div class="bg-white rounded-xl shadow-sm border border-dark/10 p-4 md:p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold">Kategori Layanan</h3>
        <button onclick="document.getElementById('modalTambahLayanan').classList.remove('hidden')"
            class="text-xs font-semibold px-3 py-1.5 bg-dark text-white rounded-lg hover:bg-dark/80 transition flex items-center gap-1">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Layanan
        </button>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @foreach($semuaLayanan as $kat)
        <div class="border border-dark/10 rounded-xl p-4 flex items-center gap-4">
            @if($kat->foto && file_exists(public_path($kat->foto)))
            <img src="{{ asset($kat->foto) }}" class="w-16 h-16 rounded-lg object-cover shrink-0">
            @else
            <div class="w-16 h-16 rounded-lg bg-blush/30 flex items-center justify-center shrink-0">
                <span class="text-xs text-dark/40">No img</span>
            </div>
            @endif
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-sm truncate">{{ $kat->nama_layanan }}</p>
                <p class="text-xs text-dark/50 truncate">{{ $kat->kategori_layanan }}</p>
                <span class="text-xs {{ $kat->aktif ? 'text-green-600' : 'text-red-500' }}">{{ $kat->aktif ? 'Aktif' : 'Nonaktif' }}</span>
            </div>
            <button data-kategori="{{ json_encode($kat->only(['id_layanan', 'nama_layanan', 'kategori_layanan', 'deskripsi_layanan', 'aktif']), JSON_HEX_APOS | JSON_HEX_QUOT) }}"
                onclick="openEditKategori(this)"
                class="text-xs font-semibold px-3 py-1.5 bg-pearly border border-dark/20 rounded-lg hover:bg-blush/30 shrink-0">
                Edit
            </button>
        </div>
        @endforeach
    </div>
</div>

{{-- Tambah Paket --}}
<div class="flex justify-end mb-6">
    <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
        class="bg-dark text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-dark/80 transition flex items-center gap-2">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Paket
    </button>
</div>

@foreach($layanan->groupBy(fn($item) => $item->layanan?->kategori_layanan ?? 'Tanpa Kategori') as $namaKategori => $items)
<div class="mb-8 bg-[#F8EFEA] p-4 md:p-6 rounded-2xl shadow-sm border border-blush/30">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold text-lg">{{ $namaKategori }}</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full min-w-[600px] text-sm text-left">
            <thead>
                <tr class="border-b border-dark/10">
                    <th class="pb-2 font-semibold">Foto</th>
                    <th class="pb-2 font-semibold">Nama Paket</th>
                    <th class="pb-2 font-semibold">Harga</th>
                    <th class="pb-2 font-semibold">Status</th>
                    <th class="pb-2 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr class="border-b border-dark/5 hover:bg-white/40">
                    <td class="py-3">
                        @if($item->foto_pricelist && file_exists(public_path($item->foto_pricelist)))
                        <img src="{{ asset($item->foto_pricelist) }}" class="w-10 h-10 rounded-lg object-cover">
                        @else
                        <div class="w-10 h-10 rounded-lg bg-blush/30 flex items-center justify-center">
                            <span class="text-[8px] text-dark/40">-</span>
                        </div>
                        @endif
                    </td>
                    <td class="py-3 font-medium">
                        {{ $item->nama_pricelist }}
                    </td>

                    <td class="py-3">
                        Rp {{ number_format($item->harga_pricelist,0,',','.') }}
                    </td>

                    <td class="py-3">
                        @if($item->layanan?->aktif)
                        <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs">
                            Aktif
                        </span>
                        @else
                        <span class="px-2 py-0.5 bg-gray-100 text-gray-500 rounded-full text-xs">
                            Nonaktif
                        </span>
                        @endif
                    </td>

                    <td class="py-3 text-center">
                        <button
                            onclick='openEditModal(@json($item))'
                            class="text-xs font-semibold text-dark hover:underline mr-2">
                            Edit
                        </button>

                        <form
                            action="{{ route('admin.layanan.destroy',$item->id_pricelist) }}"
                            method="POST"
                            class="inline"
                            onsubmit="return confirm('Hapus paket ini?')">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="text-xs font-semibold text-red-500 hover:text-red-700">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endforeach

{{-- Modal Tambah Layanan --}}
<div id="modalTambahLayanan" class="hidden fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-4">
    <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Tambah Kategori Layanan</h3>
            <button onclick="document.getElementById('modalTambahLayanan').classList.add('hidden')">
                <i data-lucide="x" class="w-5 h-5 text-dark/50"></i>
            </button>
        </div>
        <form action="{{ route('admin.layanan.storeKategori') }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-sm">
            @csrf
            <div>
                <label class="block text-xs font-semibold mb-1">Nama Layanan</label>
                <input type="text" name="nama_layanan" required class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark" placeholder="cth: Wedding Makeup">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Kategori (slug)</label>
                <input type="text" name="kategori_layanan" required class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark" placeholder="cth: wedding">
                <p class="text-[10px] text-dark/50 mt-1">Digunakan untuk grouping di halaman publik</p>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi_layanan" rows="3" class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Foto (opsional)</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-xs">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="aktif" id="aktifTambahLayanan" value="1" checked class="accent-dark">
                <label for="aktifTambahLayanan" class="text-xs">Aktif / Tampilkan</label>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modalTambahLayanan').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-200 rounded-lg text-xs font-semibold">Batal</button>
                <button type="submit" class="px-4 py-2 bg-dark text-white rounded-lg text-xs font-semibold">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Kategori --}}
<div id="modalEditKategori" class="hidden fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-4">
    <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Edit Kategori Layanan</h3>
            <button onclick="document.getElementById('modalEditKategori').classList.add('hidden')">
                <i data-lucide="x" class="w-5 h-5 text-dark/50"></i>
            </button>
        </div>
        <form id="editKategoriForm" method="POST" enctype="multipart/form-data" class="space-y-3 text-sm">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs font-semibold mb-1">Nama Layanan</label>
                <input type="text" name="nama_layanan" id="editKatNama" required class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Kategori (slug)</label>
                <input type="text" name="kategori_layanan" id="editKatSlug" required class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi_layanan" id="editKatDeskripsi" rows="3" class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Foto Baru (opsional)</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-xs">
                <p class="text-[10px] text-dark/50 mt-1">Kosongkan jika tidak ingin mengganti foto</p>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="aktif" id="editKatAktif" value="1" class="accent-dark">
                <label for="editKatAktif" class="text-xs">Aktif / Tampilkan</label>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modalEditKategori').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-200 rounded-lg text-xs font-semibold">Batal</button>
                <button type="submit" class="px-4 py-2 bg-dark text-white rounded-lg text-xs font-semibold">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Tambah Paket --}}
<div id="modalTambah" class="hidden fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-4">
    <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl overflow-y-auto max-h-[90vh]">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Tambah Paket</h3>
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')">
                <i data-lucide="x" class="w-5 h-5 text-dark/50"></i>
            </button>
        </div>
        <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-sm">
            @csrf
            <div>
                <label class="block text-xs font-semibold mb-1">Nama Paket</label>
                <input type="text" name="nama_pricelist" required class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Kategori</label>
                <select name="id_layanan" required class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark">
                    @foreach($kategori as $k)
                    <option value="{{ $k->id_layanan }}">
                        {{ $k->nama_layanan }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Harga (Rp)</label>
                <input type="number" name="harga_pricelist" min="0" required class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi_pricelist" rows="2" class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Isi Paket (satu per baris)</label>
                <textarea name="isi_paket" rows="5" class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark" placeholder="Make Up&#10;Hair Do&#10;Softlens"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">
                    Syarat & Ketentuan
                </label>

                <textarea name="syarat_ketentuan" rows="5" class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark" placeholder="Syarat 1&#10;Syarat 2&#10;Syarat 3"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Foto</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-xs">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="aktif" id="aktifTambah" value="1" checked class="accent-dark">
                <label for="aktifTambah" class="text-xs">Aktif / Tampilkan</label>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-200 rounded-lg text-xs font-semibold">Batal</button>
                <button type="submit" class="px-4 py-2 bg-dark text-white rounded-lg text-xs font-semibold">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Paket --}}
<div id="modalEdit" class="hidden fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-4">
    <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl overflow-y-auto max-h-[90vh]">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Edit Paket</h3>
            <button onclick="document.getElementById('modalEdit').classList.add('hidden')">
                <i data-lucide="x" class="w-5 h-5 text-dark/50"></i>
            </button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-3 text-sm">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs font-semibold mb-1">Nama Paket</label>
                <input type="text" name="nama_pricelist" id="editNama" required class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Kategori</label>
                <select name="id_layanan" id="editKategori" required class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark">
                    @foreach($kategori as $k)
                    <option value="{{ $k->id_layanan }}">
                        {{ $k->nama_layanan }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Harga (Rp)</label>
                <input type="number" name="harga_pricelist" id="editHarga" min="0" required class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi_pricelist" id="editDeskripsi" rows="2" class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">
                    Isi Paket
                </label>

                <textarea name="isi_paket" id="editIsiPaket" rows="5" class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold mb-1">
                    Syarat & Ketentuan
                </label>

                <textarea name="syarat_ketentuan" id="editSyarat" rows="5" class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark">
            </textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Foto Baru (opsional)</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-xs">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="aktif" id="editAktif" value="1" class="accent-dark">
                <label for="editAktif" class="text-xs">Aktif / Tampilkan</label>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-200 rounded-lg text-xs font-semibold">Batal</button>
                <button type="submit" class="px-4 py-2 bg-dark text-white rounded-lg text-xs font-semibold">Update</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openEditModal(data) {
        document.getElementById('editForm').action = '/admin/layanan/' + data.id_pricelist;
        document.getElementById('editNama').value = data.nama_pricelist;
        document.getElementById('editKategori').value = data.id_layanan;
        document.getElementById('editHarga').value = data.harga_pricelist;
        document.getElementById('editDeskripsi').value = data.deskripsi_pricelist ?? '';
        document.getElementById('editIsiPaket').value = data.isi_paket ? data.isi_paket.join("\n") : '';
        document.getElementById('editSyarat').value = data.syarat_ketentuan ? data.syarat_ketentuan.join("\n") : '';
        document.getElementById('editAktif').checked = data.aktif;
        document.getElementById('modalEdit').classList.remove('hidden');
    }

    function openEditKategori(btn) {
        const data = JSON.parse(btn.dataset.kategori);
        document.getElementById('editKategoriForm').action = '/admin/layanan-kategori/' + data.id_layanan;
        document.getElementById('editKatNama').value = data.nama_layanan;
        document.getElementById('editKatSlug').value = data.kategori_layanan;
        document.getElementById('editKatDeskripsi').value = data.deskripsi_layanan || '';
        document.getElementById('editKatAktif').checked = data.aktif;
        document.getElementById('modalEditKategori').classList.remove('hidden');
    }
</script>
@endpush
@endsection