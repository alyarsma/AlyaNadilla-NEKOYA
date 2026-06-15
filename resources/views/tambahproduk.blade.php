@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-[#05081d] px-6 pt-32 pb-16 text-white">
    <div class="mx-auto max-w-4xl rounded-3xl border border-cyan-400/30 bg-[#10162f] p-8 shadow-2xl shadow-cyan-500/10">

        <div class="mb-8">
            <p class="mb-2 text-sm font-semibold uppercase tracking-[0.3em] text-cyan-300">
                NEKOYA ADMIN
            </p>
            <h1 class="text-4xl font-extrabold">
                Tambah <span class="text-pink-400">Kostum</span>
            </h1>
            <p class="mt-3 text-slate-300">
                Masukkan data kostum baru untuk ditampilkan di katalog.
            </p>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl border border-green-400/30 bg-green-500/20 px-5 py-3 text-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-xl border border-red-400/30 bg-red-500/20 px-5 py-3 text-red-200">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('costumes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-slate-300">Kode Kostum</label>
                    <input type="text" name="kode_kostum" value="{{ old('kode_kostum') }}" required
                        class="mt-2 w-full rounded-xl border border-slate-700 bg-[#070b26] px-4 py-3 text-white outline-none focus:border-cyan-400">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300">Nama Kostum</label>
                    <input type="text" name="nama_kostum" value="{{ old('nama_kostum') }}" required
                        class="mt-2 w-full rounded-xl border border-slate-700 bg-[#070b26] px-4 py-3 text-white outline-none focus:border-cyan-400">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300">Kategori</label>
                    <select name="kategori" required
                        class="mt-2 w-full rounded-xl border border-slate-700 bg-[#070b26] px-4 py-3 text-white outline-none focus:border-cyan-400">
                        <option value="anime">anime</option>
                        <option value="vtuber">vtuber</option>
                        <option value="game">game</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300">Ukuran</label>
                    <input type="text" name="ukuran" value="{{ old('ukuran') }}" required
                        class="mt-2 w-full rounded-xl border border-slate-700 bg-[#070b26] px-4 py-3 text-white outline-none focus:border-cyan-400">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300">Harga Sewa</label>
                    <input type="number" name="harga_sewa" value="{{ old('harga_sewa') }}" required
                        class="mt-2 w-full rounded-xl border border-slate-700 bg-[#070b26] px-4 py-3 text-white outline-none focus:border-cyan-400">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300">Stok</label>
                    <input type="number" name="stok" value="{{ old('stok') }}" required
                        class="mt-2 w-full rounded-xl border border-slate-700 bg-[#070b26] px-4 py-3 text-white outline-none focus:border-cyan-400">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300">Foto Kostum</label>
                <div class="mt-2 rounded-2xl border border-dashed border-cyan-400/40 bg-[#070b26] p-6">
                    <input type="file" name="foto" accept="image/*"
                        class="w-full cursor-pointer rounded-xl bg-slate-900 px-4 py-3 text-slate-300
                        file:mr-4 file:cursor-pointer file:rounded-lg file:border-0
                        file:bg-pink-500 file:px-5 file:py-2 file:font-semibold file:text-white
                        hover:file:bg-pink-600">
                    <p class="mt-3 text-sm text-slate-400">
                        Pilih gambar dari folder kamu. Format disarankan: JPG, PNG, WEBP.
                    </p>
                </div>
            </div>

            <label class="flex items-center gap-3 rounded-xl bg-[#070b26] px-4 py-3">
                <input type="checkbox" name="tersedia" value="1" checked
                    class="h-5 w-5 rounded border-slate-600 bg-slate-900 text-pink-500">
                <span class="text-slate-300">Kostum tersedia</span>
            </label>

            <div class="flex gap-4">
                <a href="{{ route('costumes.index') }}"
                    class="w-1/2 rounded-xl border border-cyan-400 px-5 py-3 text-center font-semibold text-cyan-300 hover:bg-cyan-400 hover:text-slate-950">
                    Batal
                </a>

                <button type="submit"
                    class="w-1/2 rounded-xl bg-blue-600 px-5 py-3 font-bold text-white shadow-lg shadow-blue-600/30 hover:bg-blue-700">
                    Simpan Kostum
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
