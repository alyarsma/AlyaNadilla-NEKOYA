@extends('layouts.app')

@section('content')

<section class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100 px-4 pt-28 pb-16 dark:from-slate-950 dark:to-slate-900">

<div class="mx-auto max-w-7xl">

    <!-- SEARCH -->
    <div class="mb-10">
        <div class="relative mx-auto max-w-3xl">

            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">
                🔍
            </div>

            <input
                id="searchInput"
                type="text"
                placeholder="Cari kostum, anime, karakter..."
                class="w-full rounded-2xl border border-slate-200 bg-white py-5 pl-14 pr-5 shadow-sm
                       focus:border-blue-500 focus:ring-4 focus:ring-blue-100
                       dark:bg-slate-800 dark:border-slate-700 dark:text-white"
            >
        </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-[300px_1fr]">

        <!-- SIDEBAR FILTER -->
        <aside class="h-fit rounded-3xl border border-slate-200 bg-white/80 p-6 shadow-xl backdrop-blur
                      dark:bg-slate-800/60 dark:border-slate-700">

            <h2 class="mb-6 text-lg font-bold">Filter</h2>

            <!-- KATEGORI -->
            <div class="mb-6">
                <p class="mb-3 font-semibold text-slate-500">Kategori</p>

                <div class="space-y-2">
                    <label><input type="checkbox" class="categoryFilter" value="anime"> Anime</label>
                    <label><input type="checkbox" class="categoryFilter" value="vtuber"> Vtuber</label>
                    <label><input type="checkbox" class="categoryFilter" value="game"> Game</label>
                    <label><input type="checkbox" class="categoryFilter" value="traditional"> Traditional</label>
                </div>
            </div>

            <!-- SIZE -->
            <div class="mb-6">
                <p class="mb-3 font-semibold text-slate-500">Size</p>

                <div class="grid grid-cols-2 gap-2">
                    <label><input type="checkbox" class="sizeFilter" value="s"> S</label>
                    <label><input type="checkbox" class="sizeFilter" value="m"> M</label>
                    <label><input type="checkbox" class="sizeFilter" value="l"> L</label>
                    <label><input type="checkbox" class="sizeFilter" value="xl"> XL</label>
                </div>
            </div>

            <!-- PRICE -->
            <div>
                <p class="mb-3 font-semibold text-slate-500">Harga Maks</p>

                <input id="priceFilter" type="range" min="50000" max="500000"
                       class="w-full accent-blue-500">

                <p id="priceText" class="mt-2 text-sm font-bold text-blue-600"></p>
            </div>

        </aside>

        <!-- GRID -->
        <main>

            <div id="kostumContainer"
                 class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">

                @foreach ($costumes as $costume)
                    <a href="{{ route('katalog.show', $costume->id) }}"
                       class="kostum-card group overflow-hidden rounded-2xl bg-white shadow-md transition hover:-translate-y-2 hover:shadow-xl dark:bg-slate-800"
                       data-name="{{ strtolower($costume->nama_kostum) }}"
                       data-category="{{ strtolower($costume->kategori) }}"
                       data-price="{{ $costume->harga_sewa }}"
                       data-size="{{ strtolower($costume->ukuran) }}"
                    >

                        <div class="relative h-60 overflow-hidden">
                            <img
                                src="{{ $costume->foto ? asset('image/' . $costume->foto) : asset('image/default-costume.jpg') }}"
                                class="h-full w-full object-cover transition group-hover:scale-110"
                            >

                            <div class="absolute top-3 left-3 rounded-full bg-black/60 px-3 py-1 text-xs text-white">
                                {{ $costume->kategori }}
                            </div>
                        </div>

                        <div class="p-4">
                            <h2 class="text-lg font-bold text-slate-800 dark:text-white">
                                {{ $costume->nama_kostum }}
                            </h2>

                            <p class="text-sm text-slate-500">
                                Size {{ $costume->ukuran }} • Stok {{ $costume->stok }}
                            </p>

                            <div class="mt-3 flex justify-between items-center">
                                <span class="font-bold text-blue-600">
                                    Rp{{ number_format($costume->harga_sewa, 0, ',', '.') }}
                                </span>

                                <span class="text-xs text-green-500 font-semibold">
                                    {{ $costume->tersedia ? 'Available' : 'Habis' }}
                                </span>
                            </div>
                        </div>

                    </a>
                @endforeach

            </div>

            <!-- EMPTY -->
            <p id="emptyFilterMessage" class="mt-10 hidden text-center text-slate-500">
                Tidak ada kostum yang cocok
            </p>

        </main>

    </div>
</div>

</section>

@endsection


@push('scripts')
<script>

const searchInput = document.getElementById('searchInput');
const container = document.getElementById('kostumContainer');
const priceFilter = document.getElementById('priceFilter');
const priceText = document.getElementById('priceText');
const categoryFilters = document.querySelectorAll('.categoryFilter');
const sizeFilters = document.querySelectorAll('.sizeFilter');
const emptyFilterMessage = document.getElementById('emptyFilterMessage');

let timeout = null;


/* =========================
   AJAX SEARCH
========================= */
searchInput.addEventListener('input', function () {

    clearTimeout(timeout);

    timeout = setTimeout(() => {

        let query = this.value;

        container.innerHTML = `
            <div class="col-span-full text-center py-10 text-slate-500">
                🔄 Searching...
            </div>
        `;

        fetch(`{{ route('katalog.search') }}?q=` + query)
            .then(res => res.json())
            .then(data => {

                container.innerHTML = '';

                if (data.length === 0) {
                    container.innerHTML = `
                        <div class="col-span-full text-center py-10 text-slate-500">
                            😢 Data tidak ditemukan
                        </div>
                    `;
                    return;
                }

                data.forEach(item => {

                    container.innerHTML += `
                        <a href="/katalog/${item.id}"
                           class="kostum-card group overflow-hidden rounded-2xl bg-white shadow-md transition hover:-translate-y-2 hover:shadow-xl dark:bg-slate-800"

                           data-name="${item.nama_kostum.toLowerCase()}"
                           data-category="${item.kategori.toLowerCase()}"
                           data-price="${item.harga_sewa}"
                           data-size="${item.ukuran.toLowerCase()}"
                        >

                            <div class="relative h-60 overflow-hidden">
                                <img src="/image/${item.foto}"
                                     class="h-full w-full object-cover transition group-hover:scale-110">

                                <div class="absolute top-3 left-3 rounded-full bg-black/60 px-3 py-1 text-xs text-white">
                                    ${item.kategori}
                                </div>
                            </div>

                            <div class="p-4">
                                <h2 class="text-lg font-bold">
                                    ${item.nama_kostum}
                                </h2>

                                <p class="text-sm text-slate-500">
                                    Size ${item.ukuran}
                                </p>

                                <div class="mt-3 font-bold text-blue-600">
                                    Rp ${Number(item.harga_sewa).toLocaleString('id-ID')}
                                </div>
                            </div>

                        </a>
                    `;
                });

            });

    }, 300);
});


/* =========================
   FILTER (CLIENT SIDE)
========================= */
function filterData() {

    const maxPrice = Number(priceFilter.value);

    const selectedCategories = Array.from(categoryFilters)
        .filter(cb => cb.checked)
        .map(cb => cb.value.toLowerCase());

    const selectedSizes = Array.from(sizeFilters)
        .filter(cb => cb.checked)
        .map(cb => cb.value.toLowerCase());

    const cards = document.querySelectorAll('.kostum-card');

    let visible = 0;

    cards.forEach(card => {

        const category = card.dataset.category;
        const price = Number(card.dataset.price);
        const size = card.dataset.size;

        const match =
            price <= maxPrice &&
            (selectedCategories.length === 0 || selectedCategories.includes(category)) &&
            (selectedSizes.length === 0 || selectedSizes.includes(size));

        if (match) {
            card.classList.remove('hidden');
            visible++;
        } else {
            card.classList.add('hidden');
        }
    });

    emptyFilterMessage.classList.toggle('hidden', visible !== 0);

    priceText.textContent = 'Rp ' + Number(maxPrice).toLocaleString('id-ID');
}

/* EVENTS */
priceFilter.addEventListener('input', filterData);
categoryFilters.forEach(cb => cb.addEventListener('change', filterData));
sizeFilters.forEach(cb => cb.addEventListener('change', filterData));

filterData();

</script>
@endpush
