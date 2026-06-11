@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-950 px-4 pt-28 pb-16 text-white">
    <div class="mx-auto max-w-7xl">

        @if(session('success'))
    <div
        id="successPopup"
        class="fixed right-6 top-24 z-50 rounded-xl bg-green-500 px-6 py-4 font-bold text-white shadow-xl transition-opacity duration-500"
    >
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const popup = document.getElementById('successPopup');

            if (popup) {
                popup.classList.add('opacity-0');

                setTimeout(() => {
                    popup.remove();
                }, 500);
            }
        }, 3000);
    </script>
@endif

        <a href="{{ route('katalog') }}"
           class="mb-8 inline-block text-sm font-bold text-cyan-300 hover:text-pink-300">
            ← Kembali ke Katalog
        </a>

        <div class="grid gap-8 lg:grid-cols-[1.3fr_1fr]">

            <div class="overflow-hidden rounded-3xl border border-cyan-500/30 bg-slate-900">
                <img
                    src="{{ $costume->foto ? asset('image/' . $costume->foto) : asset('image/default-costume.jpg') }}"
                    alt="{{ $costume->nama_kostum }}"
                    class="h-[620px] w-full object-cover"
                >
            </div>

            <div class="space-y-6">
                <div class="rounded-3xl border border-cyan-500/30 bg-slate-900 p-8">
                    <p class="mb-2 text-sm font-bold uppercase tracking-[2px] text-cyan-300">
                        {{ $costume->kategori }}
                    </p>

                    <h1 class="text-4xl font-black">
                        {{ $costume->nama_kostum }}
                    </h1>

                    <p class="mt-4 leading-relaxed text-slate-300">
                        Kostum premium untuk cosplay, event, photoshoot, atau kebutuhan karakter.
                    </p>

                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="rounded-2xl bg-slate-800 p-5">
                            <p class="text-xs font-bold uppercase tracking-[2px] text-slate-400">Harga</p>
                            <p class="mt-2 text-2xl font-black text-cyan-300">
                                Rp{{ number_format($costume->harga_sewa, 0, ',', '.') }}
                                <span class="text-sm text-slate-300">/hari</span>
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-800 p-5">
                            <p class="text-xs font-bold uppercase tracking-[2px] text-slate-400">Stok</p>
                            <p class="mt-2 text-2xl font-black text-pink-300">
                                {{ $costume->stok }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <p class="mb-3 text-xs font-bold uppercase tracking-[2px] text-slate-300">
                            Ukuran
                        </p>

                        <div class="flex flex-wrap gap-3">
                            @foreach(explode(',', $costume->ukuran) as $ukuran)
                                <span class="rounded-xl border border-cyan-500/30 bg-slate-800 px-5 py-3 font-bold">
                                    {{ trim($ukuran) }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8">
                        @if(auth()->check() && !session('is_admin'))
                            @if($costume->tersedia && $costume->stok > 0)
                                <form action="{{ route('cart.store') }}" method="POST" class="space-y-4">
                                    @csrf

                                    <input type="hidden" name="costume_id" value="{{ $costume->id }}">

                                    <div>
                                        <label class="mb-2 block text-xs font-bold uppercase tracking-[2px] text-slate-300">
                                            Tanggal Mulai Sewa
                                        </label>
                                        <input
                                            type="date"
                                            name="tanggal_mulai"
                                            min="{{ date('Y-m-d') }}"
                                            required
                                            class="w-full rounded-xl border border-cyan-500/30 bg-slate-950 px-4 py-3 text-white outline-none focus:border-pink-400"
                                        >
                                    </div>

                                    <div>
                                        <label class="mb-2 block text-xs font-bold uppercase tracking-[2px] text-slate-300">
                                            Durasi Sewa / Hari
                                        </label>
                                        <input
                                            type="number"
                                            name="durasi"
                                            min="1"
                                            value="1"
                                            required
                                            class="w-full rounded-xl border border-cyan-500/30 bg-slate-950 px-4 py-3 text-white outline-none focus:border-pink-400"
                                        >
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
    <button
        type="submit"
        formaction="{{ route('cart.store') }}"
        class="rounded-xl border border-cyan-400 px-4 py-4 font-black text-cyan-300 transition hover:bg-cyan-400 hover:text-slate-950"
    >
        Masukkan Keranjang
    </button>

    <button
        type="submit"
        formaction="{{ route('checkout.direct') }}"
        class="block w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 rounded-md font-semibold text-white text-center transition">
        Sewa Sekarang
    </button>
</div>
                                </form>
                            @else
                                <button disabled
                                    class="w-full cursor-not-allowed rounded-xl bg-slate-700 px-6 py-4 font-black text-slate-400">
                                    Tidak Tersedia
                                </button>
                            @endif

                        @elseif(session('is_admin'))
                            <button disabled
                                class="w-full cursor-not-allowed rounded-xl bg-slate-700 px-6 py-4 font-black text-slate-400">
                                Admin hanya bisa melihat detail katalog
                            </button>

                        @else
                            <a href="{{ route('login') }}"
                               class="block w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 rounded-md font-semibold text-white text-center transition">
                                Login sebagai Pelanggan untuk Sewa
                            </a>
                        @endif
                    </div>
                </div>

                <div class="rounded-3xl border border-pink-500/20 bg-slate-900 p-7">
                    <h3 class="mb-4 font-black uppercase tracking-[2px] text-pink-300">
                        Rental Terms
                    </h3>

                    <ul class="space-y-3 text-sm text-slate-300">
                        <li>• Pengembalian terlambat dikenakan denda.</li>
                        <li>• Kostum dikembalikan sesuai kondisi awal.</li>
                        <li>• Kerusakan permanen dikenakan biaya tambahan.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-16">
            <h2 class="mb-6 text-3xl font-black">
                Complete the <span class="text-pink-400">Look</span>
            </h2>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @forelse($recommendations as $item)
                    <a href="{{ route('katalog.show', $item->id) }}"
                       class="overflow-hidden rounded-2xl border border-cyan-500/20 bg-slate-900 transition hover:-translate-y-2 hover:border-pink-400">

                        <img
                            src="{{ $item->foto ? asset('image/' . $item->foto) : asset('image/default-costume.jpg') }}"
                            alt="{{ $item->nama_kostum }}"
                            class="h-64 w-full object-cover"
                        >

                        <div class="p-5">
                            <p class="text-xs font-bold uppercase tracking-[2px] text-cyan-300">
                                {{ $item->kategori }}
                            </p>

                            <h3 class="mt-2 font-black">
                                {{ $item->nama_kostum }}
                            </h3>

                            <p class="mt-3 font-black text-pink-300">
                                Rp{{ number_format($item->harga_sewa, 0, ',', '.') }} / hari
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full rounded-2xl border border-cyan-500/20 bg-slate-900 p-8 text-center text-slate-400">
                        Belum ada rekomendasi lain.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</section>
@endsection
