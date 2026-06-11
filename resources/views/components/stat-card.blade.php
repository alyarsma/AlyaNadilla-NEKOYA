<div class="rounded-2xl border border-blue-500/30 bg-[#1b2940] p-6 shadow-lg hover:scale-105 transition">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold text-cyan-300">
                {{ $judul ?? 'Judul' }}
            </p>

            <h2 class="mt-3 text-4xl font-extrabold text-white">
                {{ $nilai ?? 0 }}
            </h2>
        </div>

        <div class="flex h-14 w-14 items-center justify-center rounded-xl text-3xl"
             style="background-color: {{ $warna ?? '#2563eb' }}33">
            {{ $icon ?? '📦' }}
        </div>
    </div>
</div>
