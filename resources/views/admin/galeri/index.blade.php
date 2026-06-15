@extends('layouts.admin')
@section('title', 'Kelola Galeri')
@section('page-title', 'Kelola Galeri')

@section('content')
<div class="flex justify-end mb-6">
    <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
        class="bg-dark text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-dark/80 flex items-center gap-2">
        <i data-lucide="plus" class="w-4 h-4"></i> Tambah Foto
    </button>
</div>

@if($galeri->isEmpty())
<p class="text-center text-dark/40 text-sm mt-8">Belum ada foto di galeri.</p>
@else
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
    @foreach($galeri as $foto)
    <div class="bg-white rounded-xl shadow-sm border border-dark/10 overflow-hidden group">
        <div class="relative">
            <img src="{{ Storage::url($foto->foto) }}" class="w-full h-48 object-cover" alt="{{ $foto->judul_galeri }}">
            @if(!$foto->status_aktif)
            <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                <span class="text-white text-xs font-semibold bg-black/50 px-2 py-1 rounded">Disembunyikan</span>
            </div>
            @endif
        </div>
        <div class="p-3">
            <p class="font-semibold text-sm truncate">{{ $foto->judul_galeri }}</p>
            <p class="text-xs text-dark/50">{{ $foto->kategori_galeri }}</p>
            <p class="text-xs mt-1 text-dark/70">{{ $foto->deskripsi_galeri }}</p>
            <div class="flex gap-2 mt-3">
                <button onclick='openEditModal(@json($foto))'
                    class="flex-1 text-xs font-semibold bg-pearly border border-dark/20 rounded-lg py-1.5 hover:bg-blush/30">Edit</button>
                <form action="{{ route('admin.galeri.destroy', $foto) }}" method="POST"
                    onsubmit="return confirm('Hapus foto ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-xs font-semibold text-red-500 hover:text-red-700 border border-red-200 rounded-lg px-3 py-1.5">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

{{-- Modal Tambah --}}
<div id="modalTambah" class="hidden fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-4">
    <div class="bg-white w-full max-w-[420px] rounded-2xl p-6 shadow-xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Tambah Foto</h3>
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')">
                <i data-lucide="x" class="w-5 h-5 text-dark/50"></i>
            </button>
        </div>
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-sm">
            @csrf
            <div>
                <label class="block text-xs font-semibold mb-1">Judul</label>
                <input type="text" name="judul_galeri" required class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark" placeholder="Contoh: Wedding A">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Kategori</label>
                <select name="kategori_galeri" class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark">
                    <option value="">-- Pilih --</option>
                    <option value="Wedding">Wedding</option>
                    <option value="Wisuda">Wisuda</option>
                    <option value="Prewedding">Prewedding</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi_galeri" rows="2" class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Foto *</label>
                <input type="file" name="foto" accept="image/*" required class="w-full text-xs">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status_aktif" value="1" checked class="accent-dark" id="aktifAdd">
                <label for="aktifAdd" class="text-xs">Tampilkan di Halaman Utama</label>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-200 rounded-lg text-xs font-semibold">Batal</button>
                <button type="submit" class="px-4 py-2 bg-dark text-white rounded-lg text-xs font-semibold">Upload</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit --}}
<div id="modalEdit" class="hidden fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-4">
    <div class="bg-white w-full max-w-[420px] rounded-2xl p-6 shadow-xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Edit Foto</h3>
            <button onclick="document.getElementById('modalEdit').classList.add('hidden')">
                <i data-lucide="x" class="w-5 h-5 text-dark/50"></i>
            </button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-3 text-sm">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs font-semibold mb-1">Judul</label>
                <input type="text" name="judul_galeri" id="editJudul" required class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Kategori</label>
                <select name="kategori_galeri" id="editKategori" class="w-full border border-dark/20 rounded-lg p-2 outline-none focus:border-dark">
                    <option value="">-- Pilih --</option>
                    <option value="Wedding">Wedding</option>
                    <option value="Wisuda">Wisuda</option>
                    <option value="Prewedding">Prewedding</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1">Foto Baru (opsional)</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-xs">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status_aktif" value="1" class="accent-dark" id="editAktif">
                <label for="editAktif" class="text-xs">Tampilkan di Halaman Utama</label>
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
        document.getElementById('editForm').action = '/admin/galeri/' + data.id;
        document.getElementById('editJudul').value = data.judul_galeri;
        document.getElementById('editKategori').value = data.kategori_galeri || '';
        document.getElementById('editAktif').checked = data.status_aktif;
        document.getElementById('modalEdit').classList.remove('hidden');
    }
</script>
@endpush
@endsection