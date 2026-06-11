@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-50 px-6 pt-24 pb-16 text-slate-900 dark:bg-slate-950 dark:text-white">
    <div class="mx-auto max-w-6xl">

        <a href="{{ route('cart.index') }}"
           class="mb-6 inline-block text-sm font-bold text-cyan-300 hover:text-pink-300">
            ← Kembali ke Keranjang
        </a>

        <div class="mb-8">
            <h1 class="text-3xl font-black text-cyan-300">
                Formulir Pengajuan Sewa
            </h1>
            <p class="mt-2 text-sm text-slate-400">
                Lengkapi data penyewaan, lalu lanjutkan ke pembayaran.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-400/30 bg-red-400/10 p-4 text-red-300">
                <p class="font-bold">Ada data yang belum sesuai:</p>
                <ul class="mt-2 list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $subtotal = collect($items)->sum('subtotal');
            $discount = session('voucher.discount', 0);
            $total = max($subtotal - $discount, 0);
            $firstItem = collect($items)->first();
        @endphp

        <form action="{{ route('penyewaan.store') }}" method="POST">
            @csrf

            <div class="grid gap-8 lg:grid-cols-[1fr_380px]">

                <div class="space-y-6">

                    <div class="rounded-3xl border border-cyan-400/20 bg-slate-900 p-6 shadow-2xl">
                        <h2 class="mb-5 flex items-center gap-2 text-lg font-black text-white">
                            <span class="text-cyan-300">♙</span>
                            Data Pelanggan
                        </h2>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-bold text-slate-300">
                                    Nama Lengkap
                                </label>
                                <input id="nama"
                                       name="nama"
                                       type="text"
                                       value="{{ old('nama', auth()->user()->name ?? '') }}"
                                       placeholder="Masukkan nama lengkap..."
                                       class="w-full rounded-xl border border-cyan-400/20 bg-slate-950 px-4 py-3 text-white outline-none placeholder:text-slate-500 focus:border-cyan-300">
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-bold text-slate-300">
                                    Nomor WhatsApp
                                </label>
                                <input id="waPelanggan"
                                       name="no_wa"
                                       type="text"
                                       value="{{ old('no_wa') }}"
                                       placeholder="0812xxxx"
                                       class="w-full rounded-xl border border-cyan-400/20 bg-slate-950 px-4 py-3 text-white outline-none placeholder:text-slate-500 focus:border-cyan-300">
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-bold text-slate-300">
                                    Sistem Pembayaran
                                </label>

                                <div class="rounded-xl border border-cyan-400/20 bg-slate-950 px-4 py-3">
                                    <div class="flex items-center justify-between gap-3">
                                        <div>
                                            <p class="font-bold text-cyan-300">Payment Internal</p>
                                            <p class="mt-1 text-xs text-slate-400">
                                                Pilih metode dan upload bukti transfer di halaman pembayaran.
                                            </p>
                                        </div>

                                        <span class="rounded-full bg-pink-400/10 px-3 py-1 text-xs font-bold text-pink-300">
                                            Manual
                                        </span>
                                    </div>

                                    <input type="hidden" name="metode_pembayaran" value="Payment Internal">
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-bold text-slate-300">
                                    Alamat Domisili
                                </label>
                                <textarea id="alamat"
                                          name="alamat"
                                          rows="4"
                                          placeholder="Masukkan alamat lengkap Anda..."
                                          class="w-full rounded-xl border border-cyan-400/20 bg-slate-950 px-4 py-3 text-white outline-none placeholder:text-slate-500 focus:border-cyan-300">{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-cyan-400/20 bg-slate-900 p-6 shadow-2xl">
                        <h2 class="mb-5 flex items-center gap-2 text-lg font-black text-white">
                            <span class="text-cyan-300">▣</span>
                            Detail Waktu & Lokasi
                        </h2>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-bold text-slate-300">
                                    Tanggal Pengambilan
                                </label>
                                <input id="tanggalAmbil"
                                       name="tanggal_ambil"
                                       type="date"
                                       value="{{ old('tanggal_ambil', $firstItem['tanggal_mulai'] ?? '') }}"
                                       class="w-full rounded-xl border border-cyan-400/20 bg-slate-950 px-4 py-3 text-white outline-none focus:border-cyan-300">
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-bold text-slate-300">
                                    Tanggal Pengembalian
                                </label>
                                <input id="tanggalKembali"
                                       name="tanggal_kembali"
                                       type="date"
                                       value="{{ old('tanggal_kembali') }}"
                                       readonly
                                       class="w-full rounded-xl border border-cyan-400/20 bg-slate-950 px-4 py-3 text-white outline-none focus:border-cyan-300">
                            </div>

                            <div class="md:col-span-2 rounded-2xl border border-cyan-400/30 bg-cyan-400/10 p-4">
                                <p class="font-bold text-cyan-300">Lokasi Ambil:</p>

                                <p id="lokasiAmbil" class="mt-1 text-sm text-slate-200">
                                    Jl. Contoh Nekoya No. 12, Kota Indah
                                </p>

                                <a href="https://maps.app.goo.gl/8E6LFrGvvJRGhKZC6"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="mt-1 inline-block text-xs font-semibold text-cyan-300 hover:text-pink-300 hover:underline">
                                    Lihat di Google Maps
                                </a>
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-bold text-slate-300">
                                    Catatan Tambahan (Opsional)
                                </label>
                                <textarea id="catatan"
                                          name="catatan"
                                          rows="3"
                                          placeholder="Contoh: Titip di satpam atau butuh ukuran tertentu..."
                                          class="w-full rounded-xl border border-cyan-400/20 bg-slate-950 px-4 py-3 text-white outline-none placeholder:text-slate-500 focus:border-cyan-300">{{ old('catatan') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-fit space-y-5">
                    <div class="overflow-hidden rounded-3xl border border-pink-400/20 bg-slate-900 shadow-2xl">

                        @if(!empty($firstItem['foto']))
                            <img src="{{ asset('image/' . $firstItem['foto']) }}"
                                 alt="{{ $firstItem['nama_kostum'] }}"
                                 class="h-64 w-full object-cover">
                        @else
                            <div class="flex h-64 w-full items-center justify-center bg-slate-800 text-slate-400">
                                Tidak ada gambar
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="mb-4 flex items-start justify-between gap-4">
                                <div>
                                    <h2 class="text-xl font-black text-white">
                                        {{ $firstItem['nama_kostum'] ?? 'Kostum' }}
                                    </h2>
                                    <p class="mt-1 text-sm text-slate-400">
                                        Kualitas Premium
                                    </p>
                                </div>

                                <span class="rounded-full bg-cyan-400/10 px-3 py-1 text-xs font-bold text-cyan-300">
                                    {{ count($items) }} Item
                                </span>
                            </div>

                            <div class="space-y-3 border-b border-slate-700 pb-5 text-sm">
                                @foreach($items as $item)
                                    <div class="flex justify-between gap-4">
                                        <span class="text-slate-400">
                                            {{ $item['nama_kostum'] }}
                                        </span>
                                        <span class="font-bold text-white">
                                            Rp{{ number_format($item['subtotal'], 0, ',', '.') }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between gap-4">
                                        <span class="text-slate-400">
                                            Durasi Sewa
                                        </span>
                                        <span class="font-bold text-white">
                                            {{ $item['durasi'] }} Hari
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-5 space-y-3 border-b border-slate-700 pb-5 text-sm">
                                <div class="flex justify-between text-slate-300">
                                    <span>Subtotal</span>
                                    <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>

                                @if(session('voucher'))
                                    <div class="flex justify-between text-cyan-300">
                                        <span>Voucher {{ session('voucher.code') }}</span>
                                        <span>- Rp{{ number_format($discount, 0, ',', '.') }}</span>
                                    </div>
                                @else
                                    <div class="flex justify-between text-slate-400">
                                        <span>Voucher</span>
                                        <span>- Rp0</span>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-5 flex justify-between text-xl font-black">
                                <span>Total Harga</span>
                                <span class="text-cyan-300">
                                    Rp{{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-cyan-400/20 bg-slate-900 p-4 text-xs text-slate-400">
                        Setelah klik lanjut pembayaran, sistem akan membuat data penyewaan dengan status
                        <span class="font-bold text-cyan-300">menunggu pembayaran</span>.
                        Selanjutnya kamu dapat memilih metode pembayaran dan mengupload bukti transfer.
                    </div>

                    <button type="submit"
                            class="w-full rounded-xl bg-gradient-to-r from-cyan-400 to-pink-400 px-6 py-4 font-black text-slate-950 transition hover:scale-[1.02]">
                        Lanjut ke Pembayaran
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tanggalAmbil = document.getElementById('tanggalAmbil');
    const tanggalKembali = document.getElementById('tanggalKembali');

    const durasi = {{ $firstItem['durasi'] ?? 1 }};

    function updateTanggalKembali() {
        if (!tanggalAmbil || !tanggalKembali || !tanggalAmbil.value) {
            return;
        }

        const date = new Date(tanggalAmbil.value);
        date.setDate(date.getDate() + durasi + 1);
        tanggalKembali.value = date.toISOString().split('T')[0];
    }

    updateTanggalKembali();

    if (tanggalAmbil) {
        tanggalAmbil.addEventListener('change', updateTanggalKembali);
    }
});
</script>
@endsection
