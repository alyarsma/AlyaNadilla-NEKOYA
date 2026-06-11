@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-50 px-6 pt-24 pb-16 text-slate-900 dark:bg-slate-950 dark:text-white">
    <div class="mx-auto max-w-7xl">

        <a href="{{ route('katalog') }}"
           class="mb-6 inline-block text-sm font-bold text-cyan-300 hover:text-pink-300">
            ← Kembali ke Katalog
        </a>

        <h1 class="mb-8 text-4xl font-black">
            Keranjang <span class="text-pink-400">Sewa</span>
        </h1>

        @if(session('success'))
            <div class="mb-5 rounded-xl border border-green-400/30 bg-green-400/10 px-4 py-3 text-sm font-bold text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-5 rounded-xl border border-red-400/30 bg-red-400/10 px-4 py-3 text-sm font-bold text-red-300">
                {{ session('error') }}
            </div>
        @endif

        @if(empty($cart))
            <div class="rounded-3xl border border-cyan-500/20 bg-slate-900 p-10 text-center text-slate-400">
                Keranjang kamu masih kosong.
            </div>
        @else

            {{-- FORM CHECKOUT DIPISAH --}}
            <form id="checkout-form" action="{{ route('checkout.prepare') }}" method="POST">
                @csrf
            </form>

            <div class="grid gap-8 lg:grid-cols-[1fr_360px]">

                {{-- LIST CART --}}
                <div class="rounded-3xl border border-cyan-500/20 bg-slate-900 p-6">
                    <div class="mb-5 grid grid-cols-[40px_1fr_120px_150px_60px] gap-4 border-b border-slate-700 pb-4 text-xs font-black uppercase tracking-[2px] text-cyan-300">
                        <div></div>
                        <div>Produk</div>
                        <div>Durasi</div>
                        <div>Total</div>
                        <div>Aksi</div>
                    </div>

                    <div class="space-y-5">
                        @foreach($cart as $id => $item)
                            <div class="grid grid-cols-[40px_1fr_120px_150px_60px] items-center gap-4 rounded-2xl bg-slate-800/70 p-4">

                                <input
                                    type="checkbox"
                                    name="selected_items[]"
                                    value="{{ $id }}"
                                    checked
                                    form="checkout-form"
                                    class="h-5 w-5 accent-pink-500"
                                >

                                <div class="flex items-center gap-4">
                                    @if(!empty($item['foto']))
                                        <img
                                            src="{{ asset('image/' . $item['foto']) }}"
                                            alt="{{ $item['nama_kostum'] }}"
                                            class="h-24 w-24 rounded-2xl object-cover"
                                        >
                                    @else
                                        <div class="flex h-24 w-24 items-center justify-center rounded-2xl bg-slate-700 text-xs text-slate-400">
                                            Tidak ada gambar
                                        </div>
                                    @endif

                                    <div>
                                        <h2 class="text-lg font-black">
                                            {{ $item['nama_kostum'] }}
                                        </h2>

                                        <p class="mt-1 text-sm text-slate-400">
                                            Mulai: {{ $item['tanggal_mulai'] }}
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-cyan-300">
                                            Rp{{ number_format($item['harga_sewa'], 0, ',', '.') }} / hari
                                        </p>
                                    </div>
                                </div>

                                <div class="flex w-fit items-center rounded-full border border-cyan-500/30 bg-slate-950 px-4 py-2 font-bold">
                                    {{ $item['durasi'] }} hari
                                </div>

                                <p class="font-black text-pink-300">
                                    Rp{{ number_format($item['subtotal'], 0, ',', '.') }}
                                </p>

                                <button
                                    type="button"
                                    class="rounded-xl bg-red-500/20 px-3 py-2 font-bold text-red-300 hover:bg-red-500 hover:text-white"
                                >
                                    🗑
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- SUMMARY --}}
                <div class="h-fit rounded-3xl border border-pink-500/20 bg-slate-900 p-6">
                    <h2 class="mb-5 text-xl font-black">
                        Order <span class="text-pink-400">Summary</span>
                    </h2>

                    {{-- FORM VOUCHER DIPISAH --}}
                    @if(session('voucher'))
                        <div class="mb-5 rounded-xl border border-cyan-400/30 bg-cyan-400/10 p-4">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-sm font-bold text-cyan-300">
                                        Voucher aktif: {{ session('voucher.code') }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ session('voucher.label') }}
                                    </p>
                                </div>

                                <form action="{{ route('cart.removeVoucher') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="rounded-lg border border-red-400 px-3 py-2 text-xs font-bold text-red-300 hover:bg-red-500 hover:text-white">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('cart.applyVoucher') }}" method="POST" class="mb-5 flex gap-2">
                            @csrf

                            <input
                                type="text"
                                name="voucher_code"
                                placeholder="Kode voucher"
                                class="w-full rounded-xl border border-cyan-500/20 bg-slate-950 px-4 py-3 text-sm text-white outline-none placeholder:text-slate-500 focus:border-pink-400"
                            >

                            <button
                                type="submit"
                                class="rounded-xl border border-cyan-400 px-4 font-bold text-cyan-300 hover:bg-cyan-400 hover:text-slate-950"
                            >
                                Apply
                            </button>
                        </form>
                    @endif

                    @php
                        $subtotal = collect($cart)->sum('subtotal');
                        $discount = session('voucher.discount', 0);
                        $delivery = 0;
                        $total = max($subtotal - $discount + $delivery, 0);
                    @endphp

                    <div class="space-y-3 border-b border-slate-700 pb-5 text-sm">
                        <div class="flex justify-between text-slate-300">
                            <span>Sub Total</span>
                            <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between text-slate-300">
                            <span>Discount</span>
                            <span>- Rp{{ number_format($discount, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between text-slate-300">
                            <span>Delivery Fee</span>
                            <span>Rp{{ number_format($delivery, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-5 flex justify-between text-xl font-black">
                        <span>Total</span>
                        <span class="text-pink-300">
                            Rp{{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <button
                        type="submit"
                        form="checkout-form"
                        class="mt-6 w-full rounded-xl bg-gradient-to-r from-cyan-400 to-pink-400 px-6 py-4 font-black text-slate-950 transition hover:scale-[1.02]"
                    >
                        Checkout Sekarang
                    </button>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
