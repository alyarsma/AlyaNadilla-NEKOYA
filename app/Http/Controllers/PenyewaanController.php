<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_wa' => 'required|string|max:30',
            'alamat' => 'required|string',
            'tanggal_ambil' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_ambil',
            'catatan' => 'nullable|string',
        ]);

        $items = session()->get('checkout_items', []);

        if (empty($items)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Tidak ada produk yang dipilih untuk checkout.');
        }

        $subtotal = collect($items)->sum('subtotal');
        $discount = session('voucher.discount', 0);
        $total = max($subtotal - $discount, 0);

        $penyewaan = Penyewaan::create([
            'user_id' => auth()->id(),
            'kode_penyewaan' => 'NEKOYA-' . date('YmdHis') . '-' . auth()->id(),

            'nama' => $request->nama,
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,

            'tanggal_ambil' => $request->tanggal_ambil,
            'tanggal_kembali' => $request->tanggal_kembali,

            'catatan' => $request->catatan,

            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'voucher_code' => session('voucher.code'),

            'metode_pembayaran' => null,
            'status_pembayaran' => 'pending',
            'status_penyewaan' => 'menunggu_pembayaran',
        ]);

        foreach ($items as $item) {
            $penyewaan->items()->create([
                'costume_id' => $item['costume_id'] ?? null,
                'nama_kostum' => $item['nama_kostum'],
                'foto' => $item['foto'] ?? null,
                'harga_sewa' => $item['harga_sewa'],
                'durasi' => $item['durasi'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        $cart = session()->get('cart', []);

foreach ($items as $id => $item) {
    unset($cart[$id]);
}

session()->put('cart', $cart);
session()->forget('checkout_items');
session()->forget('voucher');

return redirect()->route('payment.show', $penyewaan->id);
    }

    public function index()
    {
        $penyewaans = Penyewaan::with('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('penyewaan.index', compact('penyewaans'));
    }
}
