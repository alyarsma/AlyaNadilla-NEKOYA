<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Costume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function show(Penyewaan $penyewaan)
    {
        if ($penyewaan->user_id !== auth()->id()) {
            abort(403);
        }

        $penyewaan->load('items');

        return view('payment.show', compact('penyewaan'));
    }

    public function confirm(Request $request, Penyewaan $penyewaan)
    {
        if ($penyewaan->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'metode_pembayaran' => 'required|string',
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($penyewaan->status_pembayaran !== 'pending') {
            return redirect()
                ->route('penyewaan.index')
                ->with('error', 'Pembayaran untuk penyewaan ini sudah pernah dikonfirmasi.');
        }

        DB::transaction(function () use ($request, $penyewaan) {
            $penyewaan->load('items');

            foreach ($penyewaan->items as $item) {
                if ($item->costume_id) {
                    $costume = Costume::where('id', $item->costume_id)
                        ->lockForUpdate()
                        ->first();

                    if (!$costume || $costume->stok < 1) {
                        throw new \Exception('Stok ' . $item->nama_kostum . ' tidak mencukupi.');
                    }

                    $costume->decrement('stok', 1);

                    if ($costume->fresh()->stok <= 0) {
                        $costume->update([
                            'tersedia' => false,
                        ]);
                    }
                }
            }

            $buktiPath = $request->file('bukti_transfer')->store('bukti-transfer', 'public');

            $penyewaan->update([
                'metode_pembayaran' => $request->metode_pembayaran,
                'status_pembayaran' => 'menunggu_verifikasi',
                'status_penyewaan' => 'menunggu_konfirmasi',
                'bukti_transfer' => $buktiPath,
            ]);
        });

        session()->forget('checkout_items');
        session()->forget('voucher');

        return redirect()
            ->route('penyewaan.index')
            ->with('success', 'Pembayaran berhasil dikonfirmasi. Stok kostum sudah dikurangi dan menunggu verifikasi admin.');
    }
}
