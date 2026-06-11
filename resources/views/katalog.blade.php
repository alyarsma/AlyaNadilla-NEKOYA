@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-50 px-4 pt-28 pb-16 text-slate-900 dark:bg-slate-900 dark:text-white">
    <div class="mx-auto max-w-7xl">

        <div class="mb-10">
            <div class="relative">
                <svg
                    class="absolute left-6 top-1/2 h-5 w-5 -translate-y-1/2 text-blue-600 dark:text-cyan-300"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>

                <input
                    id="searchInput"
                    type="text"
                    placeholder="Cari nama kostum, karakter, atau judul anime..."
                    class="w-full rounded-full border border-blue-200 bg-white px-14 py-5 text-slate-900 placeholder:text-slate-400 outline-none focus:border-blue-500 dark:border-cyan-500/30 dark:bg-[#071033] dark:text-slate-300 dark:placeholder:text-gray-400 dark:focus:border-cyan-300"
                >
            </div>
        </div>

        <div class="grid gap-10 lg:grid-cols-[280px_1fr]">

            <aside class="h-fit rounded-2xl border border-blue-200 bg-white p-7 text-slate-700 shadow dark:border-blue-500/20 dark:bg-slate-800 dark:text-slate-300">
                <h2 class="mb-5 text-lg font-bold uppercase tracking-[3px] text-blue-600 dark:text-cyan-300">
                    Filter
                </h2>

                <div class="mb-8 h-px bg-slate-200 dark:bg-slate-600"></div>

                <div class="mb-8">
                    <h3 class="mb-4 font-bold uppercase tracking-[2px] text-blue-600 dark:text-cyan-200">
                        Kategori
                    </h3>

                    <div class="space-y-4 text-sm font-bold uppercase tracking-[1px]">
                        <label class="flex items-center gap-3">
                            <input type="checkbox" class="categoryFilter" value="anime"> Anime
                        </label>
                        <label class="flex items-center gap-3">
                            <input type="checkbox" class="categoryFilter" value="vtuber"> Vtuber
                        </label>
                        <label class="flex items-center gap-3">
                            <input type="checkbox" class="categoryFilter" value="game"> Game
                        </label>
                        <label class="flex items-center gap-3">
                            <input type="checkbox" class="categoryFilter" value="traditional"> Traditional
                        </label>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="mb-4 font-bold uppercase tracking-[2px] text-blue-600 dark:text-cyan-200">
                        Ukuran
                    </h3>

                    <div class="grid grid-cols-2 gap-4 text-sm font-bold uppercase tracking-[1px]">
                        <label class="flex items-center gap-3">
                            <input type="checkbox" class="sizeFilter" value="s"> S
                        </label>
                        <label class="flex items-center gap-3">
                            <input type="checkbox" class="sizeFilter" value="m"> M
                        </label>
                        <label class="flex items-center gap-3">
                            <input type="checkbox" class="sizeFilter" value="l"> L
                        </label>
                        <label class="flex items-center gap-3">
                            <input type="checkbox" class="sizeFilter" value="xl"> XL
                        </label>
                    </div>
                </div>

                <div>
                    <h3 class="mb-4 font-bold uppercase tracking-[2px] text-blue-600 dark:text-cyan-200">
                        Harga Maks / Hari
                    </h3>

                    <input id="priceFilter" type="range" min="50000" max="500000" value="500000" class="w-full">

                    <div class="mt-2 flex justify-between text-sm font-bold">
                        <span>Rp50rb</span>
                        <span id="priceText" class="text-blue-600 dark:text-cyan-300">Rp500rb</span>
                    </div>
                </div>
            </aside>

            <main>
                <div class="mb-8 flex items-center justify-between gap-4">
                    <h1 class="text-4xl font-bold md:text-5xl">
                        Katalog <span class="text-blue-600 dark:text-pink-400">Kostum</span>
                    </h1>

                    @if(session('is_admin'))
                        <a href="{{ route('costumes.create') }}"
                           class="rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700">
                            + Tambah Produk
                        </a>
                    @endif
                </div>

                <div class="grid gap-7 sm:grid-cols-2 xl:grid-cols-4">

                    @forelse ($costumes as $costume)
                        <a href="{{ route('katalog.show', $costume->id) }}"
                           class="kostum-card block overflow-hidden rounded-2xl border border-blue-200 bg-white shadow transition hover:-translate-y-2 hover:border-blue-500 hover:shadow-xl dark:border-cyan-500/30 dark:bg-slate-800 dark:hover:border-pink-400 dark:hover:shadow-pink-500/20"
                           data-name="{{ strtolower($costume->nama_kostum) }}"
                           data-category="{{ strtolower($costume->kategori) }}"
                           data-price="{{ $costume->harga_sewa }}"
                           data-size="{{ strtolower($costume->ukuran) }}"
                        >
                            <div class="relative flex h-80 items-center justify-center bg-white">
                                <img
                                    src="{{ $costume->foto ? asset('image/' . $costume->foto) : asset('image/default-costume.jpg') }}"
                                    class="h-full w-full object-cover"
                                    alt="{{ $costume->nama_kostum }}"
                                >

                                <span class="absolute left-4 top-4 rounded-md bg-blue-600 px-3 py-1 text-xs font-bold text-white dark:bg-pink-400 dark:text-slate-950">
                                    {{ $costume->kategori }}
                                </span>
                            </div>

                            <div class="p-5">
                                <h2 class="mb-2 text-lg font-bold text-slate-900 dark:text-white">
                                    {{ $costume->nama_kostum }}
                                </h2>

                                <p class="text-sm text-slate-600 dark:text-slate-400">
                                    Ukuran: {{ $costume->ukuran }} • Stok: {{ $costume->stok }}
                                </p>

                                <p class="mt-3 text-lg font-bold text-blue-600 dark:text-cyan-400">
                                    Rp{{ number_format($costume->harga_sewa, 0, ',', '.') }} / hari
                                </p>

                                @if($costume->tersedia)
                                    <span class="mt-3 inline-block rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700 dark:bg-green-500/20 dark:text-green-300">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="mt-3 inline-block rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700 dark:bg-red-500/20 dark:text-red-300">
                                        Tidak Tersedia
                                    </span>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full rounded-2xl border border-blue-200 bg-white p-8 text-center text-slate-600 shadow dark:border-cyan-500/30 dark:bg-slate-800 dark:text-slate-400">
                            Belum ada kostum tersedia.
                        </div>
                    @endforelse

                </div>

                <p id="emptyFilterMessage" class="mt-8 hidden text-center text-slate-600 dark:text-slate-400">
                    Tidak ada kostum yang cocok dengan filter.
                </p>
            </main>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const priceFilter = document.getElementById('priceFilter');
    const priceText = document.getElementById('priceText');
    const categoryFilters = document.querySelectorAll('.categoryFilter');
    const sizeFilters = document.querySelectorAll('.sizeFilter');
    const cards = document.querySelectorAll('.kostum-card');
    const emptyFilterMessage = document.getElementById('emptyFilterMessage');

    function formatRupiah(value) {
        return 'Rp' + Number(value).toLocaleString('id-ID');
    }

    function filterData() {
        const search = searchInput.value.toLowerCase();
        const maxPrice = Number(priceFilter.value);

        const selectedCategories = Array.from(categoryFilters)
            .filter(cb => cb.checked)
            .map(cb => cb.value.toLowerCase());

        const selectedSizes = Array.from(sizeFilters)
            .filter(cb => cb.checked)
            .map(cb => cb.value.toLowerCase());

        let visibleCount = 0;

        cards.forEach(card => {
            const name = card.dataset.name;
            const category = card.dataset.category;
            const price = Number(card.dataset.price);
            const size = card.dataset.size || '';

            const matchSearch = name.includes(search);
            const matchCategory = selectedCategories.length === 0 || selectedCategories.includes(category);
            const matchPrice = price <= maxPrice;
            const matchSize = selectedSizes.length === 0 || selectedSizes.some(selectedSize => size.includes(selectedSize));

            if (matchSearch && matchCategory && matchPrice && matchSize) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        emptyFilterMessage.classList.toggle('hidden', visibleCount !== 0);
        priceText.textContent = formatRupiah(maxPrice);
    }

    searchInput.addEventListener('input', filterData);
    priceFilter.addEventListener('input', filterData);

    categoryFilters.forEach(cb => {
        cb.addEventListener('change', filterData);
    });

    sizeFilters.forEach(cb => {
        cb.addEventListener('change', filterData);
    });

    filterData();
</script>
@endpush
