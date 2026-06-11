<?php

namespace App\Http\Controllers;

use App\Models\Costume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CostumeController extends Controller
{
    public function index()
{
    $costumes = Costume::paginate(10);

    return view('costumes.index', compact('costumes'));
}

   public function create()
{
    return view('tambahproduk');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'kode_kostum' => 'required|unique:costumes,kode_kostum',
        'nama_kostum' => 'required|min:3',
        'kategori' => 'required|in:Anime,Game,Movie,Original',
        'ukuran' => 'required|in:S,M,L,XL',
        'harga_sewa' => 'required|numeric|min:0',
        'stok' => 'required|integer|min:0',
        'foto' => 'nullable|image|mimes:jpg,png|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('costumes', 'public');
    }

    $validated['user_id'] = auth()->id();

    $costume = Costume::create($validated);

if ($request->ajax()) {
    return response()->json([
        'success' => true,
        'message' => 'Data costume berhasil ditambahkan.',
        'data' => $costume
    ]);
}

return redirect()->route('costumes.index')
    ->with('success', 'Data costume berhasil ditambahkan.');
}

    public function edit(Costume $costume)
{
    return view('costumes.edit', compact('costume'));
}

public function update(Request $request, Costume $costume)
{
    $validated = $request->validate([
        'kode_kostum' => 'required',
        'nama_kostum' => 'required',
        'kategori' => 'required',
        'ukuran' => 'required',
        'harga_sewa' => 'required|numeric',
        'stok' => 'required|numeric',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('costumes', 'public');
    }

    $costume->update($validated);

    return redirect()
        ->route('costumes.index')
        ->with('success', 'Costume berhasil diperbarui.');
}

    public function destroy(Costume $costume)
{
    $costume->delete();

    return redirect()->route('costumes.index')
        ->with('success', 'Data costume berhasil dihapus.');
}

public function liveSearch(Request $request)
{
    $keyword = $request->get('keyword');

    $costumes = Costume::query()
        ->where('nama_kostum', 'like', "%{$keyword}%")
        ->orWhere('kode_kostum', 'like', "%{$keyword}%")
        ->orWhere('kategori', 'like', "%{$keyword}%")
        ->orWhere('ukuran', 'like', "%{$keyword}%")
        ->latest()
        ->get();

    return response()->json($costumes);
}
}
