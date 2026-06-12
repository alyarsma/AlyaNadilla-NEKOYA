<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        (function () {
            const cookies = document.cookie.split("; ");
            let theme = localStorage.getItem("theme") || "system";
            let fontSize = localStorage.getItem("font_size") || "normal";

            cookies.forEach(function (cookie) {
                const parts = cookie.split("=");
                const key = parts[0];
                const value = decodeURIComponent(parts[1] || "");

                if (key === "theme") theme = value;
                if (key === "font_size") fontSize = value;
            });

            if (theme === "dark") {
                document.documentElement.classList.add("dark");
            } else if (theme === "light") {
                document.documentElement.classList.remove("dark");
            } else {
                const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
                document.documentElement.classList.toggle("dark", prefersDark);
            }

            document.documentElement.classList.remove("text-sm", "text-base", "text-lg");

            if (fontSize === "small") {
                document.documentElement.classList.add("text-sm");
            } else if (fontSize === "large") {
                document.documentElement.classList.add("text-lg");
            } else {
                document.documentElement.classList.add("text-base");
            }
        })();
    </script>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @php
        $manifestPath = public_path('build/manifest.json');
        $manifestExists = file_exists($manifestPath);
        $buildDir = config('vite.build_directory', 'build');
        $appEnv = app()->environment();
        \Illuminate\Support\Facades\Log::debug('[Vite Debug] manifest_path=' . $manifestPath . ' | exists=' . ($manifestExists ? 'true' : 'false') . ' | build_directory=' . $buildDir . ' | APP_ENV=' . $appEnv);
    @endphp
    {{-- Vite Debug (remove after fix): manifest={{ $manifestPath }} | exists={{ $manifestExists ? 'true' : 'false' }} | env={{ $appEnv }} --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-white">
    <div class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-white">
        @include('partials.navbar')

        @isset($header)
            <header class="bg-white shadow dark:bg-slate-900">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-white">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    <script>
        function setCookie(name, value, days = 30) {
            const date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);

            document.cookie =
                name + "=" + encodeURIComponent(value) +
                "; expires=" + date.toUTCString() +
                "; path=/";
        }

        function getCookie(name) {
            const cookies = document.cookie.split("; ");

            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i].split("=");

                if (cookie[0] === name) {
                    return decodeURIComponent(cookie[1] || "");
                }
            }

            return null;
        }

        function deleteCookie(name) {
            document.cookie =
                name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
        }

        window.setTheme = function (theme) {
            localStorage.setItem("theme", theme);
            setCookie("theme", theme, 30);

            if (theme === "dark") {
                document.documentElement.classList.add("dark");
            } else if (theme === "light") {
                document.documentElement.classList.remove("dark");
            } else {
                const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
                document.documentElement.classList.toggle("dark", prefersDark);
            }
        };

        window.setFontSize = function (fontSize) {
            localStorage.setItem("font_size", fontSize);
            setCookie("font_size", fontSize, 30);

            document.documentElement.classList.remove("text-sm", "text-base", "text-lg");

            if (fontSize === "small") {
                document.documentElement.classList.add("text-sm");
            } else if (fontSize === "large") {
                document.documentElement.classList.add("text-lg");
            } else {
                document.documentElement.classList.add("text-base");
            }
        };
    </script>

    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
