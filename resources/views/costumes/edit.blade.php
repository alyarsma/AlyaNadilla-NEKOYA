@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-[#05081d] px-6 pt-32 pb-16 text-white">
    <div class="mx-auto max-w-4xl rounded-3xl border border-cyan-400/30 bg-[#10162f] p-8 shadow-2xl shadow-cyan-500/10">

        <div class="mb-8">
            <a href="{{ url('/costumes') }}"
   class="mb-6 inline-flex items-center gap-2 rounded-xl bg-slate-800 px-4 py-2 text-cyan-300 transition hover:bg-cyan-400 hover:text-slate-950">

    <svg xmlns="http://www.w3.org/2000/svg"
         class="h-5 w-5"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15 19l-7-7 7-7" />
    </svg>

    Kembali

</a>
            <p class="mb-2 text-sm font-semibold uppercase tracking-[0.3em] text-cyan-300">
                ADMIN PANEL
            </p>
            <h1 class="text-4xl font-extrabold">
                Edit <span class="text-pink-400">Costume</span>
            </h1>
            <p class="mt-3 text-slate-300">
                Ubah data costume yang sudah tersimpan.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-400/30 bg-red-500/20 px-5 py-3 text-red-200">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('costumes.update', $costume->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">

            @csrf
            @method('PUT')

            <div class="grid gap-6 md:grid-cols-2">

                {{-- Kode Costume --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300">
                        Kode Costume
                    </label>

                    <input
                        type="text"
                        name="kode_kostum"
                        value="{{ old('kode_kostum', $costume->kode_kostum) }}"
                        class="mt-2 w-full rounded-xl border border-slate-700 bg-[#070b26] px-4 py-3 text-white outline-none focus:border-cyan-400">
                </div>

                {{-- Nama Costume --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300">
                        Nama Costume
                    </label>

                    <input
                        type="text"
                        name="nama_kostum"
                        value="{{ old('nama_kostum', $costume->nama_kostum) }}"
                        class="mt-2 w-full rounded-xl border border-slate-700 bg-[#070b26] px-4 py-3 text-white outline-none focus:border-cyan-400">
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300">
                        Kategori
                    </label>

                    <select
                        name="kategori"
                        class="mt-2 w-full rounded-xl border border-slate-700 bg-[#070b26] px-4 py-3 text-white outline-none focus:border-cyan-400">

                        <option value="">-- Pilih Kategori --</option>

                        <option value="anime"
                            {{ old('kategori', $costume->kategori) == 'anime' ? 'selected' : '' }}>
                            anime
                        </option>

                        <option value="game"
                            {{ old('kategori', $costume->kategori) == 'game' ? 'selected' : '' }}>
                            game
                        </option>

                        <option value="vtuber"
                            {{ old('kategori', $costume->kategori) == 'vtuber' ? 'selected' : '' }}>
                            vtuber
                        </option>

                    </select>
                </div>

                {{-- Ukuran --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300">
                        Ukuran
                    </label>

                    <select
                        name="ukuran"
                        class="mt-2 w-full rounded-xl border border-slate-700 bg-[#070b26] px-4 py-3 text-white outline-none focus:border-cyan-400">

                        <option value="S" {{ old('ukuran', $costume->ukuran) == 'S' ? 'selected' : '' }}>S</option>
                        <option value="M" {{ old('ukuran', $costume->ukuran) == 'M' ? 'selected' : '' }}>M</option>
                        <option value="L" {{ old('ukuran', $costume->ukuran) == 'L' ? 'selected' : '' }}>L</option>
                        <option value="XL" {{ old('ukuran', $costume->ukuran) == 'XL' ? 'selected' : '' }}>XL</option>
                    </select>
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300">
                        Harga Sewa
                    </label>

                    <input
                        type="number"
                        name="harga_sewa"
                        value="{{ old('harga_sewa', $costume->harga_sewa) }}"
                        class="mt-2 w-full rounded-xl border border-slate-700 bg-[#070b26] px-4 py-3 text-white outline-none focus:border-cyan-400">
                </div>

                {{-- Stok --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300">
                        Stok
                    </label>

                    <input
                        type="number"
                        name="stok"
                        value="{{ old('stok', $costume->stok) }}"
                        class="mt-2 w-full rounded-xl border border-slate-700 bg-[#070b26] px-4 py-3 text-white outline-none focus:border-cyan-400">
                </div>

            </div>

            {{-- FOTO --}}
            <div>
                <label class="block text-sm font-medium text-slate-300">
                    Foto Costume
                </label>

                <div class="mt-2 rounded-2xl border border-dashed border-cyan-400/40 bg-[#070b26] p-6">

                    @if($costume->foto)
                        <div class="mb-5">
                            <p class="mb-2 text-sm text-slate-400">
                                Foto saat ini:
                            </p>

                            <img
                                src="{{ asset('image/' . $costume->foto) }}"
                                alt="{{ $costume->nama_kostum }}"
                                class="h-40 w-40 rounded-2xl border border-cyan-400/30 object-cover">
                        </div>
                    @endif

                    <input
                        type="file"
                        name="foto"
                        accept="image/*"
                        class="w-full cursor-pointer rounded-xl bg-slate-900 px-4 py-3 text-slate-300
                        file:mr-4 file:cursor-pointer file:rounded-lg file:border-0
                        file:bg-pink-500 file:px-5 file:py-2 file:font-semibold file:text-white
                        hover:file:bg-pink-600">

                    <p class="mt-3 text-sm text-slate-400">
                        Kosongkan jika tidak ingin mengganti foto.
                    </p>
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="flex gap-4">

                <a href="{{ url('/costumes') }}"
                   class="w-1/2 rounded-xl border border-cyan-400 px-5 py-3 text-center font-semibold text-cyan-300 hover:bg-cyan-400 hover:text-slate-950">
                    Kembali
                </a>

                <button
                    type="submit"
                    class="w-1/2 rounded-xl bg-blue-600 px-5 py-3 font-bold text-white shadow-lg shadow-blue-600/30 hover:bg-blue-700">
                    Update Costume
                </button>

            </div>

        </form>
    </div>
</section>
@endsection
