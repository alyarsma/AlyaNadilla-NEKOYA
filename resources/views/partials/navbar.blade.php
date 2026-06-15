<nav class="sticky top-0 z-50 bg-white text-slate-900 shadow-lg dark:bg-[#0b1020] dark:text-white">
  <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4">

    <a href="{{ url('/') }}" class="flex items-center gap-3">
      <img src="{{ asset('image/Logo Nekoya.png') }}" class="h-12 w-12 rounded-full object-cover">

      <div class="leading-tight">
        <div class="text-xl font-extrabold tracking-[3px] text-slate-900 dark:text-white">NEKOYA</div>
        <div class="text-[11px] font-bold uppercase tracking-[2px] text-blue-500 dark:text-cyan-300">
          Cosplay Rental
        </div>
      </div>
    </a>

    <ul class="hidden items-center gap-8 font-semibold md:flex">

      @auth
        @if(auth()->user()->email === 'admin@example.com' || auth()->user()->name === 'Admin' || auth()->user()->name === 'admin')
          <li>
            <a href="{{ url('/dashboard') }}"
               class="{{ request()->is('dashboard') ? 'text-blue-600 dark:text-cyan-400' : 'text-slate-900 dark:text-white' }} hover:text-blue-600 dark:hover:text-cyan-400">
              Beranda
            </a>
          </li>

          <li>
            <a href="{{ url('/costumes') }}"
               class="{{ request()->is('costumes') ? 'text-blue-600 dark:text-cyan-400' : 'text-slate-900 dark:text-white' }} hover:text-blue-600 dark:hover:text-cyan-400">
              Manajemen Costumes
            </a>
          </li>

          <li>
            <a href="{{ route('admin.penyewaan.index') }}"
               class="{{ request()->routeIs('admin.penyewaan.*') ? 'text-blue-600 dark:text-cyan-400' : 'text-slate-900 dark:text-white' }} hover:text-blue-600 dark:hover:text-cyan-400">
              Daftar Sewa
            </a>
          </li>

          <li>
            <a href="{{ url('/tentang') }}"
               class="{{ request()->is('tentang') ? 'text-blue-600 dark:text-cyan-400' : 'text-slate-900 dark:text-white' }} hover:text-blue-600 dark:hover:text-cyan-400">
              Tentang
            </a>
          </li>

          <li>
            <a href="{{ url('/kontak') }}"
               class="{{ request()->is('kontak') ? 'text-blue-600 dark:text-cyan-400' : 'text-slate-900 dark:text-white' }} hover:text-blue-600 dark:hover:text-cyan-400">
              Kontak
            </a>
          </li>
        @else
          <li>
            <a href="{{ url('/dashboard') }}"
               class="{{ request()->is('dashboard') ? 'text-blue-600 dark:text-cyan-400' : 'text-slate-900 dark:text-white' }} hover:text-blue-600 dark:hover:text-cyan-400">
              Beranda
            </a>
          </li>

          <li>
            <a href="{{ route('katalog') }}"
               class="{{ request()->is('katalog') ? 'text-blue-600 dark:text-cyan-400' : 'text-slate-900 dark:text-white' }} hover:text-blue-600 dark:hover:text-cyan-400">
              Katalog
            </a>
          </li>

          <li>
            <a href="{{ route('penyewaan.index') }}"
               class="{{ request()->routeIs('penyewaan.*') ? 'text-blue-600 dark:text-cyan-400' : 'text-slate-900 dark:text-white' }} hover:text-blue-600 dark:hover:text-cyan-400">
              Penyewaan
            </a>
          </li>

          <li>
            <a href="{{ url('/tentang') }}"
               class="{{ request()->is('tentang') ? 'text-blue-600 dark:text-cyan-400' : 'text-slate-900 dark:text-white' }} hover:text-blue-600 dark:hover:text-cyan-400">
              Tentang
            </a>
          </li>

          <li>
            <a href="{{ url('/kontak') }}"
               class="{{ request()->is('kontak') ? 'text-blue-600 dark:text-cyan-400' : 'text-slate-900 dark:text-white' }} hover:text-blue-600 dark:hover:text-cyan-400">
              Kontak
            </a>
          </li>

          <li>
            <a href="{{ route('cart.index') }}" class="relative text-xl">
              <svg xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         stroke-width="2.5"
         stroke-linecap="round"
         stroke-linejoin="round"
         class="h-8 w-8 text-slate-800 dark:text-white">

        <circle cx="9" cy="21" r="1"></circle>
        <circle cx="20" cy="21" r="1"></circle>
        <path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6"></path>
    </svg>

              @if(session('cart') && count(session('cart')) > 0)
                <span class="absolute -right-2 -top-2 rounded-full bg-blue-600 px-2 text-xs font-bold text-white">
                  {{ count(session('cart')) }}
                </span>
              @endif
            </a>
          </li>
        @endif

        {{-- TOGGLE THEME DESKTOP --}}
        <li>
          <button id="theme-toggle-desktop" type="button"
                  class="flex h-10 w-10 items-center justify-center rounded-full border border-blue-500/40 bg-slate-100 text-slate-900 hover:bg-blue-100 dark:bg-slate-800 dark:text-white dark:hover:bg-slate-700">
            <span class="dark:hidden">🌙</span>
            <span class="hidden dark:inline">☀️</span>
          </button>
        </li>

        <li class="relative">
          <button id="profile-btn-desktop" type="button">
            @if(auth()->user()->foto_profil)
              <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}"
                   class="h-11 w-11 rounded-full border-2 border-blue-500 object-cover dark:border-cyan-400">
            @else
              <div class="flex h-11 w-11 items-center justify-center rounded-full border-2 border-blue-500 bg-slate-200 text-slate-500 dark:border-cyan-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4Zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4Z"/>
                </svg>
              </div>
            @endif
          </button>
        </li>
      @else
        <li><a href="{{ url('/') }}" class="hover:text-blue-600 dark:hover:text-cyan-400">Beranda</a></li>
        <li><a href="{{ route('katalog') }}" class="hover:text-blue-600 dark:hover:text-cyan-400">Katalog</a></li>
        <li><a href="{{ url('/tentang') }}" class="hover:text-blue-600 dark:hover:text-cyan-400">Tentang</a></li>
        <li><a href="{{ url('/kontak') }}" class="hover:text-blue-600 dark:hover:text-cyan-400">Kontak</a></li>

        <li>
          <button id="theme-toggle-desktop" type="button"
                  class="flex h-10 w-10 items-center justify-center rounded-full border border-blue-500/40 bg-slate-100 text-slate-900 hover:bg-blue-100 dark:bg-slate-800 dark:text-white dark:hover:bg-slate-700">
            <span class="dark:hidden">🌙</span>
            <span class="hidden dark:inline">☀️</span>
          </button>
        </li>

        <li>
          <a href="{{ route('login') }}" class="rounded-lg bg-blue-600 px-5 py-3 text-white hover:bg-blue-700">
            Login
          </a>
        </li>
      @endauth
    </ul>

    <div class="flex items-center gap-4 md:hidden">

      <button id="theme-toggle-mobile" type="button"
              class="flex h-10 w-10 items-center justify-center rounded-full border border-blue-500/40 bg-slate-100 text-slate-900 hover:bg-blue-100 dark:bg-slate-800 dark:text-white dark:hover:bg-slate-700">
        <span class="dark:hidden">🌙</span>
        <span class="hidden dark:inline">☀️</span>
      </button>

      @auth
        @if(!(auth()->user()->email === 'admin@example.com' || auth()->user()->name === 'Admin' || auth()->user()->name === 'admin'))
          <a href="{{ route('cart.index') }}" class="text-2xl">🛒</a>
        @endif

        <button id="profile-btn-mobile" type="button">
          @if(auth()->user()->foto_profil)
            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}"
                 class="h-10 w-10 rounded-full border-2 border-blue-500 object-cover dark:border-cyan-400">
          @else
            <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-blue-500 bg-slate-200 text-slate-500 dark:border-cyan-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4Zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4Z"/>
              </svg>
            </div>
          @endif
        </button>
      @endauth

      <button id="menu-btn" type="button" class="text-4xl text-blue-600 dark:text-cyan-400">
        ☰
      </button>
    </div>

    @auth
      <div id="profile-menu"
           class="fixed right-4 top-20 z-50 hidden w-52 rounded-xl border border-blue-500/20 bg-white p-3 text-slate-900 shadow-lg dark:bg-[#0b1635] dark:text-white">

        <div class="mb-2 border-b border-slate-200 px-4 py-2 dark:border-white/10">
          <p class="text-sm text-slate-500 dark:text-slate-400">Login sebagai</p>
          <p class="font-bold text-blue-600 dark:text-cyan-300">{{ auth()->user()->name }}</p>
        </div>

        @if(auth()->user()->email === 'admin@example.com' || auth()->user()->name === 'Admin' || auth()->user()->name === 'admin')
          <a href="{{ route('admin.profile') }}" class="block rounded-lg px-4 py-2 hover:bg-blue-50 dark:hover:bg-white/10">
            Profil Admin
          </a>

          <a href="{{ route('preferensi') }}" class="block rounded-lg px-4 py-2 hover:bg-blue-50 dark:hover:bg-white/10">
            Preferensi
          </a>
        @else
          <a href="{{ route('pelanggan.profile') }}" class="block rounded-lg px-4 py-2 hover:bg-blue-50 dark:hover:bg-white/10">
            Profil
          </a>

          <a href="{{ route('preferensi') }}" class="block rounded-lg px-4 py-2 hover:bg-blue-50 dark:hover:bg-white/10">
            Preferensi
          </a>
        @endif

        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="w-full rounded-lg px-4 py-2 text-left text-blue-600 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-white/10">
            Logout
          </button>
        </form>
      </div>
    @endauth
  </div>

  <ul id="menu"
      class="fixed left-0 top-20 z-40 hidden w-full flex-col gap-4 bg-white px-6 py-4 font-semibold text-slate-900 shadow-lg dark:bg-[#080b28] dark:text-white md:hidden">

    @auth
      @if(auth()->user()->email === 'admin@example.com' || auth()->user()->name === 'Admin' || auth()->user()->name === 'admin')
        <li><a href="{{ url('/dashboard') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Dashboard</a></li>
        <li><a href="{{ url('/costumes') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Costume</a></li>
        <li><a href="{{ route('admin.penyewaan.index') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Daftar Sewa</a></li>
        <li><a href="{{ route('costumes.create') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Tambah Produk</a></li>
        <li><a href="{{ url('/tentang') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Tentang</a></li>
        <li><a href="{{ url('/kontak') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Kontak</a></li>
      @else
        <li><a href="{{ url('/') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Beranda</a></li>
        <li><a href="{{ route('katalog') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Katalog</a></li>
        <li><a href="{{ route('penyewaan.index') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Penyewaan</a></li>
        <li><a href="{{ url('/tentang') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Tentang</a></li>
        <li><a href="{{ url('/kontak') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Kontak</a></li>
        <li><a href="{{ route('cart.index') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">🛒 Cart</a></li>
        <li><a href="{{ route('pelanggan.profile') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Profil</a></li>
        <li><a href="{{ route('preferensi') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Preferensi</a></li>
      @endif

      <li class="py-3 text-blue-600 dark:text-cyan-300">
        Login sebagai {{ auth()->user()->name }}
      </li>

      <li>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit"
                  class="block w-full rounded-lg bg-blue-600 px-5 py-3 text-left text-white hover:bg-blue-700">
            Logout
          </button>
        </form>
      </li>
    @else
      <li><a href="{{ url('/') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Beranda</a></li>
      <li><a href="{{ route('katalog') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Katalog</a></li>
      <li><a href="{{ url('/tentang') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Tentang</a></li>
      <li><a href="{{ url('/kontak') }}" class="block py-3 hover:text-blue-600 dark:hover:text-cyan-400">Kontak</a></li>
      <li>
        <a href="{{ route('login') }}"
           class="block rounded-lg bg-blue-600 px-5 py-3 text-white hover:bg-blue-700">
          Login
        </a>
      </li>
    @endauth
  </ul>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');

    const profileBtnDesktop = document.getElementById('profile-btn-desktop');
    const profileBtnMobile = document.getElementById('profile-btn-mobile');
    const profileMenu = document.getElementById('profile-menu');

    const themeToggleDesktop = document.getElementById('theme-toggle-desktop');
    const themeToggleMobile = document.getElementById('theme-toggle-mobile');

    function toggleTheme() {
  const isDark = document.documentElement.classList.contains('dark');

  if (window.setTheme) {
    window.setTheme(isDark ? 'light' : 'dark');
  }
}

    if (themeToggleDesktop) {
      themeToggleDesktop.addEventListener('click', function (event) {
        event.stopPropagation();
        toggleTheme();
      });
    }

    if (themeToggleMobile) {
      themeToggleMobile.addEventListener('click', function (event) {
        event.stopPropagation();
        toggleTheme();
      });
    }

    if (menuBtn && menu) {
      menuBtn.addEventListener('click', function (event) {
        event.stopPropagation();

        menu.classList.toggle('hidden');
        menu.classList.toggle('flex');

        if (profileMenu) {
          profileMenu.classList.add('hidden');
        }
      });
    }

    if (profileBtnDesktop && profileMenu) {
      profileBtnDesktop.addEventListener('click', function (event) {
        event.stopPropagation();

        profileMenu.classList.toggle('hidden');

        if (menu) {
          menu.classList.add('hidden');
          menu.classList.remove('flex');
        }
      });
    }

    if (profileBtnMobile && profileMenu) {
      profileBtnMobile.addEventListener('click', function (event) {
        event.stopPropagation();

        profileMenu.classList.toggle('hidden');

        if (menu) {
          menu.classList.add('hidden');
          menu.classList.remove('flex');
        }
      });
    }

    document.addEventListener('click', function (event) {
      if (menu && menuBtn && !menu.contains(event.target) && !menuBtn.contains(event.target)) {
        menu.classList.add('hidden');
        menu.classList.remove('flex');
      }

      if (
        profileMenu &&
        !profileMenu.contains(event.target) &&
        (!profileBtnDesktop || !profileBtnDesktop.contains(event.target)) &&
        (!profileBtnMobile || !profileBtnMobile.contains(event.target))
      ) {
        profileMenu.classList.add('hidden');
      }
    });
  });
</script>
