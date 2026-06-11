@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden bg-slate-50 text-slate-900 dark:bg-[#020617] dark:text-white">

  <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-slate-100 opacity-80 dark:from-blue-900 dark:via-indigo-900 dark:to-slate-950"></div>
  <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 via-transparent to-cyan-500/10 dark:from-cyan-500/20 dark:to-pink-500/20"></div>

  <div class="absolute -top-40 -left-40 h-96 w-96 rounded-full bg-blue-500/10 blur-3xl dark:bg-cyan-500/20"></div>
  <div class="absolute bottom-0 right-0 h-96 w-96 rounded-full bg-blue-500/10 blur-3xl dark:bg-pink-500/20"></div>

  <div class="relative z-10 px-6 py-28">
    <div class="mx-auto max-w-7xl">

      <div class="mb-14 text-center">
        <p class="mb-4 text-sm font-semibold uppercase tracking-widest text-blue-600 dark:text-cyan-300">
          About Nekoya
        </p>

        <h1 class="text-4xl font-extrabold md:text-6xl">
          Tentang <span class="text-blue-600 dark:text-pink-400">Nekoya</span>
        </h1>

        <p class="mx-auto mt-6 max-w-3xl text-lg leading-relaxed text-slate-600 dark:text-slate-300">
          Nekoya adalah platform rental kostum cosplay untuk kamu yang ingin tampil
          maksimal di event, photoshoot, cosplay gathering, atau kebutuhan konten.
        </p>
      </div>

      <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
        <div class="rounded-2xl border border-blue-200 bg-white p-8 shadow-lg dark:border-blue-500/30 dark:bg-[#1b2940]/80">
          <h2 class="mb-4 text-2xl font-bold text-blue-600 dark:text-cyan-300">Siapa Kami?</h2>
          <p class="leading-relaxed text-slate-600 dark:text-slate-300">
            Kami menyediakan berbagai kostum anime, game, Vtuber, dan aksesoris
            dengan kualitas terbaik, harga terjangkau, dan proses sewa yang mudah.
          </p>
        </div>

        <div class="rounded-2xl border border-blue-200 bg-white p-8 shadow-lg dark:border-blue-500/30 dark:bg-[#1b2940]/80">
          <h2 class="mb-4 text-2xl font-bold text-blue-600 dark:text-cyan-300">Misi Kami</h2>
          <p class="leading-relaxed text-slate-600 dark:text-slate-300">
            Membantu cosplayer, kreator konten, dan penggemar karakter favorit
            agar bisa tampil percaya diri tanpa harus membeli kostum mahal.
          </p>
        </div>
      </div>

      <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">

        <div class="rounded-2xl border border-blue-200 bg-white p-6 text-center shadow dark:border-cyan-500/30 dark:bg-slate-900/80">
          <div class="mb-4 text-4xl">🎭</div>
          <h3 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Kostum Lengkap</h3>
          <p class="text-sm text-slate-600 dark:text-slate-400">
            Pilihan kostum anime, game, Vtuber, dan karakter populer lainnya.
          </p>
        </div>

        <div class="rounded-2xl border border-blue-200 bg-white p-6 text-center shadow dark:border-cyan-500/30 dark:bg-slate-900/80">
          <div class="mb-4 text-4xl">✨</div>
          <h3 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Kualitas Terjaga</h3>
          <p class="text-sm text-slate-600 dark:text-slate-400">
            Kostum dirawat dengan baik agar nyaman dan siap digunakan.
          </p>
        </div>

        <div class="rounded-2xl border border-blue-200 bg-white p-6 text-center shadow dark:border-cyan-500/30 dark:bg-slate-900/80">
          <div class="mb-4 text-4xl">🚚</div>
          <h3 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Sewa Mudah</h3>
          <p class="text-sm text-slate-600 dark:text-slate-400">
            Pilih kostum → hubungi admin → bayar → siap dipakai.
          </p>
        </div>

      </div>

    </div>
  </div>
</section>
@endsection
