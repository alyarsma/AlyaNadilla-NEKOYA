@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-50 px-6 pt-24 pb-16 text-slate-900 dark:bg-slate-950 dark:text-white">
    <div class="mx-auto max-w-7xl">

        <div class="mb-8">
            <p class="text-sm font-bold uppercase tracking-[3px] text-blue-600 dark:text-cyan-300">
                Dashboard Pelanggan
            </p>
            <h1 class="mt-2 text-4xl font-black">
                Halo, {{ auth()->user()->name }}
            </h1>
            <p class="mt-2 text-slate-600 dark:text-slate-400">
                Kelola aktivitas penyewaan kostum kamu di Nekoya.
            </p>
        </div>

        <div class="grid gap-5 md:grid-cols-4">
            <div class="rounded-3xl border border-blue-200 bg-white p-6 shadow dark:border-cyan-400/20 dark:bg-slate-900">
                <p class="text-sm text-slate-600 dark:text-slate-400">Total Penyewaan</p>
                <h2 class="mt-3 text-4xl font-black text-blue-600 dark:text-cyan-300">0</h2>
            </div>

            <div class="rounded-3xl border border-blue-200 bg-white p-6 shadow dark:border-pink-400/20 dark:bg-slate-900">
                <p class="text-sm text-slate-600 dark:text-slate-400">Pesanan Aktif</p>
                <h2 class="mt-3 text-4xl font-black text-blue-600 dark:text-pink-400">0</h2>
            </div>

            <div class="rounded-3xl border border-blue-200 bg-white p-6 shadow dark:border-green-400/20 dark:bg-slate-900">
                <p class="text-sm text-slate-600 dark:text-slate-400">Pesanan Selesai</p>
                <h2 class="mt-3 text-4xl font-black text-blue-600 dark:text-green-300">0</h2>
            </div>

            <div class="rounded-3xl border border-blue-200 bg-white p-6 shadow dark:border-yellow-400/20 dark:bg-slate-900">
                <p class="text-sm text-slate-600 dark:text-slate-400">Keranjang</p>
                <h2 class="mt-3 text-4xl font-black text-blue-600 dark:text-yellow-300">0</h2>
            </div>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-3">
            <div class="rounded-3xl border border-blue-200 bg-white p-6 shadow dark:border-cyan-400/20 dark:bg-slate-900 lg:col-span-2">
                <h2 class="mb-5 text-2xl font-black">Menu Pelanggan</h2>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <a href="{{ url('/katalog') }}" class="rounded-2xl bg-slate-100 p-5 hover:bg-slate-200 dark:bg-slate-950 dark:hover:bg-slate-800">
                        <div class="mb-3 text-3xl">🎭</div>
                        <h3 class="font-black text-blue-600 dark:text-cyan-300">Katalog</h3>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Cari kostum.</p>
                    </a>

                    <a href="{{ route('cart.index') }}" class="rounded-2xl bg-slate-100 p-5 hover:bg-slate-200 dark:bg-slate-950 dark:hover:bg-slate-800">
                        <div class="mb-3 text-3xl">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.7"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="h-9 w-9 text-slate-800 dark:text-white">
                                <circle cx="9" cy="21" r="1.5"></circle>
                                <circle cx="19" cy="21" r="1.5"></circle>
                                <path d="M2 3h3l2.5 13h11.5l2-9H7"></path>
                                <path d="M9 9h11"></path>
                                <path d="M10 12h9"></path>
                            </svg>
                        </div>
                        <h3 class="font-black text-blue-600 dark:text-pink-400">Cart</h3>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Lihat keranjang.</p>
                    </a>

                    <a href="{{ route('pelanggan.profile') }}" class="rounded-2xl bg-slate-100 p-5 hover:bg-slate-200 dark:bg-slate-950 dark:hover:bg-slate-800">
                        <div class="mb-3 text-3xl">👤</div>
                        <h3 class="font-black text-blue-600 dark:text-cyan-300">Profil</h3>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Ubah data diri.</p>
                    </a>

                    <a href="{{ route('preferensi') }}" class="rounded-2xl bg-slate-100 p-5 hover:bg-slate-200 dark:bg-slate-950 dark:hover:bg-slate-800">
                        <div class="mb-3 text-3xl">⚙️</div>
                        <h3 class="font-black text-blue-600 dark:text-purple-300">Preferensi</h3>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Atur minat kostum.</p>
                    </a>

                    <a href="{{ url('/tentang') }}" class="rounded-2xl bg-slate-100 p-5 hover:bg-slate-200 dark:bg-slate-950 dark:hover:bg-slate-800">
                        <div class="mb-3 text-3xl">🏠</div>
                        <h3 class="font-black text-blue-600 dark:text-green-300">Tentang</h3>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Tentang Nekoya.</p>
                    </a>

                    <a href="{{ url('/kontak') }}" class="rounded-2xl bg-slate-100 p-5 hover:bg-slate-200 dark:bg-slate-950 dark:hover:bg-slate-800">
                        <div class="mb-3 text-3xl">☎️</div>
                        <h3 class="font-black text-blue-600 dark:text-yellow-300">Kontak</h3>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Hubungi admin.</p>
                    </a>
                </div>
            </div>

            <div class="rounded-3xl border border-blue-200 bg-white p-6 shadow dark:border-pink-400/20 dark:bg-slate-900">
                <h2 class="mb-5 text-2xl font-black">Profil Saya</h2>

                <div class="flex items-center gap-4">
                    @if(auth()->user()->foto_profil)
                        <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}"
                             class="h-20 w-20 rounded-full border-2 border-blue-500 object-cover dark:border-cyan-400">
                    @else
                        <div class="flex h-20 w-20 items-center justify-center rounded-full border-2 border-blue-500 bg-slate-200 text-slate-500 dark:border-cyan-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4Zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4Z"/>
                            </svg>
                        </div>
                    @endif

                    <div>
                        <h3 class="text-xl font-black">
                            {{ auth()->user()->nama_lengkap ?? auth()->user()->name }}
                        </h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <a href="{{ route('pelanggan.profile') }}"
                   class="mt-6 block rounded-2xl bg-blue-600 px-5 py-3 text-center font-black text-white hover:bg-blue-700">
                    Edit Profil
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
