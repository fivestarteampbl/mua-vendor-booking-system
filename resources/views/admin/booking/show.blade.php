@extends('layouts.admin')
@section('title', 'Detail Booking')
@section('page-title', 'Detail Booking')

@section('content')
<div class="max-w-2xl">
    <a href="{{ route('admin.booking.index') }}" class="text-sm text-dark/50 hover:text-dark flex items-center gap-1 mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>

    {{-- Detail Booking --}}
    <div class="bg-white rounded-xl border border-dark/10 shadow-sm p-6 mb-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h2 class="text-xl font-bold">{{ $booking->nama_pelanggan }}</h2>
                <p class="text-sm text-dark/50">{{ $booking->kode_booking }}</p>
            </div>
            {!! $booking->status_badge !!}
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><p class="text-xs text-dark/50 mb-1">Layanan</p><p class="font-medium">{{ $booking->pricelist?->nama_pricelist }}</p></div>
            <div><p class="text-xs text-dark/50 mb-1">Total Harga</p><p class="font-medium">{{ $booking->pricelist?->harga_format }}</p></div>
            <div><p class="text-xs text-dark/50 mb-1">No. WhatsApp</p><p class="font-medium">{{ $booking->no_hp }}</p></div>
            <div><p class="text-xs text-dark/50 mb-1">Email</p><p class="font-medium">{{ $booking->email }}</p></div>
            <div><p class="text-xs text-dark/50 mb-1">Tanggal Acara</p><p class="font-medium">{{ $booking->tanggal_acara->format('d M Y') }}</p></div>
            <div><p class="text-xs text-dark/50 mb-1">Waktu</p><p class="font-medium">{{ $booking->waktu_acara }}</p></div>
            <div><p class="text-xs text-dark/50 mb-1">DP (30%)</p><p class="font-medium">Rp {{ number_format($booking->dp, 0, ',', '.') }}</p></div>
            <div>
                <p class="text-xs text-dark/50 mb-1">Status Pembayaran</p>
                @if($booking->status_pembayaran == 'lunas')
                    <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Lunas</span>
                @elseif($booking->status_pembayaran == 'dp')
                    <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">DP Dibayar</span>
                @else
                    <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Belum DP</span>
                @endif
            </div>
            <div class="col-span-2"><p class="text-xs text-dark/50 mb-1">Lokasi</p><p class="font-medium">{{ $booking->lokasi_acara }}</p></div>
            @if($booking->catatan_tambahan)
            <div class="col-span-2"><p class="text-xs text-dark/50 mb-1">Catatan</p><p class="font-medium">{{ $booking->catatan_tambahan }}</p></div>
            @endif
        </div>
    </div>

    {{-- Update Status --}}
    <div class="bg-white rounded-xl border border-dark/10 shadow-sm p-6 mb-6">
        <h3 class="font-semibold mb-4">Ubah Status</h3>

        <form action="{{ route('admin.booking.updateStatus', $booking) }}" method="POST" class="flex gap-3 flex-wrap">
            @csrf @method('PATCH')

            <select name="status_booking"
                class="border border-dark/20 rounded-lg px-3 py-2 text-sm">
                @foreach([
                'pending'=>'PENDING',
                'konfirmasi'=>'KONFIRMASI',
                'selesai'=>'SELESAI',
                'batal'=>'BATAL'] as $val => $label)

                <option value="{{ $val }}"
                    {{ $booking->status_booking == $val ? 'selected' : '' }}>
                    {{ $label }}
                </option>

                @endforeach
            </select>

            <button type="submit"
                class="bg-dark text-white px-4 py-2 rounded-lg text-sm font-semibold">
                Simpan
            </button>
        </form>
    </div>

    {{-- Payment QR Management (shown when confirmed) --}}
    @if($booking->status_booking == 'konfirmasi')
    <div class="bg-white rounded-xl border border-dark/10 shadow-sm p-6 mb-6">
        <h3 class="font-semibold mb-4">Pembayaran DP</h3>

        <form action="{{ route('admin.booking.updatePayment', $booking) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PATCH')

            <div>
                <label class="block text-xs font-semibold mb-1">Upload QR Code Pembayaran</label>
                @if($booking->payment_qr && \Illuminate\Support\Facades\Storage::exists('public/' . $booking->payment_qr))
                    <div class="mb-3">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($booking->payment_qr) }}"
                             class="w-32 h-32 object-cover rounded-lg border">
                    </div>
                @endif
                <input type="file" name="payment_qr" accept="image/*" class="w-full text-sm border border-dark/20 rounded-lg p-2">
                <p class="text-xs text-dark/50 mt-1">Upload QRIS atau QR code pembayaran lainnya</p>
            </div>

            <div>
                <label class="block text-xs font-semibold mb-1">Metode Pembayaran</label>
                <input type="text" name="metode_pembayaran" value="{{ $booking->metode_pembayaran ?? 'QRIS - BCA/Mandiri' }}"
                       class="w-full border border-dark/20 rounded-lg px-3 py-2 text-sm"
                       placeholder="Contoh: QRIS - BCA a.n. Ulfamuza">
            </div>

            <div>
                <label class="block text-xs font-semibold mb-1">Status Pembayaran</label>
                <select name="status_pembayaran" class="w-full border border-dark/20 rounded-lg px-3 py-2 text-sm">
                    <option value="belum_dp" {{ $booking->status_pembayaran == 'belum_dp' ? 'selected' : '' }}>Belum DP</option>
                    <option value="dp" {{ $booking->status_pembayaran == 'dp' ? 'selected' : '' }}>DP已 Dibayar</option>
                    <option value="lunas" {{ $booking->status_pembayaran == 'lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700">
                Simpan Pembayaran
            </button>
        </form>
    </div>
    @endif

    {{-- Link Testimoni --}}
    @if($booking->status_booking == 'selesai')

        @if($booking->token_testimoni)

            <div class="bg-white rounded-xl border border-dark/10 shadow-sm p-6">
                <h3 class="font-semibold mb-4">Link Testimoni Pelanggan</h3>

                <div class="flex gap-2">
                    <input
                        id="linkTestimoni"
                        type="text"
                        readonly
                        value="{{ url('/testimoni/' . $booking->token_testimoni) }}"
                        class="flex-1 border border-dark/20 rounded-lg px-3 py-2 text-xs">

                    <button
                        type="button"
                        onclick="copyLink()"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg text-xs font-semibold">
                        Salin
                    </button>
                </div>

                <p class="text-xs text-dark/50 mt-2">
                    Kirim link ini kepada pelanggan setelah acara selesai.
                </p>
            </div>

        @else

            <div class="bg-white rounded-xl border border-dark/10 shadow-sm p-6">
                <div class="p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-sm text-yellow-700">
                        Token testimoni belum dibuat. Ubah status menjadi SELESAI untuk membuat token testimoni.
                    </p>
                </div>
            </div>

        @endif

    @endif
</div>

<script>
function copyLink() {
    let copyText = document.getElementById("linkTestimoni");

    copyText.select();
    copyText.setSelectionRange(0, 99999);

    navigator.clipboard.writeText(copyText.value);

    alert("Link testimoni berhasil disalin");
}
</script>
@endsection
