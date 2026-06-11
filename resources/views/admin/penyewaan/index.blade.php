@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-50 px-6 pt-24 pb-16 text-slate-900 dark:bg-slate-950 dark:text-white">
    <div class="mx-auto max-w-7xl">

        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-cyan-300">
                    Admin Panel
                </p>
                <h1 class="mt-2 text-3xl font-black text-white">
                    Manajemen <span class="text-pink-400">Penyewaan</span>
                </h1>
            </div>

            <form method="GET" action="{{ route('admin.penyewaan.index') }}" class="w-full md:w-80">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari penyewaan..."
                       class="w-full rounded-full border border-cyan-400/20 bg-slate-900 px-5 py-3 text-white outline-none placeholder:text-slate-500 focus:border-cyan-300">
            </form>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl border border-green-400/30 bg-green-400/10 px-4 py-3 text-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-8 grid grid-cols-1 gap-5 md:grid-cols-3">
            <a href="{{ route('admin.penyewaan.index') }}"
   class="block rounded-3xl border border-cyan-400/20 bg-slate-900 p-6 shadow-2xl transition hover:border-cyan-400 hover:bg-slate-800">
    <p class="text-sm font-bold text-slate-400">Semua Penyewaan</p>
    <h2 class="mt-3 text-4xl font-black text-cyan-300">{{ $semuaPenyewaan }}</h2>
</a>

            <a href="{{ route('admin.penyewaan.index', ['status' => 'perlu_konfirmasi']) }}"
               class="block rounded-3xl border border-pink-400/20 bg-slate-900 p-6 shadow-2xl transition hover:border-pink-400 hover:bg-slate-800">
                <p class="text-sm font-bold text-slate-400">Perlu Konfirmasi</p>
                <h2 class="mt-3 text-4xl font-black text-pink-400">{{ $perluKonfirmasi }}</h2>

            </a>

            <div class="rounded-3xl border border-yellow-400/20 bg-slate-900 p-6 shadow-2xl">
                <p class="text-sm font-bold text-slate-400">Penyewaan Aktif</p>
                <h2 class="mt-3 text-4xl font-black text-yellow-300">{{ $penyewaanAktif }}</h2>
            </div>
        </div>

        @if(request('status') === 'perlu_konfirmasi')
            <div class="mb-6 flex items-center justify-between rounded-2xl border border-pink-400/20 bg-pink-400/10 px-5 py-4">
                <p class="text-sm font-bold text-pink-300">
                    Menampilkan penyewaan yang perlu konfirmasi pembayaran.
                </p>

                <a href="{{ route('admin.penyewaan.index') }}"
                   class="text-sm font-bold text-cyan-300 hover:text-white">
                    Tampilkan Semua
                </a>
            </div>
        @endif

        <div class="overflow-hidden rounded-3xl border border-cyan-400/20 bg-slate-900 shadow-2xl">
            <div class="flex items-center justify-between border-b border-slate-700 p-6">
                <h2 class="text-xl font-black text-white">
                    Daftar Penyewaan
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-800 text-slate-300">
                        <tr>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4">Kode</th>
                            <th class="px-6 py-4">Kostum</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Pembayaran</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Detail</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($penyewaans as $penyewaan)
                            <tr class="border-b border-slate-800 hover:bg-slate-800/60">
                                <td class="px-6 py-5">
                                    <p class="font-bold text-white">{{ $penyewaan->nama }}</p>
                                    <p class="text-xs text-slate-400">{{ $penyewaan->no_wa }}</p>
                                </td>

                                <td class="px-6 py-5">
                                    <p class="max-w-[180px] break-words font-black text-cyan-300">
                                        {{ $penyewaan->kode_penyewaan }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ \Carbon\Carbon::parse($penyewaan->tanggal_ambil)->format('d M Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($penyewaan->tanggal_kembali)->format('d M Y') }}
                                    </p>
                                </td>

                                <td class="px-6 py-5">
                                    @foreach($penyewaan->items as $item)
                                        <p class="text-slate-200">{{ $item->nama_kostum }}</p>
                                    @endforeach
                                </td>

                                <td class="px-6 py-5 font-black text-white">
                                    Rp{{ number_format($penyewaan->total, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-5">
                                    @if($penyewaan->status_pembayaran === 'dibayar')
                                        <span class="inline-flex whitespace-nowrap rounded-full bg-green-400/10 px-3 py-1 text-xs font-bold text-green-300">
                                            Dibayar
                                        </span>
                                    @elseif($penyewaan->status_pembayaran === 'menunggu_verifikasi')
                                        <span class="inline-flex whitespace-nowrap rounded-full bg-yellow-400/10 px-3 py-1 text-xs font-bold text-yellow-300">
                                            Menunggu Verifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex whitespace-nowrap rounded-full bg-red-400/10 px-3 py-1 text-xs font-bold text-red-300">
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-5">
                                    @php
                                        $statusColor = match($penyewaan->status_penyewaan) {
                                            'disetujui' => 'bg-green-400/10 text-green-300',
                                            'sedang_disewa' => 'bg-cyan-400/10 text-cyan-300',
                                            'selesai' => 'bg-purple-400/10 text-purple-300',
                                            'dibatalkan' => 'bg-red-400/10 text-red-300',
                                            default => 'bg-yellow-400/10 text-yellow-300',
                                        };
                                    @endphp

                                    <span class="inline-flex whitespace-nowrap rounded-full px-3 py-1 text-xs font-bold {{ $statusColor }}">
                                        {{ ucwords(str_replace('_', ' ', $penyewaan->status_penyewaan)) }}
                                    </span>
                                </td>

                                <td class="px-6 py-5">
                                    <a href="{{ route('admin.penyewaan.show', $penyewaan->id) }}"
                                       class="inline-flex whitespace-nowrap rounded-xl border border-cyan-400 px-4 py-2 text-xs font-bold text-cyan-300 transition hover:bg-cyan-400 hover:text-slate-950">
                                        Detail Sewa
                                    </a>
                                </td>

                                <td class="px-6 py-5">
                                    @if($penyewaan->status_pembayaran === 'menunggu_verifikasi')
                                        <form action="{{ route('admin.penyewaan.verifikasi', $penyewaan->id) }}"
                                              method="POST">
                                            @csrf
                                            <button type="submit"
                                                    class="inline-flex whitespace-nowrap rounded-xl bg-green-400 px-4 py-2 text-xs font-bold text-slate-950 transition hover:bg-green-300">
                                                Verifikasi
                                            </button>
                                        </form>
                                    @elseif($penyewaan->status_pembayaran === 'dibayar')
                                        <span class="inline-flex whitespace-nowrap rounded-full bg-green-400/10 px-3 py-1 text-xs font-bold text-green-300">
                                            Terverifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex whitespace-nowrap rounded-full bg-slate-700 px-3 py-1 text-xs font-bold text-slate-300">
                                            Menunggu Upload
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-10 text-center text-slate-400">
                                    Belum ada data penyewaan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6">
                {{ $penyewaans->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
