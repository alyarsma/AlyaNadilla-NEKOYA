@extends('layouts.app')

@section('content')
<main class="min-h-screen bg-slate-950 px-6 py-12 text-white">
    <section class="mx-auto max-w-5xl rounded-3xl border border-cyan-400/20 bg-slate-900 p-8 shadow-2xl">

        <div class="mb-8 border-b border-slate-700 pb-6">
            <h1 class="text-3xl font-black text-cyan-300">My Account</h1>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-green-500/20 px-4 py-3 text-green-300">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pelanggan.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid gap-10 md:grid-cols-[280px_1fr]">
                <div>
                    <h2 class="mb-4 text-sm font-black uppercase tracking-widest text-cyan-200">
                        Profile Picture
                    </h2>

                    <div class="rounded-2xl border border-cyan-400/20 bg-slate-950 p-4">
                        @if(auth()->user()->foto_profil)
                            <img id="previewFoto"
                                 src="{{ asset('storage/' . auth()->user()->foto_profil) }}"
                                 class="h-56 w-full rounded-xl object-cover">
                        @else
                            <div id="defaultFoto"
                                 class="flex h-56 w-full items-center justify-center rounded-xl bg-slate-200 text-slate-500">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-24 w-24"
                                     viewBox="0 0 24 24"
                                     fill="currentColor">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4Zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4Z"/>
                                </svg>
                            </div>

                            <img id="previewFoto"
                                 src=""
                                 class="hidden h-56 w-full rounded-xl object-cover">
                        @endif
                    </div>

                    <input id="foto_profil"
                           type="file"
                           name="foto_profil"
                           accept="image/*"
                           class="mt-4 block w-full text-sm text-slate-300 file:mr-4 file:rounded-xl file:border-0 file:bg-cyan-400 file:px-4 file:py-2 file:font-bold file:text-slate-950 hover:file:bg-pink-400">

                    @error('foto_profil')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-5">
                    <div>
                        <label class="mb-2 block text-sm font-black uppercase tracking-widest text-cyan-200">
                            Nama Lengkap
                        </label>
                        <input type="text"
                               name="nama_lengkap"
                               value="{{ old('nama_lengkap', auth()->user()->nama_lengkap ?? auth()->user()->name) }}"
                               class="w-full rounded-xl border border-cyan-500/20 bg-slate-950 px-5 py-4 text-white outline-none focus:border-cyan-300">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-black uppercase tracking-widest text-cyan-200">
                            Email
                        </label>
                        <input type="email"
                               value="{{ auth()->user()->email }}"
                               readonly
                               class="w-full cursor-not-allowed rounded-xl border border-slate-700 bg-slate-800 px-5 py-4 text-slate-400 outline-none">
                        <p class="mt-2 text-xs text-slate-500">
                            Email tidak bisa diubah.
                        </p>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-black uppercase tracking-widest text-cyan-200">
                            No HP
                        </label>
                        <input type="text"
                               name="no_hp"
                               value="{{ old('no_hp', auth()->user()->no_hp) }}"
                               class="w-full rounded-xl border border-cyan-500/20 bg-slate-950 px-5 py-4 text-white outline-none focus:border-cyan-300">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-black uppercase tracking-widest text-cyan-200">
                            Alamat
                        </label>
                        <textarea name="alamat"
                                  rows="4"
                                  class="w-full rounded-xl border border-cyan-500/20 bg-slate-950 px-5 py-4 text-white outline-none focus:border-cyan-300">{{ old('alamat', auth()->user()->alamat) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-4 border-t border-slate-700 pt-6">
                        <a href="{{ url('/') }}"
                           class="rounded-xl bg-slate-700 px-6 py-3 font-bold text-white hover:bg-slate-600">
                            Cancel
                        </a>

                        <button type="submit"
                                class="rounded-xl bg-cyan-400 px-8 py-3 font-black text-slate-950 hover:bg-pink-400">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>

<script>
    const inputFoto = document.getElementById('foto_profil');
    const previewFoto = document.getElementById('previewFoto');
    const defaultFoto = document.getElementById('defaultFoto');

    inputFoto?.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            previewFoto.src = URL.createObjectURL(file);
            previewFoto.classList.remove('hidden');

            if (defaultFoto) {
                defaultFoto.classList.add('hidden');
            }
        }
    });
</script>
@endsection
