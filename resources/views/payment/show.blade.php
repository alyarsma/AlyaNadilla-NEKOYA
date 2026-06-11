@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-50 px-6 pt-24 pb-16 text-slate-900 dark:bg-slate-950 dark:text-white">
    <div class="mx-auto max-w-4xl">

        <a href="{{ route('checkout.index') }}"
           class="mb-6 inline-block text-sm font-bold text-cyan-300 hover:text-pink-300">
            ← Kembali ke Checkout
        </a>

        <div class="mb-8">
            <h1 class="text-3xl font-black text-cyan-300">
                Pembayaran Penyewaan
            </h1>
            <p class="mt-2 text-sm text-slate-400">
                Pilih metode pembayaran dan kirim bukti transfer agar pesananmu diproses admin.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-400/30 bg-red-400/10 p-4 text-red-300">
                <p class="font-bold">Ada data yang belum sesuai:</p>
                <ul class="mt-2 list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid gap-8 lg:grid-cols-[1fr_360px]">

            <div class="space-y-6">
                <div class="rounded-3xl border border-cyan-400/20 bg-slate-900 p-6 shadow-2xl">
                    <h2 class="mb-5 text-xl font-black text-white">
                        Detail Pesanan
                    </h2>

                    <div class="space-y-4">
                        <div class="flex justify-between border-b border-slate-700 pb-3">
                            <span class="text-slate-400">Kode Penyewaan</span>
                            <span class="font-bold text-cyan-300">{{ $penyewaan->kode_penyewaan }}</span>
                        </div>

                        <div class="flex justify-between border-b border-slate-700 pb-3">
                            <span class="text-slate-400">Nama</span>
                            <span class="font-bold">{{ $penyewaan->nama }}</span>
                        </div>

                        <div class="flex justify-between border-b border-slate-700 pb-3">
                            <span class="text-slate-400">Tanggal Ambil</span>
                            <span class="font-bold">{{ $penyewaan->tanggal_ambil }}</span>
                        </div>

                        <div class="flex justify-between border-b border-slate-700 pb-3">
                            <span class="text-slate-400">Tanggal Kembali</span>
                            <span class="font-bold">{{ $penyewaan->tanggal_kembali }}</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('payment.confirm', $penyewaan->id) }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="rounded-3xl border border-cyan-400/20 bg-slate-900 p-6 shadow-2xl">
                    @csrf

                    <h2 class="mb-5 text-xl font-black text-white">
                        Pilih Metode Pembayaran
                    </h2>

                    <div class="space-y-4">
                        <label class="block cursor-pointer rounded-2xl border border-cyan-400/20 bg-slate-950 p-4 hover:border-cyan-300">
                            <div class="flex items-start gap-3">
                                <input type="radio"
                                       name="metode_pembayaran"
                                       value="Transfer Bank"
                                       checked
                                       class="mt-1 accent-cyan-400 payment-method">
                                <div>
                                    <p class="font-bold text-cyan-300">Transfer Bank</p>
                                    <p class="mt-1 text-sm text-slate-400">
                                        BCA 1234567890 a.n. NEKOYA COSPLAY RENTAL
                                    </p>
                                </div>
                            </div>
                        </label>

                        <label class="block cursor-pointer rounded-2xl border border-cyan-400/20 bg-slate-950 p-4 hover:border-cyan-300">
                            <div class="flex items-start gap-3">
                                <input type="radio"
                                       name="metode_pembayaran"
                                       value="E-Wallet"
                                       class="mt-1 accent-cyan-400 payment-method">
                                <div>
                                    <p class="font-bold text-cyan-300">E-Wallet</p>
                                    <p class="mt-1 text-sm text-slate-400">
                                        DANA / OVO / GoPay: 088234183154 a.n. NEKOYA
                                    </p>
                                </div>
                            </div>
                        </label>

                        <label class="block cursor-pointer rounded-2xl border border-cyan-400/20 bg-slate-950 p-4 hover:border-cyan-300">
                            <div class="flex items-start gap-3">
                                <input type="radio"
                                       name="metode_pembayaran"
                                       value="Cash Saat Pengambilan"
                                       class="mt-1 accent-cyan-400 payment-method">
                                <div>
                                    <p class="font-bold text-cyan-300">Cash Saat Pengambilan</p>
                                    <p class="mt-1 text-sm text-slate-400">
                                        Bayar langsung ketika mengambil kostum di lokasi Nekoya.
                                    </p>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div id="buktiTransferBox" class="mt-6">
                        <label class="mb-2 block text-sm font-bold text-slate-300">
                            Upload Bukti Transfer
                        </label>

                        <input id="buktiTransferInput"
                               type="file"
                               name="bukti_transfer"
                               accept="image/*"
                               required
                               class="w-full rounded-xl border border-cyan-400/20 bg-slate-950 px-4 py-3 text-white
                                      file:mr-4 file:rounded-lg file:border-0
                                      file:bg-cyan-400 file:px-4 file:py-2
                                      file:font-bold file:text-slate-950">

                        <p class="mt-2 text-xs text-slate-400">
                            Format yang diterima: JPG, JPEG, PNG. Maksimal 2MB.
                        </p>
                    </div>

                    <div class="mt-6 rounded-2xl border border-yellow-400/20 bg-yellow-400/10 p-4 text-sm text-yellow-200">
                        Setelah klik konfirmasi, status pembayaran akan menjadi
                        <span class="font-bold">Menunggu Verifikasi Admin</span>.
                    </div>

                    <button type="submit"
                            class="mt-6 w-full rounded-xl bg-gradient-to-r from-cyan-400 to-pink-400 px-6 py-4 font-black text-slate-950 transition hover:scale-[1.02]">
                        Saya Sudah Bayar / Konfirmasi Pembayaran
                    </button>
                </form>
            </div>

            <div class="h-fit rounded-3xl border border-pink-400/20 bg-slate-900 p-6 shadow-2xl">
                <h2 class="mb-5 text-xl font-black">
                    Ringkasan <span class="text-pink-400">Pembayaran</span>
                </h2>

                <div class="space-y-3 border-b border-slate-700 pb-5 text-sm">
                    @foreach($penyewaan->items as $item)
                        <div class="flex justify-between gap-4">
                            <span class="text-slate-400">{{ $item->nama_kostum }}</span>
                            <span class="font-bold">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 space-y-3 border-b border-slate-700 pb-5 text-sm">
                    <div class="flex justify-between text-slate-300">
                        <span>Subtotal</span>
                        <span>Rp{{ number_format($penyewaan->subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-cyan-300">
                        <span>Diskon {{ $penyewaan->voucher_code ?? '' }}</span>
                        <span>- Rp{{ number_format($penyewaan->discount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-5 flex justify-between text-2xl font-black">
                    <span>Total</span>
                    <span class="text-cyan-300">
                        Rp{{ number_format($penyewaan->total, 0, ',', '.') }}
                    </span>
                </div>

                <div class="mt-6 rounded-2xl border border-cyan-400/20 bg-slate-950 p-4 text-xs text-slate-400">
                    Status saat ini:
                    <span class="font-bold text-cyan-300">
                        {{ str_replace('_', ' ', $penyewaan->status_pembayaran) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const paymentMethods = document.querySelectorAll('.payment-method');
    const buktiBox = document.getElementById('buktiTransferBox');
    const buktiInput = document.getElementById('buktiTransferInput');

    function toggleBuktiTransfer() {
        const selected = document.querySelector('.payment-method:checked').value;

        if (selected === 'Cash Saat Pengambilan') {
            buktiBox.classList.add('hidden');
            buktiInput.removeAttribute('required');
            buktiInput.value = '';
        } else {
            buktiBox.classList.remove('hidden');
            buktiInput.setAttribute('required', 'required');
        }
    }

    paymentMethods.forEach(function (method) {
        method.addEventListener('change', toggleBuktiTransfer);
    });

    toggleBuktiTransfer();
});
</script>
@endsection
