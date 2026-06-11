@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-white px-6 pt-28 pb-16 text-slate-900 dark:bg-slate-950 dark:text-white">
    <div class="mx-auto max-w-5xl">

        <h1 class="text-3xl font-bold">
            Keranjang <span class="text-pink-400">Costume</span>
        </h1>

        <p class="mt-2 text-slate-600 dark:text-slate-400">
            Statistik ini dihitung setiap kali halaman cart dikunjungi.
        </p>

        @if(session('success'))
            <div class="mt-6 rounded-xl bg-green-500 px-5 py-4 text-white">
                {{ session('success') }}
            </div>
        @endif

        <section class="mt-8 rounded-2xl border border-cyan-400/30 bg-slate-100 p-6 dark:bg-slate-900">
            <h2 class="text-2xl font-bold">
                Statistik Kunjungan Cart
            </h2>

            <div class="mt-5 grid gap-4 md:grid-cols-3">
                <div class="rounded-xl bg-white p-5 dark:bg-slate-800">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Jumlah Kunjungan
                    </p>

                    <h3 class="mt-2 text-4xl font-bold text-pink-400">
                        {{ $visitCount }}
                    </h3>
                </div>

                <div class="rounded-xl bg-white p-5 dark:bg-slate-800">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Kunjungan Pertama
                    </p>

                    <h3 class="mt-2 font-bold text-cyan-400">
                        {{ $firstVisit }}
                    </h3>
                </div>

                <div class="rounded-xl bg-white p-5 dark:bg-slate-800">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Kunjungan Terakhir
                    </p>

                    <h3 id="lastVisitTime" class="mt-2 font-bold text-yellow-400">
    {{ $lastVisit }}
</h3>
                </div>
            </div>

            <form action="{{ route('cart.resetVisit') }}" method="POST" class="mt-6">
                @csrf

                <button
                    type="submit"
                    class="rounded-full bg-red-500 px-6 py-3 font-semibold text-white hover:bg-red-400"
                >
                    Reset Hitungan
                </button>
            </form>
        </section>

    </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const lastVisitElement = document.getElementById("lastVisitTime");

    let currentTime = new Date();

    function updateClock() {
        currentTime.setSeconds(currentTime.getSeconds() + 1);

        const formatted =
            currentTime.getDate().toString().padStart(2, '0') + ' ' +
            currentTime.toLocaleString('en-US', { month: 'short' }) + ' ' +
            currentTime.getFullYear() + ' ' +
            currentTime.toLocaleTimeString();

        lastVisitElement.textContent = formatted;
    }

    setInterval(updateClock, 1000);
});
</script>
@endsection
