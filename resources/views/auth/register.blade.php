<x-guest-layout>
    <div class="grid min-h-screen lg:grid-cols-2">
        <div class="hidden bg-slate-950 p-10 text-white lg:flex lg:flex-col lg:justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{ asset('image/Logo Nekoya.png') }}" class="h-14 w-14 rounded-full object-cover">
                <div>
                    <h1 class="text-2xl font-extrabold tracking-[4px] text-cyan-300">NEKOYA</h1>
                    <p class="text-xs font-bold uppercase tracking-[3px] text-pink-300">Cosplay Rental</p>
                </div>
            </a>

            <div>
                <h2 class="mb-5 text-5xl font-black leading-tight">
                    Mulai sewa kostum favoritmu.
                </h2>
                <p class="max-w-md text-slate-300">
                    Buat akun pelanggan untuk menyimpan keranjang, checkout penyewaan, dan melihat riwayat pesanan.
                </p>
            </div>

            <p class="text-sm text-slate-500">© {{ date('Y') }} Nekoya</p>
        </div>

        <div class="flex min-h-screen items-center justify-center bg-slate-900 px-6 py-10 text-white">
            <div class="w-full max-w-md rounded-3xl border border-cyan-500/20 bg-slate-800/80 p-8 shadow-2xl">
                <div class="mb-8 text-center">
                    <img src="{{ asset('image/Logo Nekoya.png') }}" class="mx-auto mb-4 h-20 w-20 rounded-full object-cover lg:hidden">

                    <h2 class="text-3xl font-black">
                        Daftar <span class="text-pink-400">Pelanggan</span>
                    </h2>
                    <p class="mt-2 text-sm text-slate-400">
                        Gabung dulu sebelum mulai checkout kostum.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="mb-2 block text-sm font-bold text-cyan-200">
                            Nama
                        </label>
                        <input id="name"
                               type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               autofocus
                               autocomplete="name"
                               class="w-full rounded-2xl border border-cyan-500/20 bg-slate-900 px-5 py-4 text-white outline-none placeholder:text-slate-500 focus:border-cyan-300"
                               placeholder="Masukkan nama kamu">

                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-bold text-cyan-200">
                            Email
                        </label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autocomplete="username"
                               class="w-full rounded-2xl border border-cyan-500/20 bg-slate-900 px-5 py-4 text-white outline-none placeholder:text-slate-500 focus:border-cyan-300"
                               placeholder="contoh@email.com">

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-bold text-cyan-200">
                            Password
                        </label>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               autocomplete="new-password"
                               class="w-full rounded-2xl border border-cyan-500/20 bg-slate-900 px-5 py-4 text-white outline-none placeholder:text-slate-500 focus:border-cyan-300"
                               placeholder="Minimal 8 karakter">

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-bold text-cyan-200">
                            Konfirmasi Password
                        </label>
                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               required
                               autocomplete="new-password"
                               class="w-full rounded-2xl border border-cyan-500/20 bg-slate-900 px-5 py-4 text-white outline-none placeholder:text-slate-500 focus:border-cyan-300"
                               placeholder="Ulangi password">

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit"
                            class="w-full rounded-2xl bg-pink-500 px-5 py-4 font-black uppercase tracking-[2px] text-white transition hover:bg-pink-600">
                        Daftar Sekarang
                    </button>

                    <p class="text-center text-sm text-slate-400">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-bold text-cyan-300 hover:text-cyan-200">
                            Login di sini
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
