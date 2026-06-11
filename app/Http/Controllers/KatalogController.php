<?php

namespace App\Http\Controllers;

use App\Models\Costume;

class KatalogController extends Controller
{
    public function index()
    {
        $costumes = Costume::latest()->get();

        return view('katalog', compact('costumes'));
    }

    public function show(Costume $costume)
    {
        $recommendations = Costume::where('id', '!=', $costume->id)
            ->where('tersedia', true)
            ->latest()
            ->take(4)
            ->get();

        return view('katalog-detail', compact('costume', 'recommendations'));
    }
}
