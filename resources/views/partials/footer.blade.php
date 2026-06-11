<footer class="rounded-3xl border border-pink-400/20 bg-white p-6 shadow dark:bg-slate-900">
    <div class="mx-auto max-w-7xl">

        <div class="grid gap-10 border-b border-white/10 pb-10 md:grid-cols-5">

            <div class="md:col-span-2">
                <div class="flex items-center gap-3">
                    <img
                        src="{{ asset('image/Logo Nekoya.png') }}"
                        alt="Nekoya"
                        class="h-11 w-11 rounded-full object-cover"
                    >

                    <div>
                        <h3 class="text-lg font-extrabold tracking-[3px]">
                            NEKOYA
                        </h3>
                        <p class="text-xs font-bold uppercase tracking-[2px] text-cyan-300">
                            Cosplay Rental
                        </p>
                    </div>
                </div>

                <p class="mt-4 max-w-sm text-sm leading-relaxed text-slate-400">
                    Nekoya menyediakan rental kostum anime, Vtuber, dan karakter game
                    untuk event, photoshoot, cosplay gathering, dan kebutuhan kontenmu.
                </p>
            </div>

            <div>
                <h4 class="mb-4 font-bold text-white">Quick Links</h4>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li><a href="{{ url('/') }}" class="hover:text-cyan-300">Beranda</a></li>
                    <li><a href="{{ url('/katalog') }}" class="hover:text-cyan-300">Katalog</a></li>
                    <li><a href="{{ url('/kontak') }}" class="hover:text-cyan-300">Kontak</a></li>
                    <li><a href="#" class="hover:text-cyan-300">FAQ</a></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-4 font-bold text-white">Support</h4>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li><a href="#" class="hover:text-cyan-300">Help Center</a></li>
                    <li><a href="#" class="hover:text-cyan-300">Terms & Condition</a></li>
                    <li><a href="#" class="hover:text-cyan-300">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-cyan-300">Booking Guide</a></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-4 font-bold text-white">Service</h4>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li><a href="#" class="hover:text-cyan-300">Anime Cosplay</a></li>
                    <li><a href="#" class="hover:text-cyan-300">Vtuber Outfit</a></li>
                    <li><a href="#" class="hover:text-cyan-300">Game Costume</a></li>
                    <li><a href="#" class="hover:text-cyan-300">Accessories</a></li>
                </ul>
            </div>

        </div>

        <div class="flex flex-col items-center justify-between gap-4 pt-6 text-sm text-slate-400 md:flex-row">
            <p>
                © 2026 Copyright, designed by
                <span class="text-white">Nekoya Cosplay Rental</span>. All rights reserved.
            </p>

            <div class="flex items-center gap-5">

    <a href="https://instagram.com" target="_blank"
       class="transition hover:scale-110">
        <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png"
             class="h-5 w-5">
    </a>

    <a href="https://tiktok.com" target="_blank"
       class="transition hover:scale-110">
        <img src="https://cdn-icons-png.flaticon.com/512/3046/3046121.png"
             class="h-5 w-5">
    </a>

    <a href="https://discord.com" target="_blank"
       class="transition hover:scale-110">
        <img src="https://cdn-icons-png.flaticon.com/512/5968/5968756.png"
             class="h-5 w-5">
    </a>

</div>
        </div>

    </div>
</footer>
