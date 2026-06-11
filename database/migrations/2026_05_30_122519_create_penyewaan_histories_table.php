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
    Schema::create('penyewaan_histories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('penyewaan_id')->constrained()->cascadeOnDelete();
        $table->string('judul');
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('penyewaan_histories');
}
};
