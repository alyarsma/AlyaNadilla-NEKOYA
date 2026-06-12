<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Debug: verify Vite manifest is accessible in production.
        // Remove this block once the CSS loading issue is resolved.
        $buildDir      = config('vite.build_directory', 'build');
        $manifestPath  = public_path($buildDir . '/manifest.json');
        $manifestExists = file_exists($manifestPath);

        Log::debug('[AppServiceProvider] Vite manifest check', [
            'APP_ENV'       => app()->environment(),
            'manifest_path' => $manifestPath,
            'exists'        => $manifestExists,
            'public_path'   => public_path(),
            'build_dir'     => $buildDir,
        ]);

        if (! $manifestExists) {
            Log::error('[AppServiceProvider] Vite manifest NOT FOUND at: ' . $manifestPath . '. CSS will not load in production.');
        }
    }
}

