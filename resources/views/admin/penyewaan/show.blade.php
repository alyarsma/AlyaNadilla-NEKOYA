@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-50 px-6 pt-24 pb-16 text-slate-900 dark:bg-slate-950 dark:text-white">
    <div class="mx-auto max-w-5xl">

        <a href="{{ route('admin.penyewaan.index') }}"
           class="mb-6 inline-block text-sm font-bold text-cyan-300 hover:text-pink-300">
            ← Kembali ke Daftar Sewa
        </a>

        <h1 class="mb-8 text-3xl font-black">
            Detail <span class="text-pink-400">Penyewaan</span>
        </h1>

        @if(session('success'))
            <div class="mb-6 rounded-xl border border-green-400/30 bg-green-400/10 px-4 py-3 text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @php
            $stepMap = [
                'menunggu_pembayaran' => 1,
                'menunggu_konfirmasi' => 2,
                'disetujui' => 3,
                'sedang_disewa' => 4,
                'selesai' => 5,
            ];

            $currentStep = $stepMap[$penyewaan->status_penyewaan] ?? 0;
        @endphp

        <div class="grid gap-6 lg:grid-cols-[1fr_360px]">
            <div class="space-y-6">

                <div class="rounded-3xl border border-cyan-400/20 bg-slate-900 p-6">
                    <h2 class="mb-5 text-xl font-black text-cyan-300">Data Penyewaan</h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between border-b border-slate-700 pb-3">
                            <span class="text-slate-400">Kode</span>
                            <span class="font-bold">{{ $penyewaan->kode_penyewaan }}</span>
                        </div>

                        <div class="flex justify-between border-b border-slate-700 pb-3">
                            <span class="text-slate-400">Nama</span>
                            <span class="font-bold">{{ $penyewaan->nama }}</span>
                        </div>

                        <div class="flex justify-between border-b border-slate-700 pb-3">
                            <span class="text-slate-400">No WhatsApp</span>
                            <span class="font-bold">{{ $penyewaan->no_wa }}</span>
                        </div>

                        <div class="border-b border-slate-700 pb-3">
                            <span class="text-slate-400">Alamat</span>
                            <p class="mt-1 font-bold">{{ $penyewaan->alamat }}</p>
                        </div>

                        <div class="flex justify-between border-b border-slate-700 pb-3">
                            <span class="text-slate-400">Tanggal Ambil</span>
                            <span class="font-bold">{{ \Carbon\Carbon::parse($penyewaan->tanggal_ambil)->format('d M Y') }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-slate-400">Tanggal Kembali</span>
                            <span class="font-bold">{{ \Carbon\Carbon::parse($penyewaan->tanggal_kembali)->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-cyan-400/20 bg-slate-900 p-6">
                    <h2 class="mb-5 text-xl font-black text-cyan-300">Kostum Disewa</h2>

                    <div class="space-y-4">
                        @foreach($penyewaan->items as $item)
                            <div class="flex items-center gap-4 rounded-2xl bg-slate-950 p-4">
                                @if($item->foto)
                                    <img src="{{ asset('image/' . $item->foto) }}"
                                         class="h-20 w-20 rounded-xl object-cover">
                                @else
                                    <div class="flex h-20 w-20 items-center justify-center rounded-xl bg-slate-800 text-xs text-slate-400">
                                        No Image
                                    </div>
                                @endif

                                <div class="flex-1">
                                    <p class="font-black">{{ $item->nama_kostum }}</p>
                                    <p class="mt-1 text-sm text-slate-400">{{ $item->durasi }} Hari</p>
                                </div>

                                <p class="font-black text-pink-300">
                                    Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-3xl border border-pink-400/20 bg-slate-900 p-6">
                    <h2 class="mb-5 text-xl font-black text-pink-300">Bukti Pembayaran</h2>

                    @if($penyewaan->bukti_transfer)
                        <a href="{{ asset('storage/' . $penyewaan->bukti_transfer) }}" target="_blank">
                            <img src="{{ asset('storage/' . $penyewaan->bukti_transfer) }}"
                                 class="max-h-[420px] w-full rounded-2xl object-contain bg-slate-950">
                        </a>
                    @else
                        <div class="rounded-2xl border border-yellow-400/20 bg-yellow-400/10 p-5 text-yellow-200">
                            Bukti pembayaran belum diupload.
                        </div>
                    @endif
                </div>

                <div class="rounded-3xl border border-cyan-400/20 bg-slate-900 p-6">

                    <h2 class="mb-5 text-xl font-black text-white">Riwayat Status</h2>

                    <div class="space-y-5">
                        <div class="relative border-l border-cyan-400/30 pl-5">
                            <span class="absolute -left-[5px] top-1 h-2.5 w-2.5 rounded-full bg-cyan-300"></span>
                            <p class="text-xs text-slate-400">
                                {{ $penyewaan->created_at->format('d M Y, H:i') }}
                            </p>
                            <p class="mt-1 font-bold text-white">
                                Pesanan dibuat oleh {{ $penyewaan->nama }}
                            </p>
                            <p class="mt-1 text-sm text-slate-400">
                                Status awal: menunggu pembayaran.
                            </p>
                        </div>

                        <div class="relative border-l {{ $currentStep >= 2 ? 'border-cyan-400/30' : 'border-slate-600' }} pl-5">
                            <span class="absolute -left-[5px] top-1 h-2.5 w-2.5 rounded-full {{ $currentStep >= 2 ? 'bg-cyan-300' : 'bg-slate-500' }}"></span>

                            <p class="text-xs {{ $currentStep >= 2 ? 'text-slate-400' : 'text-slate-500' }}">
                                {{ $currentStep >= 2 ? $penyewaan->updated_at->format('d M Y, H:i') : 'Menunggu...' }}
                            </p>

                            <p class="mt-1 font-bold {{ $currentStep >= 2 ? 'text-white' : 'text-slate-400' }}">
                                Menunggu verifikasi pembayaran oleh admin.
                            </p>

                            <p class="mt-1 text-sm {{ $currentStep >= 2 ? 'text-slate-400' : 'text-slate-500' }}">
                                Pembayaran dikonfirmasi
                            </p>
                        </div>

                        <div class="relative border-l {{ $currentStep >= 3 ? 'border-cyan-400/30' : 'border-slate-600' }} pl-5">
                            <span class="absolute -left-[5px] top-1 h-2.5 w-2.5 rounded-full {{ $currentStep >= 3 ? 'bg-cyan-300' : 'bg-slate-500' }}"></span>

                            <p class="text-xs {{ $currentStep >= 3 ? 'text-slate-400' : 'text-slate-500' }}">
                                {{ $currentStep >= 3 ? $penyewaan->updated_at->format('d M Y, H:i') : 'Menunggu...' }}
                            </p>

                            <p class="mt-1 font-bold {{ $currentStep >= 3 ? 'text-white' : 'text-slate-400' }}">
                                Verifikasi Admin
                            </p>

                            <p class="mt-1 text-sm {{ $currentStep >= 3 ? 'text-slate-400' : 'text-slate-500' }}">
                                Penyewaan telah disetujui.
                            </p>
                        </div>

                        <div class="relative border-l {{ $currentStep >= 4 ? 'border-cyan-400/30' : 'border-slate-600' }} pl-5">
                            <span class="absolute -left-[5px] top-1 h-2.5 w-2.5 rounded-full {{ $currentStep >= 4 ? 'bg-cyan-300' : 'bg-slate-500' }}"></span>

                            <p class="text-xs {{ $currentStep >= 4 ? 'text-slate-400' : 'text-slate-500' }}">
                                {{ $currentStep >= 4 ? $penyewaan->updated_at->format('d M Y, H:i') : 'Menunggu...' }}
                            </p>

                            <p class="mt-1 font-bold {{ $currentStep >= 4 ? 'text-white' : 'text-slate-400' }}">
                                Sedang Disewa
                            </p>

                            <p class="mt-1 text-sm {{ $currentStep >= 4 ? 'text-slate-400' : 'text-slate-500' }}">
                                Kostum sedang digunakan pelanggan.
                            </p>
                        </div>

                        <div class="relative border-l {{ $currentStep >= 5 ? 'border-cyan-400/30' : 'border-slate-600' }} pl-5">
                            <span class="absolute -left-[5px] top-1 h-2.5 w-2.5 rounded-full {{ $currentStep >= 5 ? 'bg-cyan-300' : 'bg-slate-500' }}"></span>

                            <p class="text-xs {{ $currentStep >= 5 ? 'text-slate-400' : 'text-slate-500' }}">
                                {{ $currentStep >= 5 ? $penyewaan->updated_at->format('d M Y, H:i') : 'Menunggu...' }}
                            </p>

                            <p class="mt-1 font-bold {{ $currentStep >= 5 ? 'text-white' : 'text-slate-400' }}">
                                Penyewaan Selesai
                            </p>

                            <p class="mt-1 text-sm {{ $currentStep >= 5 ? 'text-slate-400' : 'text-slate-500' }}">
                                Kostum sudah dikembalikan.
                            </p>
                        </div>

                        @if($penyewaan->status_penyewaan === 'dibatalkan')
                            <div class="relative border-l border-red-400/40 pl-5">
                                <span class="absolute -left-[5px] top-1 h-2.5 w-2.5 rounded-full bg-red-400"></span>
                                <p class="text-xs text-slate-400">
                                    {{ $penyewaan->updated_at->format('d M Y, H:i') }}
                                </p>
                                <p class="mt-1 font-bold text-red-300">
                                    Penyewaan Dibatalkan
                                </p>
                                <p class="mt-1 text-sm text-slate-400">
                                    Pesanan ini telah dibatalkan.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-3xl border border-cyan-400/20 bg-slate-900 p-6">
                    <h2 class="mb-5 text-xl font-black">Ringkasan</h2>

                    <div class="space-y-3 border-b border-slate-700 pb-5 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-400">Subtotal</span>
                            <span>Rp{{ number_format($penyewaan->subtotal, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between text-cyan-300">
                            <span>Diskon {{ $penyewaan->voucher_code }}</span>
                            <span>- Rp{{ number_format($penyewaan->discount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-5 flex justify-between text-2xl font-black">
                        <span>Total</span>
                        <span class="text-pink-300">
                            Rp{{ number_format($penyewaan->total, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="mt-5 space-y-3 text-sm">
                        <p>
                            Pembayaran:
                            <span class="font-bold text-yellow-300">
                                {{ str_replace('_', ' ', $penyewaan->status_pembayaran) }}
                            </span>
                        </p>

                        <p>
                            Penyewaan:
                            <span class="font-bold text-cyan-300">
                                {{ str_replace('_', ' ', $penyewaan->status_penyewaan) }}
                            </span>
                        </p>
                    </div>
                </div>

                @if($penyewaan->status_pembayaran === 'menunggu_verifikasi')
    <div class="rounded-3xl border border-cyan-400/20 bg-slate-900 p-6">

        <h2 class="mb-5 text-lg font-black text-white">
            Konfirmasi Pembayaran
        </h2>

        <form action="{{ route('admin.penyewaan.verifikasi', $penyewaan->id) }}"
              method="POST">
            @csrf

            <button type="submit"
                    class="w-full rounded-xl bg-green-400 px-4 py-4 font-black text-slate-950 transition hover:bg-green-300">
                ✓ Verifikasi Pembayaran
            </button>
        </form>

        <div class="my-5 flex items-center gap-3">
            <div class="h-px flex-1 bg-slate-700"></div>
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">
                atau
            </span>
            <div class="h-px flex-1 bg-slate-700"></div>
        </div>

        <form action="{{ route('admin.penyewaan.tolak', $penyewaan->id) }}"
              method="POST"
              class="space-y-4">
            @csrf

            <div>
                <label class="mb-2 block text-sm font-bold text-slate-300">
                    Alasan Penolakan
                </label>

                <textarea
                    name="catatan_admin"
                    rows="4"
                    required
                    placeholder="Contoh: Bukti transfer buram, nominal transfer tidak sesuai, atau rekening tujuan salah."
                    class="w-full resize-none rounded-xl border border-red-400/20 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-500 focus:border-red-400 focus:outline-none"
                ></textarea>
            </div>

            <button type="submit"
                    class="w-full rounded-xl bg-red-500 px-4 py-4 font-black text-white transition hover:bg-red-400">
                ✕ Tolak Pembayaran
            </button>
        </form>

    </div>
@endif

                <form action="{{ route('admin.penyewaan.status', $penyewaan->id) }}"
                      method="POST"
                      class="rounded-3xl border border-cyan-400/20 bg-slate-900 p-6">
                    @csrf

                    <label class="mb-2 block text-sm font-bold text-slate-300">
                        Ubah Status Penyewaan
                    </label>

                    <select name="status_penyewaan"
                            class="w-full rounded-xl border border-cyan-400/20 bg-slate-950 px-4 py-3 text-white outline-none">
                        <option value="menunggu_pembayaran" {{ $penyewaan->status_penyewaan === 'menunggu_pembayaran' ? 'selected' : '' }}>
                            Menunggu Pembayaran
                        </option>
                        <option value="menunggu_konfirmasi" {{ $penyewaan->status_penyewaan === 'menunggu_konfirmasi' ? 'selected' : '' }}>
                            Menunggu Konfirmasi
                        </option>
                        <option value="disetujui" {{ $penyewaan->status_penyewaan === 'disetujui' ? 'selected' : '' }}>
                            Disetujui
                        </option>
                        <option value="sedang_disewa" {{ $penyewaan->status_penyewaan === 'sedang_disewa' ? 'selected' : '' }}>
                            Sedang Disewa
                        </option>
                        <option value="selesai" {{ $penyewaan->status_penyewaan === 'selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>
                        <option value="dibatalkan" {{ $penyewaan->status_penyewaan === 'dibatalkan' ? 'selected' : '' }}>
                            Dibatalkan
                        </option>
                    </select>

                    <button type="submit"
                            class="mt-4 w-full rounded-xl bg-gradient-to-r from-cyan-400 to-pink-400 px-6 py-3 font-black text-slate-950">
                        Simpan Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
