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
    Schema::create('penyewaan_items', function (Blueprint $table) {
        $table->id();

        $table->foreignId('penyewaan_id')->constrained()->cascadeOnDelete();
        $table->foreignId('costume_id')->nullable()->constrained('costumes')->nullOnDelete();

        $table->string('nama_kostum');
        $table->string('foto')->nullable();
        $table->integer('harga_sewa');
        $table->integer('durasi');
        $table->integer('subtotal');

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('penyewaan_items');
}
};
