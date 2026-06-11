<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('penyewaans', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        $table->string('kode_penyewaan')->unique();

        $table->string('nama');
        $table->string('no_wa');
        $table->text('alamat');

        $table->date('tanggal_ambil');
        $table->date('tanggal_kembali');

        $table->text('catatan')->nullable();

        $table->integer('subtotal')->default(0);
        $table->integer('discount')->default(0);
        $table->integer('total')->default(0);
        $table->string('voucher_code')->nullable();

        $table->string('metode_pembayaran')->nullable();

        $table->string('status_pembayaran')->default('pending');
        $table->string('status_penyewaan')->default('menunggu_pembayaran');

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('penyewaans');
}
};
