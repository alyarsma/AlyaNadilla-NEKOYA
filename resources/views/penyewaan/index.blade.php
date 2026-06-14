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
            <div class="mb-5 rounded-xl bg-green-500/10 px-4 py-3 text-green-300 border border-green-400/30">
                {{ session('success') }}
            </div>
        @endif

        @if(empty($cart))
            <div class="rounded-3xl border border-cyan-500/20 bg-slate-900 p-10 text-center text-slate-400">
                Keranjang kamu masih kosong.
            </div>
        @else

        <form id="checkout-form" action="{{ route('checkout.prepare') }}" method="POST">
            @csrf
        </form>

        <div class="grid gap-8 lg:grid-cols-[1fr_380px]">

            <div class="rounded-3xl border border-cyan-500/20 bg-slate-900 p-6">

                <div class="mb-5 grid grid-cols-[40px_1fr_120px_120px_60px] gap-4 border-b border-slate-700 pb-4 text-xs font-black text-cyan-300 uppercase">
                    <div></div>
                    <div>Produk</div>
                    <div>Durasi</div>
                    <div>Total</div>
                    <div>Aksi</div>
                </div>

                <div class="space-y-5">

                    @foreach($cart as $id => $item)
                    <div class="grid grid-cols-[40px_1fr_120px_120px_60px] items-center gap-4 rounded-2xl bg-slate-800/70 p-4">

                        <input type="checkbox"
                            name="selected_items[]"
                            value="{{ $id }}"
                            checked
                            form="checkout-form"
                            class="h-5 w-5 accent-pink-500">

                        <div class="flex items-center gap-4">

                            @if(!empty($item['foto']))
                                <img src="{{ asset('image/' . $item['foto']) }}"
                                    class="h-20 w-20 rounded-2xl object-cover">
                            @else
                                <div class="h-20 w-20 rounded-2xl bg-slate-700 flex items-center justify-center text-xs text-slate-400">
                                    No Image
                                </div>
                            @endif

                            <div>
                                <h2 class="text-lg font-black">{{ $item['nama_kostum'] }}</h2>
                                <p class="text-xs text-slate-400">
                                    Mulai: {{ $item['tanggal_mulai'] }}
                                </p>
                                <p class="text-sm font-bold text-cyan-300">
                                    Rp{{ number_format($item['harga_sewa'],0,',','.') }} / hari
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <span class="rounded-full border border-cyan-500/30 bg-slate-950 px-4 py-2 text-sm font-bold">
                                {{ $item['durasi'] }} hari
                            </span>
                        </div>

                        <p class="font-black text-pink-300 text-center">
                            Rp{{ number_format($item['subtotal'],0,',','.') }}
                        </p>

                        <div class="flex justify-end">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    onclick="return confirm('Hapus item ini?')"
                                    class="p-3 rounded-xl bg-red-500/20 text-red-300 hover:bg-red-500 hover:text-white transition">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="18" height="18"
                                        fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3.1a1 1 0 0 1 .95-.68h2.8a1 1 0 0 1 .95.68H13.5a1 1 0 0 1 1 1"/>
                                    </svg>

                                </button>
                            </form>
                        </div>

                    </div>
                    @endforeach

                </div>
            </div>

            <div class="h-fit rounded-3xl border border-pink-500/20 bg-slate-900 p-6">

                <h2 class="mb-5 text-xl font-black">
                    Order <span class="text-pink-400">Summary</span>
                </h2>

                @php
                    $subtotal = collect($cart)->sum('subtotal');
                    $discount = session('voucher.discount', 0);
                    $total = max($subtotal - $discount, 0);
                @endphp

                <div class="space-y-3 border-b border-slate-700 pb-5 text-sm">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>Rp{{ number_format($subtotal,0,',','.') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Discount</span>
                        <span>- Rp{{ number_format($discount,0,',','.') }}</span>
                    </div>
                </div>

                <div class="mt-5 flex justify-between text-xl font-black">
                    <span>Total</span>
                    <span class="text-pink-300">Rp{{ number_format($total,0,',','.') }}</span>
                </div>

                <button type="submit"
                    form="checkout-form"
                    class="mt-5 w-full rounded-2xl bg-blue-600 py-3 font-bold text-white hover:bg-blue-700 transition">
                    Checkout Sekarang
                </button>

                <a href="https://wa.me/6288234183154"
                   class="mt-3 flex w-full items-center justify-center rounded-2xl bg-green-500 py-3 font-black text-white hover:bg-green-400">
                    WhatsApp Admin
                </a>

            </div>

        </div>
        @endif

    </div>
</section>
@endsection
