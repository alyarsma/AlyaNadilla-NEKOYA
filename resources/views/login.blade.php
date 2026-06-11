@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 px-4 pt-28 pb-16 text-slate-900 dark:bg-slate-900 dark:text-white">

  <div class="w-full max-w-md rounded-2xl border border-blue-200 bg-white p-8 shadow-lg dark:border-blue-500/20 dark:bg-[#0b1635]">

    <div class="text-center">
      <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
        Welcome Back
      </h1>

      <p class="mt-3 text-slate-600 dark:text-slate-300">
        Login ke akun Nekoya kamu
      </p>
    </div>

    @if(session('error'))
      <div class="mt-5 rounded-lg bg-red-500/10 p-3 text-center text-sm text-red-500 dark:text-red-400">
        {{ session('error') }}
      </div>
    @endif

    @if(session('success'))
      <div class="mt-5 rounded-lg bg-green-500/10 p-3 text-center text-sm text-green-600 dark:text-green-300">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ url('/login') }}" method="POST" class="mt-8 space-y-6">
      @csrf

      <div>
        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">
          Email / Username
        </label>

        <input
          type="text"
          name="email"
          required
          value="{{ old('email') }}"
          placeholder="Masukkan email atau username"
          class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-5 py-3 text-slate-900 outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-slate-600 dark:bg-[#070b26] dark:text-white dark:focus:border-cyan-400 dark:focus:ring-cyan-400"
        >

        @if(session('username_error'))
          <p class="mt-2 text-sm text-red-500 dark:text-red-400">
            {{ session('username_error') }}
          </p>
        @endif
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">
          Password
        </label>

        <div class="relative mt-2">
          <input
            type="password"
            name="password"
            id="password"
            required
            placeholder="Masukkan password"
            class="w-full rounded-lg border border-slate-300 bg-white px-5 py-3 pr-12 text-slate-900 outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-slate-600 dark:bg-[#070b26] dark:text-white dark:focus:border-cyan-400 dark:focus:ring-cyan-400"
          >

          <button
            type="button"
            id="togglePassword"
            class="absolute right-4 top-1/2 -translate-y-1/2 cursor-pointer text-slate-500 hover:text-blue-600 dark:text-slate-400 dark:hover:text-cyan-400"
          >
            <svg
              id="eyeIcon"
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
          </button>
        </div>

        @if(session('password_error'))
          <p class="mt-2 text-sm text-red-500 dark:text-red-400">
            {{ session('password_error') }}
          </p>
        @endif
      </div>

      <button
        type="submit"
        class="w-full rounded-lg bg-blue-600 py-3 font-semibold text-white transition hover:bg-blue-700"
      >
        Log In
      </button>
    </form>

    <p class="mt-6 text-center text-slate-600 dark:text-slate-300">
      Belum punya akun?
      <a href="{{ url('/register') }}" class="text-blue-600 hover:underline dark:text-cyan-400">
        Daftar
      </a>
    </p>

  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (togglePassword && password && eyeIcon) {
        togglePassword.addEventListener('click', function () {
            const isPassword = password.type === 'password';

            password.type = isPassword ? 'text' : 'password';

            if (isPassword) {
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95M6.228 6.228A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.293 5.018M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m3-3l7 7m-7-7L5 19" />
                `;
            } else {
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        });
    }
});
</script>
@endsection
