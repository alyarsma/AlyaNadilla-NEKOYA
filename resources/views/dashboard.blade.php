@extends('layouts.app')

@section('content')

@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true
    });
});
</script>
@endif

<div class="bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-white overflow-hidden">

    {{-- HERO --}}
    <section id="hero-section" class="relative px-6 pt-10 pb-0 bg-slate-50 dark:bg-slate-950 overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div id="glow-1" class="absolute left-20 top-32 h-64 w-64 rounded-full bg-blue-500/20 blur-3xl"></div>
            <div id="glow-2" class="absolute right-40 bottom-20 h-72 w-72 rounded-full bg-cyan-400/20 blur-3xl"></div>
        </div>

        <div class="relative mx-auto grid max-w-7xl grid-cols-1 items-center gap-10 md:grid-cols-2">
            <div id="hero-text" class="space-y-6 pb-20">
                <p class="hero-animate opacity-0 translate-y-8 mb-4 text-sm font-semibold uppercase tracking-widest text-blue-600 dark:text-cyan-300">
                    Nekoya Cosplay Rental
                </p>

                <h1 class="hero-animate opacity-0 translate-y-8 text-4xl font-extrabold leading-tight sm:text-5xl md:text-6xl">
                    Wear your
                    <span class="text-blue-600 dark:text-pink-400">favorite character</span>
                </h1>

                <p class="hero-animate opacity-0 translate-y-8 max-w-xl text-lg leading-relaxed text-slate-600 dark:text-slate-300">
                    Sewa kostum anime, Vtuber, dan karakter game untuk event,
                    photoshoot, cosplay gathering, atau kebutuhan kontenmu.
                </p>

                <div class="hero-animate opacity-0 translate-y-8 mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('katalog') }}"
                       class="rounded-full bg-blue-600 px-7 py-3 font-semibold text-white transition duration-300 hover:scale-105 hover:bg-blue-700">
                        Lihat Katalog
                    </a>

                    <a href="#collections"
                       class="rounded-full border border-blue-600 px-7 py-3 font-semibold text-blue-600 transition duration-300 hover:scale-105 hover:bg-blue-600 hover:text-white dark:border-cyan-300 dark:text-cyan-300 dark:hover:bg-cyan-300 dark:hover:text-slate-950">
                        Explore
                    </a>
                </div>
            </div>

            <div class="relative min-h-[560px] overflow-hidden">
                <img id="hero-character"
                     src="{{ asset('image/furina.png') }}"
                     alt="Furina"
                     class="absolute bottom-0 right-0 z-10 h-[520px] w-auto object-contain drop-shadow-2xl transition-transform duration-300 sm:h-[580px] md:h-[620px] lg:h-[680px]">
            </div>
        </div>
    </section>

    @if(auth()->check())

        {{-- ADMIN DASHBOARD --}}
        @if(auth()->user()->email === 'admin@example.com' || auth()->user()->name === 'Admin')
            <section class="px-6 pb-14 bg-slate-50 dark:bg-slate-950">
                <div class="mx-auto max-w-7xl rounded-3xl border border-blue-200 bg-white p-6 shadow-2xl dark:border-cyan-400/30 dark:bg-slate-900/80">

                    <div class="mb-6 flex items-center gap-4">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}"
                                 class="h-14 w-14 rounded-full border border-blue-500 object-cover dark:border-cyan-300">
                        @else
                            <div class="flex h-14 w-14 items-center justify-center rounded-full border border-blue-500 bg-slate-200 text-slate-500 dark:border-cyan-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-9 w-9"
                                     viewBox="0 0 24 24"
                                     fill="currentColor">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4Zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4Z"/>
                                </svg>
                            </div>
                        @endif

                        <div>
                            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">
                                Halo, {{ auth()->user()->name ?? 'Admin' }} 👋
                            </h2>
                            <p class="text-slate-600 dark:text-slate-400">Berikut ringkasan stok kostum Nekoya.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="rounded-2xl border border-blue-200 bg-slate-50 p-5 dark:border-pink-400/20 dark:bg-slate-800">
                            <p class="text-sm text-slate-600 dark:text-slate-400">Total Kostum</p>
                            <h3 class="mt-2 text-4xl font-bold text-blue-600 dark:text-pink-400">{{ $totalKostum ?? 0 }}</h3>
                        </div>

                        <div class="rounded-2xl border border-blue-200 bg-slate-50 p-5 dark:border-cyan-400/20 dark:bg-slate-800">
                            <p class="text-sm text-slate-600 dark:text-slate-400">Total Stok</p>
                            <h3 class="mt-2 text-4xl font-bold text-blue-600 dark:text-cyan-300">{{ $totalStok ?? 0 }}</h3>
                        </div>

                        <div class="rounded-2xl border border-blue-200 bg-slate-50 p-5 dark:border-yellow-400/20 dark:bg-slate-800">
                            <p class="text-sm text-slate-600 dark:text-slate-400">Stok Menipis</p>
                            <h3 class="mt-2 text-4xl font-bold text-blue-600 dark:text-yellow-300">{{ $stokMenipis ?? 0 }}</h3>
                        </div>

                        <div class="rounded-2xl border border-blue-200 bg-slate-50 p-5 dark:border-red-400/20 dark:bg-slate-800">
                            <p class="text-sm text-slate-600 dark:text-slate-400">Stok Kosong</p>
                            <h3 class="mt-2 text-4xl font-bold text-blue-600 dark:text-red-400">{{ $stokKosong ?? 0 }}</h3>
                        </div>
                    </div>

                    <div class="mt-6 rounded-2xl border border-blue-200 bg-slate-50 p-5 dark:border-slate-700 dark:bg-slate-800">
                        <h3 class="mb-4 text-xl font-bold text-slate-900 dark:text-white">Reminder Restock</h3>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="text-slate-600 dark:text-slate-400">
                                    <tr>
                                        <th class="pb-3">Nama Kostum</th>
                                        <th class="pb-3">Kategori</th>
                                        <th class="pb-3">Stok</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse(($perluRestock ?? collect()) as $kostum)
                                        <tr class="border-t border-slate-200 dark:border-slate-700">
                                            <td class="py-3 text-slate-900 dark:text-white">
                                                {{ data_get($kostum, 'nama_kostum') ?? data_get($kostum, 'name') ?? '-' }}
                                            </td>

                                            <td class="py-3 text-slate-600 dark:text-slate-300">
                                                {{ data_get($kostum, 'kategori') ?? data_get($kostum, 'category') ?? '-' }}
                                            </td>

                                            <td class="py-3 font-bold text-blue-600 dark:text-yellow-300">
                                                {{ data_get($kostum, 'stok') ?? data_get($kostum, 'stock') ?? 0 }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-4 text-slate-600 dark:text-slate-400">
                                                Semua stok masih aman.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-6 rounded-2xl border border-blue-200 bg-slate-50 p-5 dark:border-cyan-400/20 dark:bg-slate-800">
                        <h3 class="mb-4 text-xl font-bold text-slate-900 dark:text-white">
                            Statistik Kunjungan Website
                        </h3>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div class="rounded-2xl border border-blue-200 bg-white p-5 dark:border-pink-400/20 dark:bg-slate-900">
                                <p class="text-sm text-slate-600 dark:text-slate-400">Jumlah Kunjungan</p>
                                <h3 class="mt-2 text-4xl font-bold text-blue-600 dark:text-pink-400">
                                    {{ $totalKunjungan ?? 0 }}
                                </h3>
                            </div>

                            <div class="rounded-2xl border border-blue-200 bg-white p-5 dark:border-cyan-400/20 dark:bg-slate-900">
                                <p class="text-sm text-slate-600 dark:text-slate-400">Kunjungan Pertama</p>
                                <h3 class="mt-2 text-lg font-bold text-blue-600 dark:text-cyan-300">
                                    {{ isset($kunjunganPertama) && $kunjunganPertama ? \Carbon\Carbon::parse($kunjunganPertama->visited_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i') : '-' }}
                                </h3>
                            </div>

                            <div class="rounded-2xl border border-blue-200 bg-white p-5 dark:border-yellow-400/20 dark:bg-slate-900">
                                <p class="text-sm text-slate-600 dark:text-slate-400">Kunjungan Terakhir</p>
                                <h3 class="mt-2 text-lg font-bold text-blue-600 dark:text-yellow-300">
                                    {{ isset($kunjunganTerakhir) && $kunjunganTerakhir ? \Carbon\Carbon::parse($kunjunganTerakhir->visited_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i') : '-' }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif

    {{-- API ANIME MUSIM INI --}}
    <section class="px-6 pb-14 bg-slate-50 dark:bg-slate-950">
        <div class="mx-auto max-w-7xl rounded-3xl border border-blue-200 bg-white p-6 shadow-2xl dark:border-pink-400/30 dark:bg-slate-900/80">
            <div class="mb-6">
                <h2 class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">
                    Anime Musim Ini
                </h2>
                <p class="mt-1 text-slate-600 dark:text-slate-400">
                    Rekomendasi anime yang sedang tayang musim ini.
                </p>
            </div>

            <div id="anime-loading" class="rounded-2xl border border-blue-200 bg-slate-50 p-5 text-blue-600 font-semibold dark:border-cyan-400/20 dark:bg-slate-800 dark:text-cyan-300">
                Loading data anime musim ini...
            </div>

            <div id="anime-error" class="hidden rounded-2xl border border-red-400/20 bg-slate-50 p-5 text-red-500 font-semibold dark:bg-slate-800 dark:text-red-400">
                Gagal mengambil data anime.
            </div>

            <div id="anime-result" class="hidden grid grid-cols-1 gap-6 md:grid-cols-[240px_1fr]">
                <div class="overflow-hidden rounded-2xl border border-blue-200 bg-slate-50 dark:border-pink-400/20 dark:bg-slate-800">
                    <img id="anime-image"
                         src=""
                         alt="Anime Poster"
                         class="h-80 w-full object-cover">
                </div>

                <div class="rounded-2xl border border-blue-200 bg-slate-50 p-6 dark:border-cyan-400/20 dark:bg-slate-800">
                    <h3 id="anime-title" class="text-3xl font-bold text-blue-600 dark:text-pink-400"></h3>

                    <p class="mt-3 text-blue-600 font-semibold dark:text-cyan-300">
                        Rating:
                        <span id="anime-rating"></span>
                    </p>

                    <p id="anime-description" class="mt-5 leading-relaxed text-slate-600 dark:text-slate-300"></p>

                    <a id="anime-link"
                       href="#"
                       target="_blank"
                       class="mt-6 inline-flex rounded-full border border-blue-600 px-6 py-2 font-semibold text-blue-600 transition hover:bg-blue-600 hover:text-white dark:border-cyan-300 dark:text-cyan-300 dark:hover:bg-cyan-300 dark:hover:text-slate-950">
                        Lihat Detail Anime
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- API CUACA JEMBER --}}
    <section class="px-6 pb-14 bg-slate-50 dark:bg-slate-950">
        <div class="mx-auto max-w-7xl rounded-3xl border border-blue-200 bg-white p-6 shadow-2xl dark:border-cyan-400/30 dark:bg-slate-900/80">
            <div class="mb-6">
                <p class="text-sm font-semibold uppercase tracking-widest text-blue-600 dark:text-cyan-300">
                    Public API
                </p>
                <h2 class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">
                    Cuaca Jember
                </h2>
                <p class="mt-1 text-slate-600 dark:text-slate-400">
                    Data cuaca real-time Kota Jember.
                </p>
            </div>

            <div id="weather-loading" class="rounded-2xl border border-blue-200 bg-slate-50 p-5 text-blue-600 font-semibold dark:border-cyan-400/20 dark:bg-slate-800 dark:text-cyan-300">
                Loading data cuaca Jember...
            </div>

            <div id="weather-error" class="hidden rounded-2xl border border-red-400/20 bg-slate-50 p-5 text-red-500 font-semibold dark:bg-slate-800 dark:text-red-400">
                Gagal mengambil data cuaca.
            </div>

            <div id="weather-result" class="hidden grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="rounded-2xl border border-blue-200 bg-slate-50 p-5 dark:border-pink-400/20 dark:bg-slate-800">
                    <p class="text-sm text-slate-600 dark:text-slate-400">Kota</p>
                    <h3 id="weather-city" class="mt-2 text-3xl font-bold text-blue-600 dark:text-pink-400"></h3>
                </div>

                <div class="rounded-2xl border border-blue-200 bg-slate-50 p-5 dark:border-cyan-400/20 dark:bg-slate-800">
                    <p class="text-sm text-slate-600 dark:text-slate-400">Suhu Saat Ini</p>
                    <h3 class="mt-2 text-3xl font-bold text-blue-600 dark:text-cyan-300">
                        <span id="weather-temp"></span>°C
                    </h3>
                </div>

                <div class="rounded-2xl border border-blue-200 bg-slate-50 p-5 dark:border-yellow-400/20 dark:bg-slate-800">
                    <p class="text-sm text-slate-600 dark:text-slate-400">Deskripsi</p>
                    <h3 id="weather-desc" class="mt-2 text-2xl font-bold text-blue-600 dark:text-yellow-300"></h3>
                </div>
            </div>
        </div>
    </section>

    {{-- COLLECTIONS --}}
    <section id="collections" class="px-6 py-14 bg-white dark:bg-slate-900">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Collections</h2>
                <a href="{{ route('katalog') }}"
                   class="text-blue-600 transition duration-300 hover:text-blue-700 dark:text-white dark:hover:text-cyan-400">
                    See All
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="collection-card rounded-xl bg-slate-100 p-5 transition duration-300 hover:-translate-y-2 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700">
                    <img src="{{ asset('image/anime.jpg') }}" class="mb-4 h-40 w-full object-cover rounded-lg">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Anime</h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Kostum karakter anime populer.</p>
                </div>

                <div class="collection-card rounded-xl bg-slate-100 p-5 transition duration-300 hover:-translate-y-2 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700">
                    <img src="{{ asset('image/vtuber.jpg') }}" class="mb-4 h-40 w-full object-cover rounded-lg">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Vtuber</h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Outfit karakter Vtuber favorit.</p>
                </div>

                <div class="collection-card rounded-xl bg-slate-100 p-5 transition duration-300 hover:-translate-y-2 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700">
                    <img src="{{ asset('image/game.jpg') }}" class="mb-4 h-40 w-full object-cover rounded-lg">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Game</h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Cosplay karakter game populer.</p>
                </div>

                <div class="collection-card rounded-xl bg-slate-100 p-5 transition duration-300 hover:-translate-y-2 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700">
                    <img src="{{ asset('image/accessoris.jpg') }}" class="mb-4 h-40 w-full object-cover rounded-lg">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Accessories</h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Wig, properti, dan aksesoris.</p>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    const heroSection = document.getElementById('hero-section');
    const heroCharacter = document.getElementById('hero-character');
    const glow1 = document.getElementById('glow-1');
    const glow2 = document.getElementById('glow-2');

    window.addEventListener('load', () => {
        const heroItems = document.querySelectorAll('.hero-animate');

        heroItems.forEach((item, index) => {
            item.classList.add('transition-all', 'duration-700', 'ease-out');

            setTimeout(() => {
                item.classList.remove('opacity-0', 'translate-y-8');
                item.classList.add('opacity-100', 'translate-y-0');
            }, index * 180);
        });
    });

    if (heroSection && heroCharacter && glow1 && glow2) {
        heroSection.addEventListener('mousemove', (event) => {
            const x = (event.clientX / window.innerWidth - 0.5) * 35;
            const y = (event.clientY / window.innerHeight - 0.5) * 35;

            heroCharacter.style.transform = `translate(${x}px, ${y}px) scale(1.04)`;
            glow1.style.transform = `translate(${x * 0.7}px, ${y * 0.7}px)`;
            glow2.style.transform = `translate(${x * -0.7}px, ${y * -0.7}px)`;
        });

        heroSection.addEventListener('mouseleave', () => {
            heroCharacter.style.transform = 'translate(0, 0) scale(1)';
            glow1.style.transform = 'translate(0, 0)';
            glow2.style.transform = 'translate(0, 0)';
        });
    }

    async function getAnimeInspiration() {
        const loading = document.getElementById('anime-loading');
        const errorBox = document.getElementById('anime-error');
        const result = document.getElementById('anime-result');

        const image = document.getElementById('anime-image');
        const title = document.getElementById('anime-title');
        const rating = document.getElementById('anime-rating');
        const description = document.getElementById('anime-description');
        const link = document.getElementById('anime-link');

        try {
            loading.classList.remove('hidden');
            errorBox.classList.add('hidden');
            result.classList.add('hidden');

            const response = await fetch('https://api.jikan.moe/v4/seasons/now?sfw=true');

            if (!response.ok) {
                throw new Error('Gagal mengambil data API');
            }

            const data = await response.json();

            const anime = data.data.find(item =>
                item.score >= 7 &&
                item.rating !== 'Rx - Hentai'
            ) || data.data[0];

            image.src = anime.images.jpg.image_url;
            image.alt = anime.title;
            title.textContent = anime.title;
            rating.textContent = anime.score ?? 'Belum ada rating';
            description.textContent = anime.synopsis ?? 'Sinopsis belum tersedia.';
            link.href = anime.url;

            result.classList.remove('hidden');
        } catch (error) {
            errorBox.classList.remove('hidden');
        } finally {
            loading.classList.add('hidden');
        }
    }

    async function getJemberWeather() {
        const loading = document.getElementById('weather-loading');
        const errorBox = document.getElementById('weather-error');
        const result = document.getElementById('weather-result');

        const city = document.getElementById('weather-city');
        const temp = document.getElementById('weather-temp');
        const desc = document.getElementById('weather-desc');

        try {
            loading.classList.remove('hidden');
            errorBox.classList.add('hidden');
            result.classList.add('hidden');

            const response = await fetch(
                'https://api.open-meteo.com/v1/forecast?latitude=-8.1724&longitude=113.6995&current_weather=true'
            );

            if (!response.ok) {
                throw new Error('API gagal');
            }

            const data = await response.json();
            const weather = data.current_weather;

            city.textContent = 'Jember';
            temp.textContent = weather.temperature;

            const weatherCode = weather.weathercode;

            let weatherText = 'Tidak diketahui';

            if (weatherCode === 0) {
                weatherText = 'Cerah';
            } else if ([1, 2, 3].includes(weatherCode)) {
                weatherText = 'Berawan';
            } else if ([45, 48].includes(weatherCode)) {
                weatherText = 'Berkabut';
            } else if ([51, 53, 55, 61, 63, 65].includes(weatherCode)) {
                weatherText = 'Hujan';
            } else if ([71, 73, 75].includes(weatherCode)) {
                weatherText = 'Salju';
            } else if ([95, 96, 99].includes(weatherCode)) {
                weatherText = 'Badai Petir';
            }

            desc.textContent = weatherText;

            result.classList.remove('hidden');
        } catch (error) {
            console.error(error);
            errorBox.classList.remove('hidden');
        } finally {
            loading.classList.add('hidden');
        }
    }

    getAnimeInspiration();
    getJemberWeather();
</script>
@endsection
