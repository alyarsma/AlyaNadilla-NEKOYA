@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-50 px-6 pt-24 pb-16 text-slate-900 dark:bg-slate-950 dark:text-white">
    <div class="mx-auto max-w-6xl rounded-3xl border border-cyan-400/30 bg-[#10162f] p-8">

        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-extrabold text-cyan-300">
                    Profil Admin
                </h1>
                <p class="mt-2 text-slate-400">
                    Kelola informasi akun administrator.
                </p>
            </div>

            <a href="{{ url('/dashboard') }}"
                class="rounded-xl border border-cyan-400 px-5 py-3 font-semibold text-cyan-300 transition hover:bg-cyan-400 hover:text-slate-950">
                ← Kembali
            </a>
        </div>

        <hr class="mb-10 border-slate-600/60">

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-green-500/20 px-4 py-3 text-green-300">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="grid gap-10 md:grid-cols-[350px_1fr]">

                {{-- FOTO PROFIL --}}
                <div>

                    <h2 class="mb-5 text-sm font-bold uppercase tracking-[0.25em] text-cyan-300">
                        Profile Picture
                    </h2>

                    <div class="rounded-2xl border border-cyan-400/30 bg-[#05081d] p-5">

                        @if(auth()->user()->foto_profil)
                            <img
                             id="preview-image"
                             src="{{ auth()->user()->foto_profil ? asset('storage/' . auth()->user()->foto_profil) : asset('image/default-avatar.png') }}"
                             alt="Profile Picture"
                             class="h-72 w-full rounded-2xl object-cover">
                        @else
                            <div class="flex h-72 w-full items-center justify-center rounded-2xl bg-slate-200 text-slate-500">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-28 w-28"
                                     viewBox="0 0 24 24"
                                     fill="currentColor">

                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4Zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4Z"/>

                                </svg>

                            </div>
                        @endif

                    </div>

                    <input
                        id="foto_profil"
                        type="file"
                        name="foto_profil"
                        accept="image/*"
                        class="mt-5 w-full cursor-pointer rounded-xl bg-slate-900 px-4 py-3 text-slate-300
                        file:mr-4 file:cursor-pointer file:rounded-xl file:border-0
                        file:bg-cyan-400 file:px-5 file:py-2 file:font-semibold file:text-slate-950
                        hover:file:bg-cyan-300">

                </div>

                {{-- DATA ADMIN --}}
                <div>

                    <div class="mb-7">
                        <label class="mb-3 block text-sm font-bold uppercase tracking-[0.25em] text-cyan-300">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            value="{{ auth()->user()->name }}"
                            readonly
                            class="w-full rounded-xl border border-cyan-400/20 bg-[#05081d] px-6 py-5 text-white outline-none">
                    </div>

                    <div class="mb-7">
                        <label class="mb-3 block text-sm font-bold uppercase tracking-[0.25em] text-cyan-300">
                            Email
                        </label>

                        <input
                            type="email"
                            value="{{ auth()->user()->email }}"
                            readonly
                            class="w-full rounded-xl border border-cyan-400/20 bg-[#05081d] px-6 py-5 text-white outline-none">
                    </div>

                    <div class="mb-7">
                        <label class="mb-3 block text-sm font-bold uppercase tracking-[0.25em] text-cyan-300">
                            No HP
                        </label>

                        <input
                            type="text"
                            name="no_hp"
                            value="{{ old('no_hp', auth()->user()->no_hp) }}"
                            placeholder="Masukkan nomor HP"
                            class="w-full rounded-xl border border-cyan-400/20 bg-[#05081d] px-6 py-5 text-white outline-none">
                    </div>

                    <div class="mt-10">
                        <button
                            type="submit"
                            class="rounded-xl bg-cyan-500 px-8 py-4 font-bold text-slate-950 transition hover:bg-cyan-400">

                            Simpan Perubahan

                        </button>
                    </div>

                </div>

            </div>

        </form>

    </div>
</section>
<script>
document.getElementById('foto_profil').addEventListener('change', function (e) {

    const file = e.target.files[0];

    if (!file) return;

    const reader = new FileReader();

    reader.onload = function(event) {
        document.getElementById('preview-image').src = event.target.result;
    };

    reader.readAsDataURL(file);
});
</script>
@endsection
