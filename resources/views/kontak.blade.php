@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-50 px-6 pt-28 pb-16 text-slate-900 dark:bg-slate-900 dark:text-white">
    <div class="mx-auto max-w-6xl">

        <div class="mb-12 text-center">
            <h1 class="text-4xl font-extrabold">
                Kontak <span class="text-blue-600 dark:text-pink-400">Kami</span>
            </h1>

            <p class="mt-3 text-slate-600 dark:text-slate-300">
                Punya pertanyaan atau ingin sewa kostum? Hubungi kami!
            </p>
        </div>

        <div class="grid gap-10 md:grid-cols-2">

            {{-- FORM --}}
            <div class="rounded-2xl border border-blue-200 bg-white p-8 shadow-lg dark:border-blue-500/20 dark:bg-slate-800">
                <h2 class="mb-6 text-xl font-bold text-blue-600 dark:text-cyan-300">
                    Kirim Pesan
                </h2>

                <form class="space-y-5">

                    <div>
                        <label class="block text-sm text-slate-600 dark:text-slate-300">
                            Nama
                        </label>

                        <input
                            type="text"
                            class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-900 dark:text-white dark:focus:border-cyan-400 dark:focus:ring-cyan-400"
                            placeholder="Masukkan nama kamu">
                    </div>

                    <div>
                        <label class="block text-sm text-slate-600 dark:text-slate-300">
                            Email
                        </label>

                        <input
                            type="email"
                            class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-900 dark:text-white dark:focus:border-cyan-400 dark:focus:ring-cyan-400"
                            placeholder="Masukkan email">
                    </div>

                    <div>
                        <label class="block text-sm text-slate-600 dark:text-slate-300">
                            Pesan
                        </label>

                        <textarea
                            rows="4"
                            class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-900 dark:text-white dark:focus:border-cyan-400 dark:focus:ring-cyan-400"
                            placeholder="Tulis pesan kamu..."></textarea>
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-lg bg-blue-600 py-3 font-semibold text-white hover:bg-blue-700">
                        Kirim Pesan
                    </button>

                </form>
            </div>

            {{-- INFO KONTAK --}}
            <div class="space-y-6">

                <div class="rounded-2xl border border-blue-200 bg-white p-6 shadow-lg dark:border-blue-500/20 dark:bg-slate-800 space-y-6">

                    <div>
                        <h3 class="text-lg font-bold text-blue-600 dark:text-cyan-300">
                            📍 Alamat
                        </h3>

                        <p class="mt-1 text-slate-600 dark:text-slate-300">
                            Jl. Sudirman No. 123, Jakarta, Indonesia
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-blue-600 dark:text-cyan-300">
                            ✉️ Email
                        </h3>

                        <p class="mt-1 text-slate-600 dark:text-slate-300">
                            nekoya@gmail.com
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-blue-600 dark:text-cyan-300">
                            📱 WhatsApp
                        </h3>

                        <p class="mt-1 text-slate-600 dark:text-slate-300">
                            +62 812-3456-7890
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-blue-600 dark:text-cyan-300">
                            🕒 Jam Operasional
                        </h3>

                        <p class="mt-1 text-slate-600 dark:text-slate-300">
                            Senin - Sabtu: 09.00 - 20.00
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>
@endsection
