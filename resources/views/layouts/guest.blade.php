<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NEKOYA') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

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
<body class="font-sans antialiased">
    {{ $slot }}
</body>
</html>
