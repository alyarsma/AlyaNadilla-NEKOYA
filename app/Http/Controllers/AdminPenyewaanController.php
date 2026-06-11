<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;


class AdminPenyewaanController extends Controller
{
    public function index(Request $request)
{
    $query = Penyewaan::with(['items', 'user'])->latest();

    if ($request->status === 'perlu_konfirmasi') {
        $query->where('status_pembayaran', 'menunggu_verifikasi');
    }

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('kode_penyewaan', 'like', '%' . $request->search . '%')
              ->orWhere('nama', 'like', '%' . $request->search . '%')
              ->orWhere('no_wa', 'like', '%' . $request->search . '%');
        });
    }

    $penyewaans = $query->paginate(10);

    $semuaPenyewaan = Penyewaan::count();
    $perluKonfirmasi = Penyewaan::where('status_pembayaran', 'menunggu_verifikasi')->count();
    $penyewaanAktif = Penyewaan::whereIn('status_penyewaan', ['disetujui', 'sedang_disewa'])->count();

    return view('admin.penyewaan.index', compact(
        'penyewaans',
        'semuaPenyewaan',
        'perluKonfirmasi',
        'penyewaanAktif'
    ));
}

public function show(Penyewaan $penyewaan)
{
    $penyewaan->load(['items', 'user', 'histories']);

    return view('admin.penyewaan.show', compact('penyewaan'));
}

public function verifikasiPembayaran(Penyewaan $penyewaan)
{
    $penyewaan->update([
        'status_pembayaran' => 'dibayar',
        'status_penyewaan' => 'disetujui',
    ]);

    $penyewaan->histories()->create([
        'judul' => 'Pembayaran diverifikasi admin',
        'keterangan' => 'Pembayaran telah dikonfirmasi dan penyewaan disetujui.',
    ]);

    return back()->with('success', 'Pembayaran berhasil diverifikasi.');
}

public function updateStatus(Request $request, Penyewaan $penyewaan)
{
    $request->validate([
        'status_penyewaan' => 'required|in:menunggu_pembayaran,menunggu_konfirmasi,disetujui,sedang_disewa,selesai,dibatalkan',
    ]);

    $statusLama = $penyewaan->status_penyewaan;
$statusBaru = $request->status_penyewaan;

$penyewaan->update([
    'status_penyewaan' => $statusBaru,
]);

if ($statusLama !== $statusBaru) {
    $penyewaan->histories()->create([
        'judul' => 'Status penyewaan diperbarui',
        'keterangan' => 'Status berubah dari '
            . str_replace('_', ' ', $statusLama)
            . ' menjadi '
            . str_replace('_', ' ', $statusBaru)
            . '.',
    ]);
}

    return back()->with('success', 'Status penyewaan berhasil diperbarui.');
}

public function tolakPembayaran(
    Request $request,
    Penyewaan $penyewaan
)
{
    $request->validate([
        'catatan_admin' => 'required|string|max:500'
    ]);

    $penyewaan->update([
        'status_pembayaran' => 'ditolak',
        'status_penyewaan' => 'menunggu_pembayaran',
        'catatan_admin' => $request->catatan_admin,
    ]);

    $penyewaan->histories()->create([
        'judul' => 'Pembayaran ditolak admin',
        'keterangan' => $request->catatan_admin,
    ]);

    return back()->with(
        'success',
        'Pembayaran berhasil ditolak.'
    );
}
}
