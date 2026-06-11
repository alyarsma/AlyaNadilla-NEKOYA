<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costume;
use App\Models\Visit;

class DashboardController extends Controller
{
    public function index()
{
    $totalKostum = Costume::count();
    $totalStok = Costume::sum('stok');

    $stokMenipis = Costume::where('stok', '>', 0)
        ->where('stok', '<=', 1)
        ->count();

    $stokKosong = Costume::where('stok', 0)->count();

    $perluRestock = Costume::where('stok', '<=', 1)
        ->orderBy('stok', 'asc')
        ->get();

    // Statistik kunjungan website
    $totalKunjungan = Visit::count();

    $kunjunganPertama = Visit::oldest('visited_at')->first();

    $kunjunganTerakhir = Visit::latest('visited_at')->first();

    return view('dashboard', compact(
        'totalKostum',
        'totalStok',
        'stokMenipis',
        'stokKosong',
        'perluRestock',
        'totalKunjungan',
        'kunjunganPertama',
        'kunjunganTerakhir'
    ));
}

    public function dashboard(Request $request)
{
    $username = $request->input('username');

    return view('dashboard', compact('username'));
}

    public function prosesLogin(Request $request)
{
    $adminUsername = 'admin';
    $adminPassword = 'admin123';

    if ($request->username !== $adminUsername) {
        return back()
            ->withInput()
            ->with('username_error', 'Username yang anda masukkan salah');
    }

    if ($request->password !== $adminPassword) {
        return back()
            ->withInput()
            ->with('password_error', 'Password yang anda masukkan salah');
    }

    session([
        'is_admin' => true,
        'username' => $request->username,
    ]);

    return redirect('/dashboard?username=' . $request->username);
}

public function tentang()
{
    return view('tentang', [
        'totalCostume' => Costume::count()
    ]);
}

public function login()
{
    return view('login');
}

public function logout()
{
    session()->forget(['is_admin', 'username']);

    return redirect('/');
}

    public function profile(Request $request)
{
    $username = $request->input('username');

    return view('profile.edit', compact('username'));
}

    public function katalog()
{
    $costumes = Costume::all();

    return view('katalog', compact('costumes'));
}

public function kontak()
{
    return view('kontak');
}

}
