@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-900 px-4 pt-28 pb-16 text-white">
    <div class="mx-auto max-w-7xl">

        <div class="mb-8">
            <h1 class="text-4xl font-extrabold md:text-5xl">
                Pengelolaan <span class="text-pink-400">Kostum</span>
            </h1>
            <p class="mt-3 text-gray-300">
                Ringkasan data katalog kostum Nekoya Cosplay Rental.
            </p>
        </div>

        <div class="mb-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-cyan-500/30 bg-slate-800 p-6">
                <p class="text-sm font-bold uppercase tracking-[2px] text-gray-400">Total Kostum</p>
                <h2 class="mt-3 text-3xl font-extrabold text-cyan-400">
                    {{ count($kostum) }}
                </h2>
            </div>

            <div class="rounded-2xl border border-cyan-500/30 bg-slate-800 p-6">
                <p class="text-sm font-bold uppercase tracking-[2px] text-gray-400">Kategori</p>
                <h2 class="mt-3 text-3xl font-extrabold text-pink-400">
                    4
                </h2>
            </div>

            <div class="rounded-2xl border border-cyan-500/30 bg-slate-800 p-6">
                <p class="text-sm font-bold uppercase tracking-[2px] text-gray-400">Harga Terendah</p>
                <h2 class="mt-3 text-2xl font-extrabold text-cyan-400">
                    Rp{{ number_format(min(array_column($kostum, 'harga')), 0, ',', '.') }}
                </h2>
            </div>

            <div class="rounded-2xl border border-cyan-500/30 bg-slate-800 p-6">
                <p class="text-sm font-bold uppercase tracking-[2px] text-gray-400">Harga Tertinggi</p>
                <h2 class="mt-3 text-2xl font-extrabold text-pink-400">
                    Rp{{ number_format(max(array_column($kostum, 'harga')), 0, ',', '.') }}
                </h2>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-cyan-500/30 bg-slate-800">
            <div class="border-b border-cyan-500/30 px-6 py-5">
                <h2 class="text-xl font-extrabold text-cyan-300">
                    Daftar Kostum
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-900 text-sm uppercase tracking-[2px] text-cyan-300">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Nama Kostum</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Harga Sewa / Hari</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-cyan-500/20">
                        @foreach ($kostum as $index => $item)
                            <tr class="hover:bg-white/5">
                                <td class="px-6 py-4 font-bold">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-6 py-4 font-bold text-white">
                                    {{ $item['nama_kostum'] }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-pink-400 px-3 py-1 text-xs font-bold text-white">
                                        {{ $item['kategori'] ?? 'Anime' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 font-bold text-cyan-400">
                                    Rp{{ number_format($item['harga'], 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-cyan-500 px-3 py-1 text-xs font-bold text-white">
                                        Tampil
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
@endsection
