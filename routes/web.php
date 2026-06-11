<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CostumeController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PelangganProfileController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminPenyewaanController;
use App\Http\Controllers\AdminProfileController;

Route::get('/', [DashboardController::class, 'dashboard'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'track.visit'])
    ->name('dashboard');

Route::get('/preferensi', [PreferenceController::class, 'index'])
    ->name('preferensi');

Route::get('/preferensi/cookie', [PreferenceController::class, 'read'])
    ->name('preferensi.cookie');

Route::post('/preferensi', [PreferenceController::class, 'store'])
    ->name('preferensi.store');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/store', [CartController::class, 'store'])
    ->name('cart.store');

Route::post('/cart/reset-hitungan', [CartController::class, 'resetVisit'])
    ->name('cart.resetVisit');

Route::post('/cart/apply-voucher', [CartController::class, 'applyVoucher'])
    ->name('cart.applyVoucher');

Route::post('/cart/remove-voucher', [CartController::class, 'removeVoucher'])
    ->name('cart.removeVoucher');

Route::post('/checkout/direct', [CartController::class, 'directCheckout'])
    ->name('checkout.direct');

Route::post('/checkout/prepare', [CartController::class, 'prepareCheckout'])
    ->name('checkout.prepare');

Route::get('/checkout', [CartController::class, 'checkout'])
    ->name('checkout.index');

Route::post('/checkout/cancel', [CartController::class, 'cancelCheckout'])
    ->name('checkout.cancel');

Route::middleware('auth')->group(function () {
    Route::post('/penyewaan/store', [PenyewaanController::class, 'store'])
        ->name('penyewaan.store');

    Route::get('/penyewaan-saya', [PenyewaanController::class, 'index'])
        ->name('penyewaan.index');

    Route::get('/payment/{penyewaan}', [PaymentController::class, 'show'])
        ->name('payment.show');

    Route::post('/payment/{penyewaan}/confirm', [PaymentController::class, 'confirm'])
        ->name('payment.confirm');
});

Route::get('/katalog', [KatalogController::class, 'index'])
    ->name('katalog');

Route::get('/katalog/{costume}', [KatalogController::class, 'show'])
    ->name('katalog.show');

Route::get('/tentang', [DashboardController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [DashboardController::class, 'kontak'])->name('kontak');

Route::get('/costumes/live-search', [CostumeController::class, 'liveSearch'])
    ->middleware('auth')
    ->name('costumes.live-search');

Route::resource('costumes', CostumeController::class)
    ->except(['show'])
    ->middleware('auth');

Route::get('/pelanggan', function () {
    return view('pelanggan.dashboard');
})->middleware('auth')->name('pelanggan.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/pelanggan/profile', [PelangganProfileController::class, 'show'])->name('pelanggan.profile');
    Route::put('/pelanggan/profile', [PelangganProfileController::class, 'update'])->name('pelanggan.profile.update');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'track.visit'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/penyewaan', [AdminPenyewaanController::class, 'index'])
        ->name('admin.penyewaan.index');
});

Route::get('/admin/penyewaan', [AdminPenyewaanController::class, 'index'])
    ->middleware('auth')
    ->name('admin.penyewaan.index');

Route::get('/admin/penyewaan/{penyewaan}', [AdminPenyewaanController::class, 'show'])
    ->middleware('auth')
    ->name('admin.penyewaan.show');

Route::post('/admin/penyewaan/{penyewaan}/verifikasi', [AdminPenyewaanController::class, 'verifikasiPembayaran'])
    ->middleware('auth')
    ->name('admin.penyewaan.verifikasi');

Route::post('/admin/penyewaan/{penyewaan}/status', [AdminPenyewaanController::class, 'updateStatus'])
    ->middleware('auth')
    ->name('admin.penyewaan.status');

Route::post('/admin/penyewaan/{penyewaan}/tolak', [AdminPenyewaanController::class, 'tolakPembayaran'])
    ->middleware('auth')
    ->name('admin.penyewaan.tolak');

Route::middleware('auth')->group(function () {

Route::get('/admin/profile', [AdminProfileController::class, 'show'])
    ->name('admin.profile');

Route::post('/admin/profile', [AdminProfileController::class, 'update'])
    ->name('admin.profile.update');
});

require __DIR__.'/auth.php';
