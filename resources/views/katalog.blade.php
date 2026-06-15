@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-50 px-4 pt-28 pb-16 text-slate-900 dark:bg-slate-900 dark:text-white">
    <div class="mx-auto max-w-7xl">

        <!-- SEARCH -->
        <div class="mb-10">
            <div class="relative">
                <input
                    id="searchInput"
                    type="text"
                    placeholder="Cari nama kostum..."
                    class="w-full rounded-full border px-14 py-5"
                >
            </div>
        </div>

        <div class="grid gap-10 lg:grid-cols-[280px_1fr]">

            <!-- FILTER -->
            <aside class="h-fit rounded-2xl border bg-white p-7">
                <h2 class="mb-4 font-bold">Filter</h2>

                <!-- CATEGORY -->
                <div>
                    <p class="font-bold">Kategori</p>
                    <label><input type="checkbox" class="categoryFilter" value="anime"> Anime</label>
                    <label><input type="checkbox" class="categoryFilter" value="vtuber"> Vtuber</label>
                    <label><input type="checkbox" class="categoryFilter" value="game"> Game</label>
                    <label><input type="checkbox" class="categoryFilter" value="traditional"> Traditional</label>
                </div>

                <!-- SIZE -->
                <div class="mt-4">
                    <p class="font-bold">Ukuran</p>
                    <label><input type="checkbox" class="sizeFilter" value="s"> S</label>
                    <label><input type="checkbox" class="sizeFilter" value="m"> M</label>
                    <label><input type="checkbox" class="sizeFilter" value="l"> L</label>
                    <label><input type="checkbox" class="sizeFilter" value="xl"> XL</label>
                </div>

                <!-- PRICE -->
                <div class="mt-4">
                    <p class="font-bold">Harga</p>
                    <input id="priceFilter" type="range" min="50000" max="500000" value="500000">
                    <p id="priceText"></p>
                </div>
            </aside>

            <!-- GRID -->
            <main>

                <div class="grid gap-7 sm:grid-cols-2 xl:grid-cols-4" id="kostumContainer">

                    @foreach ($costumes as $costume)
                        <a href="{{ route('katalog.show', $costume->id) }}"
                           class="kostum-card block rounded-2xl border bg-white p-4"
                           data-name="{{ strtolower($costume->nama_kostum) }}"
                           data-category="{{ strtolower($costume->kategori) }}"
                           data-price="{{ $costume->harga_sewa }}"
                           data-size="{{ strtolower($costume->ukuran) }}"
                        >
                            <img src="{{ asset('image/' . $costume->foto) }}" class="h-40 w-full object-cover">

                            <h2 class="font-bold mt-2">{{ $costume->nama_kostum }}</h2>
                            <p>{{ $costume->kategori }}</p>
                            <p>Rp {{ number_format($costume->harga_sewa) }}</p>
                        </a>
                    @endforeach

                </div>

                <p id="emptyFilterMessage" class="hidden text-center mt-5">
                    Tidak ada data
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


searchInput.addEventListener('input', function () {

    clearTimeout(timeout);

    timeout = setTimeout(() => {

        let query = this.value;

        fetch(`{{ route('katalog.search') }}?q=` + query)
            .then(res => res.json())
            .then(data => {

                container.innerHTML = '';

                if (data.length === 0) {
                    container.innerHTML = `
                        <p class="col-span-full text-center text-gray-500">
                            Data tidak ditemukan
                        </p>
                    `;
                    return;
                }

                data.forEach(item => {
                    container.innerHTML += `
                        <a href="/katalog/${item.id}"
                           class="kostum-card block rounded-2xl border bg-white p-4"
                           data-name="${item.nama_kostum.toLowerCase()}"
                           data-category="${item.kategori.toLowerCase()}"
                           data-price="${item.harga_sewa}"
                           data-size="${item.ukuran.toLowerCase()}"
                        >
                            <img src="/image/${item.foto}" class="h-40 w-full object-cover">

                            <h2 class="font-bold mt-2">${item.nama_kostum}</h2>
                            <p>${item.kategori}</p>
                            <p>Rp ${Number(item.harga_sewa).toLocaleString('id-ID')}</p>
                        </a>
                    `;
                });

            });

    }, 300);
});

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


priceFilter.addEventListener('input', filterData);
categoryFilters.forEach(cb => cb.addEventListener('change', filterData));
sizeFilters.forEach(cb => cb.addEventListener('change', filterData));

filterData();

</script>
@endpush
