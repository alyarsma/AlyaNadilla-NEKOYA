<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('visit_recorded')) {
            Visit::create([
                'ip_address' => $request->ip(),
                'page' => $request->path(),
                'visited_at' => now(),
            ]);

            session()->put('visit_recorded', true);
        }

        return $next($request);
    }
}
