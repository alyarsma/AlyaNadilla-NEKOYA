<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('costumes', function (Blueprint $table) {
    $table->id();
    $table->string('kode_kostum')->unique();
    $table->string('nama_kostum');
    $table->enum('kategori', ['anime', 'vtuber','game', ]);
    $table->string('ukuran');
    $table->decimal('harga_sewa', 10, 2);
    $table->integer('stok');
    $table->boolean('tersedia')->default(true);
    $table->string('foto')->nullable();
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('costumes');
    }
};
