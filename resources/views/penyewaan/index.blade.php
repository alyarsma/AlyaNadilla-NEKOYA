@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-950 px-4 pt-24 pb-16 text-white">
    <div class="mx-auto max-w-6xl">

        <h1 class="mb-8 text-3xl font-black text-cyan-300">
            Riwayat Penyewaan
        </h1>

        @php
            $adminWa = '6288234183154';
            $mapsUrl = 'https://maps.app.goo.gl/7w7TUxSavDxPeZNC9';
            $alamatAmbil = 'Kampus Tegalboto, Jl. Kalimantan No.37, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121';
        @endphp

        @forelse($penyewaans as $penyewaan)
            @php
                $stepMap = [
                    'menunggu_pembayaran' => 1,
                    'menunggu_konfirmasi' => 2,
                    'disetujui' => 3,
                    'sedang_disewa' => 4,
                    'selesai' => 5,
                ];

                $currentStep = $stepMap[$penyewaan->status_penyewaan] ?? 0;
                $waText = urlencode('Halo admin Nekoya, saya ingin menanyakan penyewaan dengan kode ' . $penyewaan->kode_penyewaan);
            @endphp

            <details class="group mb-6 rounded-3xl border border-cyan-400/20 bg-slate-900 p-6 shadow-2xl">
                <summary class="cursor-pointer list-none">
                    <div class="mb-4 flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-black text-white">
                                {{ $penyewaan->kode_penyewaan }}
                            </h2>
                            <p class="mt-1 text-sm text-slate-400">
                                {{ $penyewaan->tanggal_ambil }} sampai {{ $penyewaan->tanggal_kembali }}
                            </p>
                            <p class="mt-2 text-xs font-bold text-cyan-300">
                                Klik untuk lihat detail
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <span class="rounded-full bg-cyan-400/10 px-3 py-1 text-xs font-bold text-cyan-300">
                                Pembayaran: {{ str_replace('_', ' ', $penyewaan->status_pembayaran) }}
                            </span>

                            <span class="rounded-full bg-pink-400/10 px-3 py-1 text-xs font-bold text-pink-300">
                                Penyewaan: {{ str_replace('_', ' ', $penyewaan->status_penyewaan) }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-2 border-t border-slate-700 pt-4">
                        @foreach($penyewaan->items as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-300">{{ $item->nama_kostum }}</span>
                                <span class="font-bold">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-5 flex justify-between border-t border-slate-700 pt-4 text-xl font-black">
                        <span>Total</span>
                        <span class="text-cyan-300">
                            Rp{{ number_format($penyewaan->total, 0, ',', '.') }}
                        </span>
                    </div>
                </summary>

                <div class="mt-6 grid gap-6 lg:grid-cols-[1fr_320px]">
                    <div class="rounded-2xl border border-cyan-400/20 bg-slate-950 p-5">
                        <h3 class="mb-5 text-lg font-black text-white">
                            Status Pesanan
                        </h3>

                        <div class="space-y-5">
                            <div class="relative border-l border-cyan-400/40 pl-5">
                                <span class="absolute -left-[9px] top-0 flex h-4 w-4 items-center justify-center rounded-full bg-cyan-400 text-[10px] font-black text-slate-950">✓</span>
                                <p class="font-bold text-white">Penyewaan Diajukan</p>
                                <p class="text-xs text-slate-400">{{ $penyewaan->created_at->format('d M, H:i') }}</p>
                            </div>

                            <div class="relative border-l {{ $currentStep >= 2 ? 'border-cyan-400/40' : 'border-slate-700' }} pl-5">
                                <span class="absolute -left-[9px] top-0 flex h-4 w-4 items-center justify-center rounded-full {{ $currentStep >= 2 ? 'bg-cyan-400 text-slate-950' : 'bg-slate-700 text-slate-400' }} text-[10px] font-black">✓</span>
                                <p class="font-bold {{ $currentStep >= 2 ? 'text-white' : 'text-slate-500' }}">Menunggu Konfirmasi</p>
                                <p class="text-xs {{ $currentStep >= 2 ? 'text-slate-400' : 'text-slate-600' }}">
                                    Bukti pembayaran menunggu verifikasi admin.
                                </p>
                            </div>

                            <div class="relative border-l {{ $currentStep >= 3 ? 'border-cyan-400/40' : 'border-slate-700' }} pl-5">
                                <span class="absolute -left-[9px] top-0 flex h-4 w-4 items-center justify-center rounded-full {{ $currentStep >= 3 ? 'bg-cyan-400 text-slate-950' : 'bg-slate-700 text-slate-400' }} text-[10px] font-black">✓</span>
                                <p class="font-bold {{ $currentStep >= 3 ? 'text-white' : 'text-slate-500' }}">Disetujui</p>
                                <p class="text-xs {{ $currentStep >= 3 ? 'text-slate-400' : 'text-slate-600' }}">
                                    Pembayaran sudah diverifikasi admin.
                                </p>
                            </div>

                            <div class="relative border-l {{ $currentStep >= 4 ? 'border-cyan-400/40' : 'border-slate-700' }} pl-5">
                                <span class="absolute -left-[9px] top-0 flex h-4 w-4 items-center justify-center rounded-full {{ $currentStep >= 4 ? 'bg-cyan-400 text-slate-950' : 'bg-slate-700 text-slate-400' }} text-[10px] font-black">✓</span>
                                <p class="font-bold {{ $currentStep >= 4 ? 'text-white' : 'text-slate-500' }}">Sedang Disewa</p>
                                <p class="text-xs {{ $currentStep >= 4 ? 'text-slate-400' : 'text-slate-600' }}">
                                    Kostum sedang digunakan.
                                </p>
                            </div>

                            <div class="relative border-l {{ $currentStep >= 5 ? 'border-cyan-400/40' : 'border-slate-700' }} pl-5">
                                <span class="absolute -left-[9px] top-0 flex h-4 w-4 items-center justify-center rounded-full {{ $currentStep >= 5 ? 'bg-cyan-400 text-slate-950' : 'bg-slate-700 text-slate-400' }} text-[10px] font-black">✓</span>
                                <p class="font-bold {{ $currentStep >= 5 ? 'text-white' : 'text-slate-500' }}">Selesai</p>
                                <p class="text-xs {{ $currentStep >= 5 ? 'text-slate-400' : 'text-slate-600' }}">
                                    Kostum sudah dikembalikan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @if($penyewaan->status_penyewaan === 'disetujui')
                            <div class="rounded-2xl border border-green-400/20 bg-green-400/10 p-5">
                                <h3 class="font-black text-green-300">
                                    Penyewaan Disetujui
                                </h3>
                                <p class="mt-2 text-sm text-slate-300">
                                    Kamu sudah boleh mengambil kostum di lokasi:
                                </p>
                                <p class="mt-2 font-bold text-white">
                                    {{ $alamatAmbil }}
                                </p>

                                <a href="{{ $mapsUrl }}" target="_blank"
                                   class="mt-4 block rounded-xl bg-cyan-400 px-4 py-3 text-center font-black text-slate-950">
                                    Buka Google Maps
                                </a>
                            </div>
                        @endif

                        @if($penyewaan->status_pembayaran === 'ditolak')
                            <div class="rounded-2xl border border-red-400/20 bg-red-400/10 p-5">
                                <h3 class="font-black text-red-300">
                                    Pembayaran Ditolak
                                </h3>
                                <p class="mt-2 text-sm text-slate-300">
                                    {{ $penyewaan->catatan_admin ?? 'Silakan hubungi admin untuk informasi lebih lanjut.' }}
                                </p>
                            </div>
                        @endif

                        <a href="https://wa.me/{{ $adminWa }}?text={{ $waText }}" target="_blank"
                           class="flex items-center justify-center gap-2 rounded-2xl bg-green-500 px-5 py-4 font-black text-white hover:bg-green-400">
                            WhatsApp Admin
                        </a>

                        @if($penyewaan->status_pembayaran === 'pending')
                            <a href="{{ route('payment.show', $penyewaan->id) }}"
                               class="w-full rounded-lg bg-blue-600 py-3 font-semibold text-white transition hover:bg-blue-700">
                                Lanjutkan Pembayaran
                            </a>
                        @endif
                    </div>
                </div>
            </details>
        @empty
            <div class="rounded-3xl border border-cyan-400/20 bg-slate-900 p-10 text-center text-slate-400">
                Belum ada riwayat penyewaan.
            </div>
        @endforelse
    </div>
</section>
@endsection
