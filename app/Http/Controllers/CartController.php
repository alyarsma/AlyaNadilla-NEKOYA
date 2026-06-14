<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costume;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'costume_id' => 'required|exists:costumes,id',
            'tanggal_mulai' => 'required|date',
            'durasi' => 'required|integer|min:1',
        ]);

        $costume = Costume::findOrFail($request->costume_id);

        $cart = session()->get('cart', []);

        $cart[$costume->id] = [
            'costume_id' => $costume->id,
            'nama_kostum' => $costume->nama_kostum,
            'foto' => $costume->foto,
            'harga_sewa' => $costume->harga_sewa,
            'tanggal_mulai' => $request->tanggal_mulai,
            'durasi' => $request->durasi,
            'subtotal' => $costume->harga_sewa * $request->durasi,
        ];

        session()->put('cart', $cart);

return back()->with('success', 'Produk berhasil dimasukkan ke keranjang.');
    }

    public function index()
{
    $cart = session()->get('cart', []);

    return view('cart', compact('cart'));
}

public function directCheckout(Request $request)
{
    $request->validate([
        'costume_id' => 'required|exists:costumes,id',
        'tanggal_mulai' => 'required|date',
        'durasi' => 'required|integer|min:1',
    ]);

    $costume = Costume::findOrFail($request->costume_id);

    $item = [
        $costume->id => [
            'costume_id' => $costume->id,
            'nama_kostum' => $costume->nama_kostum,
            'foto' => $costume->foto,
            'harga_sewa' => $costume->harga_sewa,
            'tanggal_mulai' => $request->tanggal_mulai,
            'durasi' => $request->durasi,
            'subtotal' => $costume->harga_sewa * $request->durasi,
        ]
    ];

    session()->put('checkout_items', $item);

    return redirect()->route('checkout.index');
}

public function prepareCheckout(Request $request)
{
    $request->validate([
        'selected_items' => 'required|array',
        'selected_items.*' => 'required',
    ]);

    $cart = session()->get('cart', []);

    $selectedItems = collect($cart)
        ->only($request->selected_items)
        ->toArray();

    if (empty($selectedItems)) {
        return back()->with('success', 'Pilih minimal satu produk untuk checkout.');
    }

    session()->put('checkout_items', $selectedItems);

    return redirect()->route('checkout.index');
}

public function checkout()
{
    $items = session()->get('checkout_items', []);

    if (empty($items)) {
        return redirect()
            ->route('cart.index')
            ->with('success', 'Pilih produk terlebih dahulu sebelum checkout.');
    }

    return view('checkout', [
        'items' => $items,
    ]);
}

public function cancelCheckout()
{
    session()->forget('checkout_items');

    return redirect()->route('cart.index')->with('success', 'Pesanan berhasil dibatalkan.');
}

public function applyVoucher(Request $request)
{
    $request->validate([
        'voucher_code' => 'required|string',
    ]);

    $code = strtoupper(trim($request->voucher_code));

    $cart = session()->get('cart', []);
    $subtotal = collect($cart)->sum('subtotal');

    $vouchers = [
        'NEKOYA10' => [
            'type' => 'percent',
            'value' => 10,
            'label' => 'Diskon 10%',
            'min_order' => 0,
        ],
        'COSPLAY20' => [
            'type' => 'percent',
            'value' => 20,
            'label' => 'Diskon 20%',
            'min_order' => 100000,
        ],
        'HEMAT50000' => [
            'type' => 'fixed',
            'value' => 50000,
            'label' => 'Potongan Rp50.000',
            'min_order' => 200000,
        ],
    ];

    if (!array_key_exists($code, $vouchers)) {
        session()->forget('voucher');

        return back()->with('error', 'Kode voucher tidak valid.');
    }

    $voucher = $vouchers[$code];

    if ($subtotal < $voucher['min_order']) {
        session()->forget('voucher');

        return back()->with('error', 'Minimal pembelian untuk voucher ini adalah Rp' . number_format($voucher['min_order'], 0, ',', '.'));
    }

    if ($voucher['type'] === 'percent') {
        $discount = $subtotal * ($voucher['value'] / 100);
    } else {
        $discount = $voucher['value'];
    }

    $discount = min($discount, $subtotal);

    session()->put('voucher', [
        'code' => $code,
        'label' => $voucher['label'],
        'discount' => $discount,
    ]);

    return back()->with('success', 'Voucher berhasil digunakan.');
}

public function removeVoucher()
{
    session()->forget('voucher');

    return back()->with('success', 'Voucher berhasil dihapus.');
}

public function remove($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return back()->with('success', 'Item berhasil dihapus');
}
}
