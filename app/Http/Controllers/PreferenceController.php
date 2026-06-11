<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PreferenceController extends Controller
{
    public function index()
    {
        return view('preferensi');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'theme' => 'required|in:light,dark,system',
            'font_size' => 'required|in:small,normal,large',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Preferensi berhasil disimpan.',
            'data' => $validated,
        ])
        ->cookie('theme', $validated['theme'], 60 * 24 * 30)
        ->cookie('font_size', $validated['font_size'], 60 * 24 * 30);
    }

    public function read(Request $request)
{
    $theme = $request->cookie('theme', 'system');
    $fontSize = $request->cookie('font_size', 'normal');

    return response()->json([
        'success' => true,
        'message' => 'Cookie preferensi berhasil dibaca.',
        'data' => [
            'theme' => $theme,
            'font_size' => $fontSize,
        ],
    ]);
}
}
